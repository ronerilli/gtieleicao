<?php

namespace App\Services;
use App\Models\User;

class VotouService
{
    public function votou($id)
    {
        $eleitor = User::where('id', $id)->firstOrFail();
        $eleitor->votou = 1;
        $eleitor->save();
    }
}