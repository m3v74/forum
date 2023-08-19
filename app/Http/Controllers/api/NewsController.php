<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class NewsController extends Controller
{

    public function getAllNews()
    {
        $news = DB::table('news')->orderBy('id')->get();
        return $news;
    }

    public function getAllNewsAvatar()
    {
        $news = News::join('authors', 'news.author_id', '=', 'authors.id')
//            ->where('news.author_id', $id)
            ->get(['news.title', 'news.preview_text', 'news.full_text', 'news.category_id', 'authors.avatar', 'authors.id']);
        return $news;
    }

    public function getAuthorNews(Request $request)
    {

//        $author = new Author();
//        $avatar = $author->avatar;

        $id = $request->input('id');


//        $news = News::select('title', 'preview_text', 'full_text', 'category_id', 'author_id', 'authors.avatar')
//            ->where('author_id', $id)
//            ->get();

//        $news = News::select('title', 'preview_text', 'full_text', 'category_id', 'author_id', 'authors.avatar')
//            ->where('author_id', $id)
//            ->get();

        $news = News::join('authors', 'news.author_id', '=', 'authors.id')
//            ->where('news.author_id', $id)
            ->get(['news.title', 'news.preview_text', 'news.full_text', 'news.category_id', 'authors.avatar', 'authors.id']);




        return $news;


//        ГОВНОКОД                                  categories.name все равно не выводит//
//
//        $author = DB::table('news')
//
//            ->select('news.title', 'news.preview_text', 'news.full_text', 'categories.name AS category')
//
//            ->join('authors'     , 'news.author_id'   , '=', 'authors.id')
//            ->join('categories'  , 'news.category_id' , '=', 'categories.id')
//
//            ->where('authors.id', '=', $request->id)
//            ->get();
//
//        return $author;
//        return response('error', 404);



//        ГОВНОКОД                                  categories.name все равно не выводит//
//
//        $news = News::select('title', 'preview_text', 'full_text', 'categories.name AS category')
//            ->join('authors', 'news.author_id', '=', 'authors.id')
//            ->join('categories', 'news.category_id', '=', 'categories.id')
//            ->where('authors.id', $id)
//            ->get();
//
//        return $news;
     }
}
