<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public static function search($keyword)
    {
        return self::where('title', 'like', '%'.$keyword.'%')
        ->orWhere('summary', 'like', '%'.$keyword.'%')
        ->orWhere('updated', 'like', '%'.$keyword.'%')
        ->orWhere('published', 'like', '%'.$keyword.'%')
        ->orWhere('author1', 'like', '%'.$keyword.'%')
        ->orWhere('author2', 'like', '%'.$keyword.'%')
        ->orWhere('author3', 'like', '%'.$keyword.'%')
        ->get();
    }
}
