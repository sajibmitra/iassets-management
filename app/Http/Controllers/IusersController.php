<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Iuser;

class IusersController extends Controller
{
    protected $roles    = [
        'User'  => 'User',
        'Super User' => 'Super User',
        'Admin' => 'Admin',
    ];
    protected $designations = [
        'Officer'   => 'Officer',
        'Assistant Director' => 'Assistant Director',
        'Deputy Director' => 'Deputy Director',
        'Joint Director' => 'Joint Director',
        'Deputy General Manager' => 'Deputy General Manager',
        'General Manager' => 'General Manager',
        'Executive Director'   => 'Executive Director',
        'Deputy Governor' => 'Deputy Governor',
        'Governor'   => 'Governor',
    ];
    protected $secDeptMapping = [
        'Establishment'=> array('ED Section'=>'ED Section',
            'GM Section'=>'GM Section',
            'Staff Section'=>'Staff Section',
            'ICT CELL'=>'ICT CELL',
            'Engineering'=>'Engineering',
            'Dead Stock'=>'Dead Stock',
            'Advanced Payment'=>'Advanced Payment',
            'Stationery'=>'Stationery',
            'Bill Pay Section'=>'Bill Pay Section',
            'Verification Unit'=>'Verification Unit',
            'Medical'=>'Medical',
            'Welfare'=>'Welfare'),
        'Small and Medium Enterprise'=> array('SME'=>'SME'),
        'Agriculture and Credit Dept.' => array('ACD'=>'ACD'),
        'Foreign Exchange Policy Dept.'=> array('FEPD'=>'FEPD'),
        'CASH' => array('CASH Administration'=>'CASH Administration',
            'CASH BPS'=>'CASH BPS',
            'CASH Vault'=>'CASH Vault',
            'CASH Pension'=>'CASH Pension',
            'CASH PBS Receipt'=>'CASH PBS Receipt'),
        'Dept. of Bank Inspection'=> array('DBI'=>'DBI', 'CIPC'=>'CIPC'),
        'Banking'=> array('Prize Bond'=>'Prize Bond', 'PAD'=>'PAD','DAB'=>'DAB', 'Banking'=>'Banking')
    ];

    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $objects= Iuser::all();
        $designations= $this->designations;
        $departments= array_keys($this->secDeptMapping);
        $roles = $this->roles;
        $attributes = [ 'Name', 'Department', 'Section', 'Designation', 'Contact_No', 'Email', 'Role'];
        return view('iusers.index', compact('objects', 'attributes','designations','roles','departments'));
    }
    public function create(){
        $attributes = [ 'Name', 'Department', 'Section', 'Designation', 'Contact_No', 'Email', 'Role'];
        $secDeptMapping=$this->secDeptMapping;
        $designations= $this->designations;
        $roles = $this->roles;
        return view('iusers.create', compact('object', 'attributes', 'designations','roles','iassets', 'secDeptMapping'));
    }
    public function show($id){
        $object= Iuser::findOrFail($id);
        $iassets= $object->iassets;
        $departments= array_keys($this->secDeptMapping);
        $attributes = [ 'Name', 'Department', 'Section', 'Designation', 'Contact_No', 'Email', 'Role'];
        $secDeptMapping=$this->secDeptMapping;
        $designations= $this->designations;
        $roles = $this->roles;
        return view('iusers.show', compact('object', 'attributes', 'designations','roles','iassets','secDeptMapping','departments'));
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