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

    public function index(Request $request) {
        if (!$request->has('id')) return response('Bad request', 400);
        $doc = Document::where(['id_avt' => $request->post('id')])->first();
        if (is_null($doc))
            return response('No such file');
        return response($doc->clear());
    }

    public function upload(Request $request) {
        if (!$request->has('file'))
            return response('No such file', 404);

        $date_path = "data/" . date('Y-m', time());
        $path = $request->file('file')->store($date_path);
        $id_file = strtoupper(Str::random(9));
        $login = Auth::user()->login;
        $ip = $request->ip();
        $comment = $request->has('comment') ? $request->post('comment') : '';


        $doc = new Document();
        $doc->id_avt = $id_file;
        $doc->trec = $path;
        $doc->login = $login;
        $doc->IP = $ip;
        $doc->Comment_file = $comment;


        if ($doc->save()) {
            return response(['id' => $id_file]);
        } else {
            return response('Save error', 500);
        }

    }

    public function file($name) {
        $doc = Document::where('id_avt', '=', $name)->first();
        $path = $doc['trec'];
        if (Storage::disk('local')->exists($path))
        {
            return response()->file(storage_path('app/' . $doc['trec']));
        }
        else
            return redirect('non-exist');
    }
}
