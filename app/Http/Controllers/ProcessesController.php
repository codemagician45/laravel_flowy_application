<?php

namespace App\Http\Controllers;

use App\Model\Phases;
use App\Model\Processes;
use App\Model\Themes;
use App\User;
use Illuminate\Http\Request;

class ProcessesController extends Controller
{
    public function show($fase_id,$theme_id){
        $parent_fase = Phases::find($fase_id);
        $parent_theme = Themes::find($theme_id);
        $processes = Processes::where('theme_id',$theme_id)->get();
        return view('processes.view', compact(['processes','fase_id','theme_id','parent_fase','parent_theme']));
    }

    public function create($fase_id,$theme_id)
    {
        $parent_fase = Phases::find($fase_id);
        $parent_theme = Themes::find($theme_id);
        return view('processes.create', compact(['fase_id','theme_id','parent_fase','parent_theme']));
    }
    public function store($fase_id,$theme_id, Request $request)
    {
        $request->validate([
           'name' => 'required',
           'description' => 'required',
           'sysnum' => 'required',
        ]);

        $process = new Processes([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'sysnum' => $request->get('sysnum'),
            'theme_id' => $theme_id,
            'fase_id' => $fase_id,
        ]);
        $process->save();
        return redirect()->route('processes',compact(['fase_id','theme_id']))->with('success', 'Process created successfully.');
    }

    public function show_flow_chart($fase_id,$theme_id,$id){
        $process = Processes::find($id);
        $parent_fase = Phases::find($fase_id);
        $parent_theme = Themes::find($theme_id);
        return view('processes.flowchart_show',compact(['fase_id','theme_id','id','process','parent_fase','parent_theme']));
    }

    public function store_flow_chart($fase_id,$theme_id,$id, Request $request)
    {
        $process = Processes::find($id);
        $process->flowchart = $request->get('flowchart_data');
        $process->long_des = $request->get('long_des');
        if($process->flowchart == null) $process->flowchart = '';
        if($process->long_des == null) $process->long_des = '';
        $process->save();

        return redirect()->route('process_show_flowchart',compact(['fase_id','theme_id','id']))->with('success', 'Process edited successfully.');
    }

    public function edit_flow_chart($fase_id,$theme_id,$id)
    {
        $parent_fase = Phases::find($fase_id);
        $parent_theme = Themes::find($theme_id);
        $process = Processes::find($id);
        $users = User::all();
        $processes = Processes::where('id','!=',$id)->get();
        return view('processes.flowchart_edit',compact(['fase_id','theme_id','id','process','users','processes','parent_fase','parent_theme']));
    }
}
