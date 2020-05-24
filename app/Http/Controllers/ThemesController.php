<?php

namespace App\Http\Controllers;

use App\Model\Phases;
use App\Model\Processes;
use App\Model\Themes;
use Illuminate\Http\Request;

class ThemesController extends Controller
{
    public function show($fase_id)
    {
        $themes = Themes::where('fase_id',$fase_id)->where('active',1)->get();
        $parent_fase = Phases::find($fase_id);
        return view('themes.view', compact(['themes','fase_id','parent_fase']));
    }
    public function create($fase_id)
    {
        $parent_fase = Phases::find($fase_id);
        return view('themes.create', compact(['fase_id','parent_fase']));
    }

    public function store(Request $request,$fase_id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'sysnum' => 'required'
        ]);
        $theme = new Themes([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'sysnum' => $request->get('sysnum'),
            'fase_id' => $fase_id,
            'user_id' => auth()->user()->id
        ]);
        $theme->save();
        return redirect()->route('themes',['fase_id'=>$fase_id])->with('success','Theme created successfully.');
    }
    public function edit($fase_id,$id)
    {
        $theme = Themes::find($id);
        $parent_fase = Phases::find($fase_id);
        return view('themes.edit',compact(['theme','parent_fase','fase_id']));
    }
    public function update($fase_id,$id,Request $request)
    {
        $request->validate([
                'name' => 'required',
                'description' => 'required',
                'sysnum' => 'required']
        );
        $theme = Themes::find($id);
        $theme->name = $request->get('name');
        $theme->description = $request->get('description');
        $theme->sysnum = $request->get('sysnum');

        $theme->save();
        return redirect()->route('themes',['fase_id'=>$fase_id])->with('success','Theme updated successfully.');
    }
    public function destroy($fase_id,$id)
    {
        $theme = Themes::find($id);
        $theme->active = 0;
        $theme->save();
        $children_processes = Processes::where('theme_id',$id)->get();
        foreach ($children_processes as $cprocess){
            $cprocess->active = 0;
            $cprocess->save();
        }
//        $theme->delete();
        return redirect()->route('themes',['fase_id'=>$fase_id])->with('success','Theme(his children) deleted successfully.');
    }
}
