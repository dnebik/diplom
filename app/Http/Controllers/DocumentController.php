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
            return response('Ok');
        } else {
            return response('Save error', 500);
        }

    }

    public function file($name) {
        $doc = Document::where('id_avt', 'like', $name)->first();
        $path = $doc['trec'];
        if (Storage::disk('local')->exists($path))
        {
            return response()->file(storage_path('app/' . $doc->trec));
        }
        else
            return redirect('non-exist');
    }
}
