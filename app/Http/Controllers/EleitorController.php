<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Votacao;
use App\Models\Eleitor;
use App\Models\Eleicao;

class EleitorController extends Controller
{
    public function votou($id)
    {
        error_log("chegou aqui EleitorController");
        $eleitor = Eleitor::where('id', $id);
        $eleitor->votou = 1;

        $eleitor.save();
    }
}