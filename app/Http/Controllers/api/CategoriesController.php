<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;


class CategoriesController extends Controller
{
    public function getHomeCategory()
    {
        $HomeCategory = Category::whereNull('parent_id')->orderBy('id')->get();

        return $HomeCategory;
    }

    public function getCategory(Request $request)
    {
        $childCategory = Category::where('parent_id', $request->parent_id)->get();

        return $childCategory;
    }

    public function getAllcategory()
    {
        $allCategory = Category::all('id', 'name');
        return $allCategory;
    }

    public function saveCategory(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $file = $request->file;
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $result = $request->file('file')->store('public/avatar');
            $url = Storage::url($result);
        }

        $category = new Category();
        if ($id != 'null')
            $category->parent_id = $id;
        $category->name = $name;
        $category->image = $url;
        $category->save();
        $idNew = $category->id;
        return $idNew;
    }
}
