<?php

namespace App\Observers;

use App\Document;
use App\User;

class DocumentObserver
{
    public function retrieved(Document $document) {
        $user = User::where(['login' => $document['login']])->first();
        if ($user) {
            $document['user'] = $user->clear();
            unset($document['login']);
        }
    }
}
