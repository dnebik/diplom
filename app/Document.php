<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public $id_avt;
    public $trec;
    public $login;
    public $IP;
    public $Comment_file;


    protected $table = "all_file";
    public $timestamps = false;

    public function clear(): array
    {
        $arr = $this->toArray();
        unset ($arr['id']);
        unset ($arr['trec']);
        unset ($arr['IP']);
        return $arr;
    }
}
