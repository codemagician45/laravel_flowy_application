<?php

namespace App\Http\Controllers;

use App\Exports\ProcessExport;
use App\Model\Phases;
use App\Model\Processes;
use App\Model\Roles;
use App\Model\Themes;
use App\User;
use function Clue\StreamFilter\fun;
use Illuminate\Http\Request;
use Excel;
use Symfony\Component\Process\Process;

class ProcessesController extends Controller
{
    public function show($fase_id,$theme_id){
        $parent_fase = Phases::find($fase_id);
        $parent_theme = Themes::find($theme_id);
        $processes = Processes::where('theme_id',$theme_id)->where('active',1)->get();
        return view('processes.view', compact(['processes','fase_id','theme_id','parent_fase','parent_theme']));
    }

    public function create($fase_id,$theme_id)
    {
        $parent_fase = Phases::find($fase_id);
        $parent_theme = Themes::find($theme_id);
        return view('processes.create', compact(['fase_id','theme_id','parent_fase','parent_theme']));
    }
    public function edit($fase_id,$theme_id,$id){
        $process = Processes::find($id);
        $parent_fase = Phases::find($fase_id);
        $parent_theme = Themes::find($theme_id);
        return view('processes.edit', compact(['fase_id','theme_id','id','parent_fase','parent_theme','process']));
    }
    public function update($fase_id,$theme_id,$id, Request $request){
        $request->validate(['name' => 'required',
                'description' => 'required',
                'sysnum' => 'required']
        );
        $process = Processes::find($id);
        $process->name = $request->get('name');
        $process->description = $request->get('description');
        $process->sysnum = $request->get('sysnum');
        $process->save();

        return redirect()->route('processes',['fase_id'=>$fase_id,'theme_id'=>$theme_id])->with('success','Process updated successfully.');
    }

    public function destroy($fase_id, $theme_id, $id){

        $process = Processes::find($id);
        $process->active = 0;
        $process->save();
        return redirect()->route('processes',['fase_id'=>$fase_id,'theme_id'=>$theme_id])->with('success','Process deleted successfully.');
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
            'user_id' => auth()->user()->id
        ]);
        $process->save();
        return redirect()->route('processes',compact(['fase_id','theme_id']))->with('success', 'Process created successfully.');
    }

    public function show_process($fase_id,$theme_id,$id){

        $process = Processes::find($id);
        $parent_fase = Phases::find($fase_id);
        $parent_theme = Themes::find($theme_id);
        $user_make_changed = User::find($process->user_make_changed);
        $role_data = json_decode($process->role_data);
        $role_arr = [];
        if($role_data != '')
            foreach ($role_data as $role){
                array_push($role_arr,Roles::find($role));
            }
        return view('processes.flowchart_show',compact(['fase_id','theme_id','id','process','parent_fase','parent_theme','role_arr','user_make_changed']));
    }

    public function update_process($fase_id,$theme_id,$id, Request $request)
    {
        $process = Processes::find($id);
        $process->flowchart = $request->get('flowchart_data');
        $process->long_des = $request->get('long_des');
        $process->block_data = $request->get('block_data');
        $process->role_data = $request->get('role_data');
        $process->commit = $request->get('change-commit');
        $process->user_make_changed = auth()->user()->id;
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

        $recent_processes = Processes::where('active',1)->orderBy('updated_at','desc')->limit(3)->get();
        return view('dashboard.view',compact(['recent_processes']));
    }

    public function search(Request $request){

        $text = $request->get('search_text');
        $processes = Processes::where('active',1)->get();
        $searched_pro_ids = [];
        if($text)
            foreach ($processes as $process)
            {
                $process_block = json_decode($process->block_data);
                if($process_block != ''){
                    $block_count = count($process_block);
                    $search_result = false;
                    for($i = 0; $i < $block_count; $i++)
                    {
                        if(isset($process_block[$i]->name))
                            if(strpos(strtolower($process_block[$i]->name), strtolower($text)) !== false || strpos(strtolower($process_block[$i]->des), strtolower($text)) !== false){
                                $search_result = true;
                                break;
                            }
                    }
                    if($search_result == true)
                        array_push($searched_pro_ids,$process->id);
                }
            }
        $searched_process_arr = Processes::whereIn('id',$searched_pro_ids)->get();
        return response()->json($searched_process_arr);
    }
    public function export_excel($fase_id, $theme_id, $id){
        $process = Processes::find($id);
        return Excel::download(new ProcessExport($id),'Process.xlsx');
    }
}
