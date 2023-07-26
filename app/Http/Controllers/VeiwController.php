<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;

class ViewController extends Controller
{
    //インデックスを表示する
    public function index()
    {
        
        return view('contents.index');
    }
    
    //新着ページを表示する
    public function new()
    {
        $title = "";
        $author = "";
        $abstract = "";
        $comment = "";
        $journal_ref = "";
        $subject_cat = "math.DG";
        $report_number = "";
        $id_list = "";
        $all = "";
        $max_results = 36;
        
        $searchController = new SearchController();
        
        $array = $searchController->paperList($title, $author, $abstract, $comment, $journal_ref,
            $subject_cat, $report_number, $id_list, $all, $max_results);
        
        $array = $array['entry'] ?? [];
        
        return view('contents.new', compact('array'));
    }
    
    //検索ページを表示する
    public function search()
    {
        return view('contents.search');
    }
    
    //フォーム入力から結果を表示
    public function searchPaper(Request $request)
    {
       //dd($request->all());
       
        $title = $request->title;
        $author = $request->author;
        $abstract = $request->abstract;
        $comment = $request->comment;
        $journal_ref = $request->journal_ref;
        $subject_cat = $request->subject_cat;
        $report_number = $request->report_number;
        $id_list = $request->id_list;
        $all = $request->all;
        $max_results = $request->max_results;
        
        $searchController = new SearchController();
        
        $array = $searchController->paperList($title, $author, $abstract, $comment, $journal_ref,
            $subject_cat, $report_number, $id_list, $all, $max_results);
        
       $array = $array['entry'] ?? [];
       $count = count($array);
        //dd($array);
        
       return view('contents.result', compact('array', 'count'));
    }
    
    
    //お気に入りページを表示する
    public function favorite()
    {
        $articles = Article::paginate(15);
        
        
        return view('contents.favorite', compact('articles'));
    }
}
