<?php

namespace App\Http\Controllers;
use App\Iresponse;
use App\Http\Requests\CreateIresponseRequest;
use Illuminate\Http\Request;
use App\Iasset;
use App\Iuser;
use App\Ivendor;
Use App\User;

class IresponsesController extends Controller
{
    //Add your attribute into following table carefully[at the bottom of any array...]
    public function __construct(){
        $this->middleware('auth');
    }
    public function  index () {
        $objects= Iresponse::all();
        $attributes = [ 'id','Iuser_Dtl', 'Report_Via', 'Requested_At', 'Problem_Status', 'Respond_By'];
        $allUsers= Iuser::all('id','name')->toArray();
        $user_list = [];
        foreach ($allUsers as $user){
            $user_list[$user['id']]=$user['name'];
        }
        $allResponders= User::all('id','name')->toArray();
        $responder_list = [];
        foreach ($allResponders as $responder){
            $responder_list[$responder['id']]=$responder['name'];
        }
        return view('iresponses.index', compact('objects', 'attributes', 'user_list', 'responder_list'));
    }
    public function show($id){
        $object= Iresponse::findOrFail($id);
        $allAssets = Iasset::all('id','unique_office_id','status')->toArray();
        $asset_list = [];
        foreach ($allAssets as $asset){
            $asset_list[$asset['id']]=$asset['unique_office_id'];
        }
        $users = $object->iusers;
        $allUsers= Iuser::all('id','name')->toArray();
        $user_list = [];
        foreach ($allUsers as $user){
            $user_list[$user['id']]=$user['name'];
        }
        $allResponders= User::all('id','name')->toArray();
        $responder_list = [];
        foreach ($allResponders as $responder){
            $responder_list[$responder['id']]=$responder['name'];
        }
        $attributes = [ 'Iuser_Dtl', 'Iasset_Dtl', 'Report_Via', 'Problem_Dtl', 'Requested_At', 'Finished_At', 'Problem_Status', 'Respond_By', 'Action_Taken', 'Remarks'];
        return view('iresponses.show',compact('object', 'attributes','users', 'user_list','responder_list','asset_list'));
    }
    public function create(){
        $allAssets = Iasset::all('id','unique_office_id','status')->toArray();
        $asset_list = [];
        foreach ($allAssets as $asset){
            $asset_list[$asset['id']]=$asset['unique_office_id'];
        }
        $attributes = [ 'Iuser_Dtl', 'Iasset_Dtl', 'Report_Via', 'Problem_Dtl', 'Requested_At', 'Finished_At', 'Problem_Status', 'Respond_By', 'Action_Taken', 'Remarks'];
        $allUsers= Iuser::all('id','name')->toArray();
        $user_list = [];
        foreach ($allUsers as $user){
            $user_list[$user['id']]=$user['name'];
        }
        $allResponders= User::all('id','name')->toArray();
        $responder_list = [];
        foreach ($allResponders as $responder){
            $responder_list[$responder['id']]=$responder['name'];
        }
        return view('iresponses.create', compact('attributes','user_list', 'asset_list','responder_list'));
    }
    public function store(CreateIresponseRequest $request){
        $response = new Iresponse($request->all());
        $response->save();
        return redirect('iresponses');
    }
   public function update($id, CreateIresponseRequest $request){
       $response = Iresponse::findOrFail($id);
       $response->update($request->all());
       return redirect('iresponses');
    }
}
