<?php

namespace App\Http\Controllers;

use App\Model\Phases;
use App\Model\Processes;
use App\Model\Roles;
use App\Model\Themes;
use App\User;
use Illuminate\Http\Request;

class ProcessesController extends Controller
{
    public function show($fase_id,$theme_id){
        $parent_fase = Phases::find($fase_id);
        $parent_theme = Themes::find($theme_id);
        $processes = Processes::where('theme_id',$theme_id)->get();
//        dd($processes);
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

    public function show_process($fase_id,$theme_id,$id){
        $process = Processes::find($id);
        $parent_fase = Phases::find($fase_id);
        $parent_theme = Themes::find($theme_id);
        $role_data = json_decode($process->role_data);
        $role_arr = [];
        foreach ($role_data as $role){
            array_push($role_arr,Roles::find($role));
        }
        return view('processes.flowchart_show',compact(['fase_id','theme_id','id','process','parent_fase','parent_theme','role_arr']));
    }

    public function update_process($fase_id,$theme_id,$id, Request $request)
    {
        $process = Processes::find($id);
        $process->flowchart = $request->get('flowchart_data');
        $process->long_des = $request->get('long_des');
        $process->block_data = $request->get('block_data');
        $process->role_data = $request->get('role_data');
//        if($process->flowchart == null) $process->flowchart = '';
//        if($process->long_des == null) $process->long_des = '';
        $process->save();

        return redirect()->route('process_show_flowchart',compact(['fase_id','theme_id','id']))->with('success', 'Process updated successfully.');
    }

    public function edit_process($fase_id,$theme_id,$id)
    {
        $parent_fase = Phases::find($fase_id);
        $parent_theme = Themes::find($theme_id);
        $process = Processes::find($id);
        $users = User::all();
        $roles = Roles::all();
        $processes = Processes::where('id','!=',$id)->get();
        return view('processes.flowchart_edit',compact(['fase_id','theme_id','id','process','users','roles','processes','parent_fase','parent_theme']));
    }

    public function dashboard(){

        $processes = Processes::orderBy('updated_at','desc')->get();
        $recent_processes = [];
        $count = $processes->count();
        if($count <= 3)
        {
            $recent_processes = $processes;
        }
        else{

            for($i=0; $i<3; $i++)
                array_push($recent_processes,$processes[$i]);
        }
//        dd($recent_processes);
        return view('dashboard.view',compact(['recent_processes']));
    }

    public function search(Request $request){

        $text = $request->get('searchText');
        $processes = Processes::all();
        $searched_pro_ids = [];
        foreach ($processes as $process)
        {
            $process_block = json_decode($process->block_data);
            if($process_block != ''){
                $block_count = count($process_block->name);
                $search_result = false;
                for($i = 0; $i < $block_count; $i++)
                {
                    if(strpos(strtolower($process_block->name[$i]), strtolower($text)) !== false || strpos(strtolower($process_block->des[$i]), strtolower($text)) !== false){
                        $search_result = true;
                        break;
                    }
                }
                if($search_result == true)
                    array_push($searched_pro_ids,$process->id);
            }
        }
        $searched_process_arr = Processes::whereIn('id',$searched_pro_ids)->get();
//        dd(gettype($searched_process_arr));
        return response()->json($searched_process_arr);
    }
}
