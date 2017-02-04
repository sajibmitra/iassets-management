<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Iuser;

class IusersController extends Controller
{
    protected $roles    = [
        'User'  => 'USR__',
        'Super User' => 'SU___',
        'Admin' => 'ADMIN'
    ];
    protected $designations = [
        'Not Assigned' => 'NA__',
        'Governor'   => 'G__',
        'Deputy Governor' => 'DG_',
        'Executive Director'   => 'ED_',
        'General Manager' => 'GM_',
        'Deputy General Manager' => 'DGM',
        'Joint Director' => 'JD_',
        'Deputy Director' => 'DD_',
        'Assistant Director' => 'AD_',
        'Officer'   => 'OFF'
    ];
    protected $departments = [
        'Not Assigned' => 'NA__',
        'Establishment'   => 'EST_',
        'Foreign Exchange Policy Dept.' => 'FEPD',
        'CASH'   => 'CASH',
        'Dept. of Bank Inspection' => 'DBI_',
        'Banking' => 'BNK_',
        'Agriculture and Credit Dept.' => 'ACD_',
        'SME and Special Programs Dept.' => 'SME_'
    ];
    protected $sections = [
        'Not Assigned' => 'NA_',
        'Staff Section' => 'STF',
        'Dead Stock' => 'DS_',
        'GM Section'   => 'GM_',
        'ED Section'   => 'ED_',
        'Advanced Payment'=> 'AVP',
        'Engineering'   => 'ENG',
        'ICT CELL'    => 'ICT',
        'Stationery'=> 'STA',
        'Bill Pay Section' => 'BPS',
        'CASH'   => 'CAS',
        'Medical'    => 'MED',
        'Welfare'=> 'WEL',
        'Dept. of Bank Inspection' => 'DBI',
        'Prize Bond'   => 'PBS',
        'PAD'    => 'PAD',
        'DAB'=> 'DAB',
        'Banking' => 'BNK',
        'CIPC'   => 'CMS',
        'Store Room' => 'STR'
    ];

    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $objects= Iuser::all();
        $sections=array_keys($this->sections);
        $departments=array_keys($this->departments);
        $designations= array_keys($this->designations);
        $roles = array_keys($this->roles);
        $attributes = [ 'Name', 'Department', 'Section', 'Designation', 'Contact_No', 'Email', 'Role'];
        return view('iusers.index', compact('objects', 'attributes','designations','departments','sections','roles'));
    }
    public function create(){
        $attributes = [ 'Name', 'Department', 'Section', 'Designation', 'Contact_No', 'Email', 'Role'];
        $sections=array_keys($this->sections);
        $departments=array_keys($this->departments);
        $designations= array_keys($this->designations);
        $roles = array_keys($this->roles);
        return view('iusers.create', compact('object', 'attributes','sections','departments', 'designations','roles','iassets'));
    }
    public function show($id){
        $object= Iuser::findOrFail($id);
        $iassets= $object->iassets;
        $attributes = [ 'Name', 'Department', 'Section', 'Designation', 'Contact_No', 'Email', 'Role'];
        $sections=array_keys($this->sections);
        $departments=array_keys($this->departments);
        $designations= array_keys($this->designations);
        $roles = array_keys($this->roles);
        return view('iusers.show', compact('object', 'attributes','sections','departments', 'designations','roles','iassets'));
    }
    public function store(Request $request){
        $request['password']='_NOT_SET_';
        $user = new Iuser($request->all());
        $user->save();
        return redirect('iusers');
    }
    public function update($id, Request $request){
        $user = Iuser::findOrFail($id);
        $user->update($request->all());
        return redirect('iusers');
    }
}