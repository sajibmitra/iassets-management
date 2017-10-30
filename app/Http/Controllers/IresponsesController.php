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
        $attributes = [ 'ID','Iasset_Dtl', 'Report_Via', 'Requested_At', 'Problem_Status', 'Respond_By'];
        $problem_list = array_column(Iresponse::distinct()->get(['problem_dtl'])->toArray(), 'problem_dtl');
        $action_list = array_column(Iresponse::distinct()->get(['action_taken'])->toArray(), 'action_taken');
        $allUsers= Iuser::all('id','name')->toArray();
        $user_list = [];
        foreach ($allUsers as $user){
            $user_list[$user['id']]=$user['name'];
        }
        $allAssets = Iasset::all('id','unique_office_id', 'iuser_id')->toArray();
        $asset_list = [];
        foreach ($allAssets as $asset){
            $asset_list[$asset['id']]= $user_list[$asset['iuser_id']].'['.$asset['unique_office_id'].']' ;
        }
        $allResponders= User::all('id','name')->toArray();
        $responder_list = [];
        foreach ($allResponders as $responder){
            $responder_list[$responder['id']]=$responder['name'];
        }
        return view('iresponses.index', compact('objects', 'attributes', 'asset_list', 'responder_list','problem_list','action_list'));
    }
    public function show($id){
        $object= Iresponse::findOrFail($id);
        $problem_list = array_column(Iresponse::distinct()->get(['problem_dtl'])->toArray(), 'problem_dtl');
        $action_list = array_column(Iresponse::distinct()->get(['action_taken'])->toArray(), 'action_taken');
        $allUsers= Iuser::all('id','name')->toArray();
        $user_list = [];
        foreach ($allUsers as $user){
            $user_list[$user['id']]=$user['name'];
        }
        $allAssets = Iasset::all('id','unique_office_id', 'iuser_id')->toArray();
        $asset_list = [];
        foreach ($allAssets as $asset){
            $asset_list[$asset['id']]= $user_list[$asset['iuser_id']].'['.$asset['unique_office_id'].']' ;
        }
        $allResponders= User::all('id','name')->toArray();
        $responder_list = [];
        foreach ($allResponders as $responder){
            $responder_list[$responder['id']]=$responder['name'];
        }
        $attributes = [ 'Iasset_Dtl', 'Report_Via', 'Problem_Dtl', 'Requested_At', 'Finished_At', 'Problem_Status', 'Respond_By', 'Action_Taken', 'Remarks'];
        return view('iresponses.show',compact('object', 'attributes','responder_list','asset_list','problem_list','action_list'));
    }
    public function create(){
        $problem_list = array_column(Iresponse::distinct()->get(['problem_dtl'])->toArray(), 'problem_dtl');
        $action_list = array_column(Iresponse::distinct()->get(['action_taken'])->toArray(), 'action_taken');
        $allUsers= Iuser::all('id','name')->toArray();
        $user_list = [];
        foreach ($allUsers as $user){
            $user_list[$user['id']]=$user['name'];
        }
        $allAssets = Iasset::all('id','unique_office_id', 'iuser_id')->toArray();
        $asset_list = [];
        foreach ($allAssets as $asset){
            $asset_list[$asset['id']]= $user_list[$asset['iuser_id']].'['.$asset['unique_office_id'].']' ;
        }
        $attributes = ['Iasset_Dtl', 'Report_Via', 'Problem_Dtl', 'Requested_At', 'Finished_At', 'Problem_Status', 'Respond_By', 'Action_Taken', 'Remarks'];
        $allResponders= User::all('id','name')->toArray();
        $responder_list = [];
        foreach ($allResponders as $responder){
            $responder_list[$responder['id']]=$responder['name'];
        }
        return view('iresponses.create', compact('attributes', 'asset_list','responder_list', 'problem_list','action_list'));
    }
    public function store(CreateIresponseRequest $request){
        $problem_list = array_column(Iresponse::distinct()->get(['problem_dtl'])->toArray(), 'problem_dtl');
        $action_list = array_column(Iresponse::distinct()->get(['action_taken'])->toArray(), 'action_taken');
        $request['problem_dtl'] = $problem_list[$request['problem_dtl']];
        $request['action_taken'] = $action_list[$request['action_taken']];
        $asset = Iasset::findOrFail($request['iasset_dtl']);
        $request['iuser_dtl'] = $asset['iuser_id'];
        $response = new Iresponse($request->all());
        $response->save();
        return redirect('iresponses');
    }
   public function update($id, CreateIresponseRequest $request){
       $problem_list = array_column(Iresponse::distinct()->get(['problem_dtl'])->toArray(), 'problem_dtl');
       $action_list = array_column(Iresponse::distinct()->get(['action_taken'])->toArray(), 'action_taken');
       $request['problem_dtl'] = $problem_list[$request['problem_dtl']];
       $request['action_taken'] = $action_list[$request['action_taken']];
       $asset = Iasset::findOrFail($request['iasset_dtl']);
       $request['iuser_dtl'] = $asset['iuser_id'];
       $response = Iresponse::findOrFail($id);
       $response->update($request->all());
       return redirect('iresponses');
    }
}
