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
        dd($fase_id);
    }
}
