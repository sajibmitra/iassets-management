<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function contact(){
        $people = [
            'Taylor Otwell', 'Dayle Rees', 'Eric Barnes'
        ];
        return view('pages.contact', compact('people'));
    }
    public function about(){
    /*	$name = 'Sajib <span style="color: red;"> Mitra </span>';
    return view('pages.about')->with('name', $name);*/
    
    	/*return view('pages.about')->with([
    		'first' => 'Sajib',
    		'last'	=> 'Mitra'
    	]);*/
    
        /*$data = [];
        $data['first']  =   'Sajib';
        $data['last']   =   'Mitra';
    return view('pages.about')->with($data);*/
        $first  =   'Sajib';
        $last   =   'Mitra';
        return view('pages.about', compact('first','last'));
    }
}
