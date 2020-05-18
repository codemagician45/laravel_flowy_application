<?php

namespace App\Http\Controllers;

use App\Model\Processes;
use Illuminate\Http\Request;

class ProcessesController extends Controller
{
    public function show($fase_id,$theme_id){
        $processes = Processes::where('theme_id',$theme_id)->get();
        return view('processes.view', compact(['processes','fase_id','theme_id']));
    }

    public function create($fase_id,$theme_id)
    {
        return view('processes.create', compact(['fase_id','theme_id']));
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
            'fase_id' => $fase_id
        ]);

        $process->save();
        return redirect()->route('processes',compact(['fase_id','theme_id']))->with('success', 'Process created successfully.');
    }

    public function show_flow_chart($fase_id,$theme_id,$id){
        return view('processes.flowchart_show',compact(['fase_id','theme_id','id']));
    }

    public function create_flow_chart()
    {
        return view('processes.flowchart_create');
    }
}
