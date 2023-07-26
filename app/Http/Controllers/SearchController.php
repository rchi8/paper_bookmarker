<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    //入力から論文データを出力する
    public function paperList($title, $author, $abstract, $comment, $journal_ref, $subject_cat, $report_number, $id_list, $all, $max_results)
    {
        
        $url = 'https://export.arxiv.org/api/query';
        
        $query = [
              'ti' => $title,
              'au' => $author,
              'abs' => $abstract,
              'co' => $comment,
              'jr' => $journal_ref,
              'cat' => $subject_cat,
              'rn' => $report_number,
              'id' => $id_list,
              'all' => $all
          ];
        
        $searchString = '';
        
        foreach ($query as $key => $value) {
            if (!empty($value)) {
                $searchString .= "$key:$value+AND+";
            }
        }
        
        $searchString = rtrim($searchString, '+AND+');
        //dd($searchString);
        $response = Http::get($url, [
            'search_query' => $searchString,
            'max_results' => $max_results,
            'sortBy' => 'submittedDate'
        ]);
        
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $array = json_decode($json, true);
        
        return $array;
    }
}
