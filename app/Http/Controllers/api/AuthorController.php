<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AuthorController extends Controller
{
    private $path;

    public function __construct()
    {
        $this->path = realpath('.') . '/img/avatar/';
    }


    public function getAuthors()
    {
        $authors = DB::table('authors')->orderBy('id')->get();
        return $authors;
    }


    public function add(Request $request)
    {
        $author = new Author();
        $file = $request->file;

        if ($file != 'undefined')
        {
            $extension    = $file->getClientOriginalExtension();
            $newImageName = md5(date("dmYis"));
            $filename     = $newImageName . "." . $extension;

            $Handle      = fopen($file, "r");
            $fileContent = fread($Handle, $_FILES["file"]["size"]);

            fclose($Handle);


            $handle = fopen($this->path . $filename, "w");
            fwrite($handle, $fileContent);
            fclose($handle);

            $author->avatar = $filename;
        }

        $author->full_name = $request->name;
        $author->save();

        return $author;
    }


    public function edit(Request $request)
    {
        $id       = $request->id;
        $author   = Author::find($id);
        $old_file = $author->avatar;
        $file     = $request->file;

        if (file_exists($this->path . $old_file))
        {
            unlink($this->path . $old_file);
        }

        if ($file != 'undefined')
        {
            $extension    = $file->getClientOriginalExtension();
            $newImageName = md5(date("dmYis"));
            $filename     = $newImageName . "." . $extension;

            $Handle = fopen($file, "r");
            $fileContent = fread($Handle, $_FILES["file"]["size"]);

            fclose($Handle);

            $handle = fopen($this->path . $filename, "w");
            fwrite($handle, $fileContent);
            fclose($handle);
            $author->avatar = $filename;
        }

        $author->full_name = $request->name;
        $author->save();

        return $author->id;
    }


    public function del(Request $request)
    {
        $id       = $request->id;
        $author   = Author::find($id);
        $old_file = $author->avatar;

        Author::find($id)->delete();

        if (file_exists($this->path . $old_file))
        {
            unlink($this->path . $old_file);
        }
    }


    public function getAvatar(Request $request)
    {
        $id = $request->input('id');
        $author = Author::with('news')->find($id);
        $avatar = $author->avatar;

        return $avatar;
    }
}
