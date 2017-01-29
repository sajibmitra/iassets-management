<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Iasset;
use App\User;
use App\Ivendor;
class IassetsController extends Controller
{
    //Add your attribute into following table carefully[at the bottom of any array...]
    protected $asset_status   =[
        'GOOD'   => 'GDD',
        'BAD'   => 'BAD',
        'STORE ROOM' => 'DAM',
        'On Warranty' => 'WNT'
    ];
    protected $asset_brand   =[
        'Apple' => 'APPLE',
        'HP' => 'HP___',
        'Dell'   => 'DELL_',
        'Lenovo'   => 'LENVO',
        'Asus' => 'ASUS_',
        'Acer' => 'ACER_',
        'Epson' => 'EPSON',
        'Samsung' => 'SAMSG',
        'LG'    => 'LG___',
        'Toshiba' => 'TSIBA',
        'SONY'  => 'SONY_',
        'Prolink' => 'PLINK'
    ];
    protected $asset_type = [
        'CPU'   => 'BC',
        'Monitor' => 'BM',
        'UPS'   => 'BU',
        'Printer'=> 'BP',
        'Scanner' => 'BS',
        'Switch'   => 'SW',
        'Projector' => 'PJ',
        'Router'    => 'RU'
    ];

    protected $sections = [
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

    public function  index () {
        $objects= Iasset::latest('updated_at')->get();
        $attributes = [ 'Unique_Office_Id', 'Type', 'Brand', 'Entry_At', 'Status', 'Section', 'User_Id', 'Ivendor_Id'];
        $user_list= array_keys(User::all()->keyBy('name')->toArray());
        array_unshift($user_list, 'Select One');
        $vendor_list= array_keys(Ivendor::all()->keyBy('name')->toArray());
        array_unshift($vendor_list, 'Select One');
        $types = array_keys($this->asset_type);
        $sections=array_keys($this->sections);
        $asset_status=array_keys($this->asset_status);
        $asset_brand=array_keys($this->asset_brand);
        return view('iassets.index', compact('objects', 'attributes', 'types', 'sections','asset_status','asset_brand','user_list','vendor_list'));
    }
    public function show($id){
        $object= Iasset::findOrFail($id);
        $users = $object->users;
        $user_list= array_keys(User::all()->keyBy('name')->toArray());
        array_unshift($user_list, 'Select One');
        $vendor_list= array_keys(Ivendor::all()->keyBy('name')->toArray());
        array_unshift($vendor_list, 'Select One');
        $attributes = [ 'Unique_Office_Id', 'Type', 'Brand', 'Model', 'Serial_id', 'Product_ID', 'Purchase_at', 'Entry_At', 'Warranty', 'Status', 'Section', 'User_Id', 'Ivendor_Id'];
        $types = array_keys($this->asset_type);
        $sections=array_keys($this->sections);
        $asset_status=array_keys($this->asset_status);
        $asset_brand=array_keys($this->asset_brand);
        return view('iassets.show',compact('object', 'attributes', 'types', 'sections','asset_status','asset_brand','users', 'user_list', 'vendor_list'));
    }
    public function create(){
        $attributes = [ 'Type', 'Brand', 'Model', 'Serial_id', 'Product_ID', 'Unique_Office_Id', 'Purchase_at', 'Entry_At', 'Warranty', 'Status', 'Section', 'User_Id', 'Ivendor_Id'];
        $user_list= array_keys(User::all()->keyBy('name')->toArray());
        array_unshift($user_list, 'Select One');
        $vendor_list= array_keys(Ivendor::all()->keyBy('name')->toArray());
        array_unshift($vendor_list, 'Select One');
        $types = array_keys($this->asset_type);
        $sections=array_keys($this->sections);
        $asset_status=array_keys($this->asset_status);
        $asset_brand=array_keys($this->asset_brand);
        return view('iassets.create', compact('attributes','types','sections','asset_status', 'asset_brand','user_list','vendor_list'));
    }
    public function store(Request $request){
        $request['iasset_id']= $this->getIassetId($request);
        $request['unique_office_id']=$this->asset_type[array_keys($this->asset_type)[$request->get('type')]].'-'.$request->get('unique_office_id');
        $asset = new Iasset($request->all());
        $asset->save();
        $asset->users()->attach($asset->user_id);
        return redirect('iassets');
    }
   public function update($id, Request $request){
       $asset = Iasset::findOrFail($id);
       //$request['iasset_id']= $this->getIassetId($request);
       $asset->update($request->all());
       $asset->users()->attach($asset->user_id);
       return redirect('iassets');
    }
    /**
     * @param Request $request
     */
    public function getIassetId(Request $request)
    {
        $type=$this->asset_type[array_keys($this->asset_type)[$request->get('type')]];
        $brand=$this->asset_brand[array_keys($this->asset_brand)[$request->get('brand')]];
        $date = $request->get('entry_at');
        $yy= substr($date,2,2);
        $mm= substr($date,5,2);
        $dd= substr($date,8,2);
        $section=$this->sections[array_keys($this->sections)[$request->get('section')]];
        $warranty= $request->get('warranty');
        $serial = Iasset::where('type', '=', $request->get('type'))->count();
        return $type.$dd.$mm.$yy.$brand.$warranty.$section.$serial;
    }
}