<?php

namespace App\Http\Controllers;
use App\Iasset;
use Carbon\Carbon;
use App\Http\Requests\IassetRequest;

class IassetsController extends Controller
{
    public function index(){
    	//$assets= Iasset::latest()->get();
    	//$assets= Iasset::order_by('published_at', 'desc')->get();
        $assets = Iasset::latest('purchase_at')->purchased()->get();
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

    public function store(IassetRequest $request){
        Iasset::create($request->all());
        return redirect('assets');
    }
    public function edit($id){
        $asset = Iasset::findOrFail($id);
        return view('iassets.edit', compact('asset'));
    }
    public function update(IassetRequest $request, $id){
        $asset = Iasset::findOrFail($id);
        $asset->update($request->all());
        return redirect('assets');
    }
}