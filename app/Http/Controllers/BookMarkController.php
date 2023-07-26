<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Article;

class BookmarkController extends Controller
{
     //ブックマーク登録
    public function bookmark(Request $request)
    {
        $array = $request->item;
      
        
        $existingBook = Article::where('title', $array['title'])->first();
        if ($existingBook) {
            // 同じタイトルのレコードが既に存在する場合は追加しない
            
        } else {
            
            $article = new Article();
            $article->url = $array['id'];
            $article->updated = explode("T", $array['updated'])[0];
            $article->published = explode("T", $array['published'])[0];
            $article->title = $array['title'];
            
            if (count($array['author']) == 1) {
                $article->author1 = $array['author']['name']??'';
            } else {
                $article->author1 = $array['author'][0]['name']??'';
                $article->author2 = $array['author'][1]['name']??'';
                $article->author3 = $array['author'][2]['name']??'';
            }
            
            $article->summary = $array['summary'];
            $article->save();
        }
        
        
    }
    
    
    
    
    //ブックマーク削除
    public function delete(Request $request)
    {
        Article::destroy($request->id);
        
        return redirect()->route('favorite');
    }
    
    //ブックマーク条件検索   
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $sort = $request->sort; //1, 2, 3
        $memo = $request->memo; // 1
        
        $query = DB::table('articles'); // Use DB facade instead of Article::query() to create the query.
        
        // メモフラグで絞り込み
        if ($memo == 1) {
            $query = $query->where('flag', 1);
        }
        
        // キーワードで絞り込み
        if (!empty($keyword)) {
            $query = $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%')
                ->orWhere('summary', 'like', '%' . $keyword . '%')
                ->orWhere('updated', 'like', '%' . $keyword . '%')
                ->orWhere('published', 'like', '%' . $keyword . '%')
                ->orWhere('author1', 'like', '%' . $keyword . '%')
                ->orWhere('author2', 'like', '%' . $keyword . '%')
                ->orWhere('author3', 'like', '%' . $keyword . '%');
            });
        }
        
        // ソート
        if ($sort == 1) {
            $query = $query->orderBy('created_at', 'asc');
        } elseif ($sort == 2) {
            $query = $query->orderBy('published', 'desc');
        } elseif ($sort == 3) {
            $query = $query->orderBy('published', 'asc');
        }
        
        // 結果を取得し、6件ずつページネーションを適用
        $results = $query->paginate(15);
        
        return view('contents.favorite', ['articles' => $results, 'keyword' => $keyword]);
    }
    
    
    //メモ追加
    public function updateMemo(Request $request)
    {
        $article = Article::where('id', $request->id)->first();
        $article->memo = $request->memo;
        $article->save();
        
        if ($article->memo != "") {
            $article->flag = 1;
        } else {
            $article->flag = 0;
        }
        $article->save();
    }
        
}
