<?php

namespace App\Services;
use App\Models\Eleitor;

class VotouService
{
    public function votou($id)
    {
        $eleitor = Eleitor::where('id', $id)->firstOrFail();
        $eleitor->votou = 1;
        $eleitor->save();
    }
}