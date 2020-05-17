<?php

namespace App\Http\Controllers;

use App\Model\Phases;
use App\Models\SchouwportaalGebreken;
use App\Models\SpinMaatregelen;
use App\Models\UltimoGebreken;
use Illuminate\Http\Request;
use App\Models\SyncStatus;
use Auth;
class PhasesController extends Controller
{
    public function show()
    {
//        $phasesJSON =  '[{"index":"1","title":"Verwervingsfase","description":"Dit zou een beschrijving kunnen zijn van een fase. Maar je wilt geen sterke verhalen gaan ophangen, gewoon lekker kort en krachtig. Daarom zal deze tekst na 2 lijnen afgekort worden.","icon":"lnr-magic-wand","route":"/verwervingsfase"},{"index":"2","title":"Transititefase","description":"Dit zou een beschrijving kunnen zijn van een fase. Maar je wilt geen sterke verhalen gaan ophangen, gewoon lekker kort en krachtig. Daarom zal deze tekst na 2 lijnen afgekort worden.","icon":"lnr-cog","route":"/transitiefase"},{"index":"3","title":"Onderhoudsfase","description":"Dit zou een beschrijving kunnen zijn van een fase. Maar je wilt geen sterke verhalen gaan ophangen, gewoon lekker kort en krachtig. Daarom zal deze tekst na 2 lijnen afgekort worden.","icon":"lnr-picture","route":"/onderhoudsfase"},{"index":"4","title":"Overdracht en nazorg","description":"Dit zou een beschrijving kunnen zijn van een fase. Maar je wilt geen sterke verhalen gaan ophangen, gewoon lekker kort en krachtig. Daarom zal deze tekst na 2 lijnen afgekort worden.","icon":"lnr-apartment","route":"/overdrachtennazorg"}]';
//        $phases = json_decode($phasesJSON);

        $phases = Phases::where('user_id',auth()->user()->id)->get();
        return view('phases.view', compact("phases"));
    }

    public function create()
    {
        return view('phases.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'sysnum' => 'required'
        ]);
        $user_id = auth()->user()->id;
        $phase = new Phases([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'sysnum' => $request->get('sysnum'),
            'user_id' => $user_id
        ]);
        $phase->save();

        return redirect()->route('phases')->with('success','Fase created successfully.');
    }
    public function edit($id){
        $phase = Phases::find($id);
        return view('phases.edit',compact('phase'));
    }
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'sysnum' => 'required'
        ]);
        $phase = Phases::find($id);
        $phase->name = $request->get('name');
        $phase->description = $request->get('description');
        $phase->sysnum = $request->get('sysnum');
        $phase->save();
        return redirect()->route('phases')->with('success','Fase updated successfully.');
    }

    public function destroy($id)
    {
        $phase = Phases::find($id);
        $phase->delete();

        return redirect()->route('phases')->with('success','Fase deleted successfully');
    }
}
