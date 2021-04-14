<?php


namespace App\Http\Controllers;


use App\Document;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentController extends Controller
{

    public function index() {
        return response(Document::all());
    }

    public function upload(Request $request) {
        if (!$request->has('file'))
            return response('Нет файла', 400);

//        $doc = new Document();
//        $info = pathinfo($request->file('file')['name']);
//        $ext = $info['extension'];
//        $random = strtoupper(Str::random(10));
//        $newname = $random.$ext;

        $path = $request->file('file')->store('files');

        return response($path);
    }
}
