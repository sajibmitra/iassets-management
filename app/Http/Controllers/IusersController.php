<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateIuserRequest;
use App\Iuser;

class IusersController extends Controller
{
    protected $roles    = [
        'User'  => 'User',
        'Super User' => 'Super User',
        'Admin' => 'Admin',
    ];
    protected $designations = [
        'Officer and below'   => 'Officer and below',
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
        'Establishment'=> ['ED Section'=>'ED Section',
            'GM Section'=>'GM Section',
            'Staff Section'=>'Staff Section',
            'ICT Cell'=>'ICT CELL',
            'Engineering'=>'Engineering',
            'Dead Stock'=>'Dead Stock',
            'Advanced Payment'=>'Advanced Payment',
            'Stationery'=>'Stationery',
            'Bill Pay Section'=>'Bill Pay Section',
            'Verification Unit'=>'Verification Unit',
            'Medical'=>'Medical',
            'Welfare'=>'Welfare'],
        'Small and Medium Enterprise'=> ['SME'=>'SME'],
        'Agriculture and Credit Dept.' => ['ACD'=>'ACD'],
        'Foreign Exchange Policy Dept.'=> ['FEPD'=>'FEPD'],
        'CASH' => ['CASH Administration'=>'CASH Administration',
            'CASH BPS'=>'CASH BPS',
            'CASH Vault'=>'CASH Vault',
            'CASH Pension'=>'CASH Pension',
            'CASH PBS Receipt'=>'CASH PBS Receipt',
            'CASH DAB Counter'=>'CASH DAB Counter'],
        'Banking'=> ['Prize Bond'=>'Prize Bond',
            'PAD'=>'PAD',
            'DAB'=>'DAB',
            'Banking'=>'Banking',
            'Currency'=>'Currency'],
        'Dept. of Bank Inspection'=> ['DBI'=>'DBI',
            'CIPC'=>'CIPC']
    ];

    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $objects= Iuser::orderBy('name')->get();
        $designations= $this->designations;
        $departments= array_keys($this->secDeptMapping);
        $roles = $this->roles;
        $attributes = [ 'Name', 'Department', 'Section', 'Designation', 'Role'];
        return view('iusers.index', compact('objects', 'attributes','designations','roles','departments'));
    }
    public function create(){
        $secDeptMapping=$this->secDeptMapping;
        $designations= $this->designations;
        $roles = $this->roles;
        $attributes = [ 'Name', 'Department', 'Section', 'Designation', 'Contact_No', 'Email', 'Role'];
        return view('iusers.create', compact('object', 'attributes', 'designations','roles','iassets', 'secDeptMapping'));
    }
    public function show($id){
        $object= Iuser::findOrFail($id);
        $iassets= $object->iassets;
        $departments= array_keys($this->secDeptMapping);
        $secDeptMapping=$this->secDeptMapping;
        $designations= $this->designations;
        $roles = $this->roles;
        $attributes = [ 'Name', 'Department', 'Section', 'Designation', 'Contact_No', 'Email', 'Role'];
        return view('iusers.show', compact('object', 'attributes', 'designations','roles','iassets','secDeptMapping','departments'));
    }
    public function store(CreateIuserRequest $request){
        $request['contact_no']='XXXXXXXXXXX';
        $this->validate($request, [
            //cheange this
        //'contact_no' => 'required|size:11|unique:iusers',
            //'email' => 'required|unique:iusers',
        ]);
        $request['password']='_NOT_SET_';
        $user = new Iuser($request->all());
        $user->save();
        return redirect('iusers');
    }
    public function update($id, CreateIuserRequest $request){
        $user = Iuser::findOrFail($id);
        $user->update($request->all());
        return redirect('iusers');
    }
}
