<?php

namespace App\Http\Controllers;

use App\Model\Phases;
use App\Model\Processes;
use App\Model\Themes;
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
//        $phases = Phases::where('user_id',auth()->user()->id)->where('active',1)->get();
        $phases = Phases::where('active',1)->get();
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
//        $phase->delete();
        $phase->active = 0;
        $phase->save();
        $children_themes = Themes::where('fase_id',$id)->get();
        foreach ($children_themes as $ctheme){
            $ctheme->active = 0;
            $ctheme->save();
        }
        $children_processes = Processes::where('fase_id',$id)->get();
        foreach ($children_processes as $cprocess){
            $cprocess->active = 0;
            $cprocess->save();
        }
        return redirect()->route('phases')->with('success','Fase(his children) deleted successfully');
    }
}
