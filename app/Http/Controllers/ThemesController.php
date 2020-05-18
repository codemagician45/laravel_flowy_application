<?php

namespace App\Http\Controllers;

use App\Model\Themes;
use Illuminate\Http\Request;

class ThemesController extends Controller
{
    public function show($fase_id)
    {
        $themes = Themes::where('fase_id',$fase_id)->get();
        return view('themes.view', compact(['themes','fase_id']));
    }
    public function create($fase_id)
    {
        return view('themes.create', compact('fase_id'));
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
            'fase_id' => $fase_id
        ]);
        $theme->save();
        return redirect()->route('themes',['fase_id'=>$fase_id])->with('success','Theme created successfully.');
    }
    public function edit($fase_id,$id)
    {
        $theme = Themes::find($id);
        return view('themes.edit',compact('theme'));
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
        $theme->delete();
        return redirect()->route('themes',['fase_id'=>$fase_id])->with('success','Theme deleted successfully.');
    }
}
