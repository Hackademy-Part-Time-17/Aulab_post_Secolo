<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;//Per prendere i dati dell'utente autenticato 
use App\Models\Article;


class WriterController extends Controller
{
    public function dashboard(){
        $articles=Auth::user()->articles()->orderBy('created_at','DESC')->get();
        $unrevisionedArticles=$articles->where('is_accepted', NULL);
        $rejectedArticles=$articles->where('is_accepted',false);
        $acceptedArticles=$articles->where('is_accepted',true);
        return view('writer.dashboard',compact('unrevisionedArticles','rejectedArticles','acceptedArticles'));
    }
}
