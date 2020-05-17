<?php

namespace App\Http\Controllers;

use App\Models\SchouwportaalGebreken;
use App\Models\SpinMaatregelen;
use App\Models\UltimoGebreken;
use Illuminate\Http\Request;
use App\Models\SyncStatus;

class PhasesController extends Controller
{
    public function show()
    {
        $phasesJSON =  '[{"index":"1","title":"Verwervingsfase","description":"Dit zou een beschrijving kunnen zijn van een fase. Maar je wilt geen sterke verhalen gaan ophangen, gewoon lekker kort en krachtig. Daarom zal deze tekst na 2 lijnen afgekort worden.","icon":"lnr-magic-wand","route":"/verwervingsfase"},{"index":"2","title":"Transititefase","description":"Dit zou een beschrijving kunnen zijn van een fase. Maar je wilt geen sterke verhalen gaan ophangen, gewoon lekker kort en krachtig. Daarom zal deze tekst na 2 lijnen afgekort worden.","icon":"lnr-cog","route":"/transitiefase"},{"index":"3","title":"Onderhoudsfase","description":"Dit zou een beschrijving kunnen zijn van een fase. Maar je wilt geen sterke verhalen gaan ophangen, gewoon lekker kort en krachtig. Daarom zal deze tekst na 2 lijnen afgekort worden.","icon":"lnr-picture","route":"/onderhoudsfase"},{"index":"4","title":"Overdracht en nazorg","description":"Dit zou een beschrijving kunnen zijn van een fase. Maar je wilt geen sterke verhalen gaan ophangen, gewoon lekker kort en krachtig. Daarom zal deze tekst na 2 lijnen afgekort worden.","icon":"lnr-apartment","route":"/overdrachtennazorg"}]';
        $phases = json_decode($phasesJSON);

        return view('phases.view', compact("phases"));
    }
}
