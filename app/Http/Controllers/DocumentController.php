<?php


namespace App\Http\Controllers;


use App\Document;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $path = $request->file('file')->store('files');

//        $doc = new Document();
//        $doc->login = Auth::user()->login;
//        $doc->IP = $request->ip();
//        $doc->Comment_file = $request->has('comment') ? $request->post('comment') : '';


        return response();
    }

    public function file($name) {
        if (Storage::disk('file')->exists($name))
            return response()->file(storage_path('app/files/' . $name));
        else
            return redirect('non-exist');
    }
}
