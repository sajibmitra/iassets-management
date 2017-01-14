<?php

namespace App\Http\Controllers;
use App\Iasset;
use Request;
use Carbon\Carbon;

class IassetsController extends Controller
{
    public function index(){
    	$assets= Iasset::latest()->get();
    	//$assets= Iasset::order_by('published_at', 'desc')->get();
        return view('iassets.index', compact('assets'));
    }
    public function show($id){
    	//$asset = Iasset::find($id);
    	$asset = Iasset::findOrFail($id);
    	
    	// dd($asset);
    	// return $asset;
    	// if(is_null($asset)){
    	// 	abort(404);
    	// }
    	return view('iassets.show', compact('asset'));
    }
    public function create(){
        return view('iassets.create');       
    }

    public function store(){
        $input  =   Request::all();
        $input['purchase_at'] = Carbon::now();
        $input['entry_at']  =   Carbon::now();
        Iasset::create($input);
        return redirect('assets');
    }
}
