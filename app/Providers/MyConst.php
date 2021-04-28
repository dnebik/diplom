<?php


namespace App\Providers;


class MyConst
{
    const OK = array(
            'text' => 'ok',
            'code' => 0,
    );
    const UNAUTHORIZED = array(
        'text' => 'Authorisation Error.',
        'code' => 1
    );
    const USER_BLOCKED = array(
        'text' => 'User has blocked.',
        'code' => 2
    );
    const BAD_REQUEST = array(
        'text' => 'Bad request.',
        'code' => 10
    );
    const NO_SUCH_FILE = array(
        'text' => 'No such file.',
        'code' => 51
    );
    const SAVE_ERROR = array(
        'text' => 'Save error.',
        'code' => 50
    );
}
