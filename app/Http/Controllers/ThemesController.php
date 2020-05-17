<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemesController extends Controller
{
    public function show()
    {
        $themesJSON =  '[
           {
              "index":"1.1",
              "title":"Voorbereiding Tender",
              "description":"Dit zou een beschrijving kunnen zijn van een thema. Maar je wilt geen sterke verhalen gaan ophangen, gewoon lekker kort en krachtig. Daarom zal deze tekst na 2 lijnen afgekort worden.",
              "route":"/voorbereidingtender"
           },
           {
              "index":"1.2",
              "title":"Calculatie, Ontwerp- en Planfase",
              "description":"Dit zou een beschrijving kunnen zijn van een thema. Maar je wilt geen sterke verhalen gaan ophangen, gewoon lekker kort en krachtig. Daarom zal deze tekst na 2 lijnen afgekort worden.",
              "route":"/calculatieontwerpenplanfase"
           },
           {
              "index":"1.3",
              "title":"Vaststelleninschrijving",
              "description":"Dit zou een beschrijving kunnen zijn van een thema. Maar je wilt geen sterke verhalen gaan ophangen, gewoon lekker kort en krachtig. Daarom zal deze tekst na 2 lijnen afgekort worden.",
              "route":"/vaststelleninschrijving"
           }
        ]';
        $themes = json_decode($themesJSON);

        return view('themes.view', compact("themes"));
    }
}
