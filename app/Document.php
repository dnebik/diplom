<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

    protected $table = "all_file";
    public $timestamps = false;


    public function clear(): array{
        $arr = $this->toArray();
        unset ($arr['id']);
        unset ($arr['trec']);
        unset ($arr['IP']);
        return $arr;
    }
}
