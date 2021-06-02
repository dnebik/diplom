<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Document extends Model
{

    protected $table = "all_file";
    public $timestamps = false;

    public function addView($ip) : bool {
        $user = Auth::user();

        $request = DB::table('review_requests')
            ->where('id_doc', '=', $this->id)
            ->where('id_recipient', '=', $user->id)
            ->where('id_status', '=', '1');
        $request->update(['id_status' => 2]);

        $request = ViewsWeb::where(['login' => $user->login, 'id_request' => $this->id_avt])->first();
        if (is_null($request)) {
            $new_request = new ViewsWeb();
            $new_request->login = $user->login;
            $new_request->id_request = $this->id_avt;
            $new_request->counter = 1;
            $new_request->IP = $ip;
            if ($new_request->save()) return true;
            else return false;
        } else {
            date_default_timezone_set('Europe/Moscow');
            $time_from_base = strtotime($request->DateTimeSearch);
            $time = time();

            $count = (int)$request->counter;
            if ($time - $time_from_base > 600) $count++;

            $request = ViewsWeb::where(['login' => $user->login, 'id_request' => $this->id_avt])->limit(1);
            if ($request->update(['counter' => $count, 'DateTimeSearch' => date('c', time()), 'IP' => $ip])) return true;
            else return false;
        }
    }

    public function clear(): array{
        $arr = $this->toArray();
        unset ($arr['id']);
        unset ($arr['trec']);
        unset ($arr['IP']);
        return $arr;
    }
}
