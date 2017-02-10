<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Ivendor;

class IvendorsController extends Controller
{
    protected $asset_status   =[
        'GOOD'   => 'GOOD',
        'BAD'   => 'BAD',
        'STORE ROOM' => 'STORE ROOM',
        'On Warranty' => 'On Warranty'
    ];
    public function __construct(){
        $this->middleware('auth');
    }
    public function  index () {
        $objects= Ivendor::all();
        $attributes = ['Name', 'Address', 'Mobile', 'Phone', 'Email'];
        return view('ivendors.index', compact('objects', 'attributes'));
    }
    public function show($id){
        $object= Ivendor::findOrFail($id);
        $iassets= $object->iassets;
        $asset_status= $this->asset_status;
        $attributes = ['Name', 'Address', 'Mobile', 'Phone', 'Email'];
        return view('ivendors.show',compact('object', 'attributes', 'iassets','asset_status'));
    }
    public function create(){
        $attributes = ['Name', 'Address', 'Mobile', 'Phone', 'Email'];
        return view('ivendors.create', compact('attributes'));
    }
    public function store(Request $request){
        $vendor = new Ivendor($request->all());
        $vendor->save();
        return redirect('ivendors');
    }
    public function update(Request $request, $id){
        $vendor = Ivendor::findOrFail($id);
        $vendor->update($request->all());
        return redirect('ivendors');
    }
}