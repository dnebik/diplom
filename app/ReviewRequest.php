<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class ReviewRequest extends Model
{
    public $timestamps = false;
    protected $table = 'review_requests';
}
