<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateIassetRequest;
use Illuminate\Http\Request;
use App\Iasset;
use App\Iuser;
use App\Ivendor;
class IassetsController extends Controller
{
    //Add your attribute into following table carefully[at the bottom of any array...]
    protected $asset_status   =[
        'GOOD'   => 'GOOD',
        'BAD'   => 'BAD',
        'STORE ROOM' => 'STORE ROOM',
        'On Warranty' => 'On Warranty'
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
        'Router'    => 'RU',
    ];

    protected $sections = [
        'ED Section'   => 'ED_',
        'GM Section'   => 'GM_',
        'Staff Section' => 'STF',
        'ICT Cell'    => 'ICT',
        'Engineering'   => 'ENG',
        'Dead Stock' => 'DS_',
        'Advanced Payment'=> 'AVP',
        'Stationery'=> 'STA',
        'Bill Pay Section' => 'BPS',
        'Verification Unit' => 'VU_',
        'Medical'    => 'MED',
        'Welfare'=> 'WEL',
        'SME'  => 'SME',
        'ACD' => 'ACD',
        'FEPD'=> 'FEPD',
        'CASH Administration'   => 'C-A',
        'CASH BPS' => 'C-B',
        'CASH Vault'=> 'C-V',
        'CASH Pension'=> 'C-P',
        'CASH PBS Receipt' => 'CPR',
        'DBI' => 'DBI',
        'CIPC' => 'CMS',
        'Prize Bond'   => 'PBS',
        'PAD'    => 'PAD',
        'DAB'=> 'DAB',
        'Banking' => 'BNK',
        'Store Room' => 'STR',
    ];
    public function __construct(){
        $this->middleware('auth');
    }

    public function  index () {
        $objects= Iasset::latest('updated_at')->get();
        $attributes = [ 'Unique_Office_Id', 'Type', 'Brand', 'Entry_At', 'Status', 'Iuser_Id', 'Ivendor_Id'];
        $allUsers= Iuser::all('id','name')->toArray();
        $user_list = [];
        foreach ($allUsers as $user){
            $user_list[$user['id']]=$user['name'];
        }
        $vendors= Ivendor::all('id','name');
        $vendor_list = [];
        foreach ($vendors as $vendor){
            $vendor_list[$vendor['id']]=$vendor['name'];
        }
        $types = array_keys($this->asset_type);
        $asset_status=$this->asset_status;
        $asset_brand=array_keys($this->asset_brand);
        return view('iassets.index', compact('objects', 'attributes', 'types','asset_status','asset_brand','user_list','vendor_list'));
    }
    public function show($id){
        $object= Iasset::findOrFail($id);
        $users = $object->iusers;
        $allUsers= Iuser::all('id','name')->toArray();
        $user_list = [];
        foreach ($allUsers as $user){
            $user_list[$user['id']]=$user['name'];
        }
        $vendors= Ivendor::all('id','name');
        $vendor_list = [];
        foreach ($vendors as $vendor){
            $vendor_list[$vendor['id']]=$vendor['name'];
        }
        $attributes = [ 'Type', 'Brand', 'Model', 'Serial_id', 'Product_ID', 'Purchase_at', 'Entry_At', 'Warranty', 'Status', 'Iuser_Id', 'Ivendor_Id'];
        $types = array_keys($this->asset_type);
        $asset_status=$this->asset_status;
        $asset_brand=array_keys($this->asset_brand);
        return view('iassets.show',compact('object', 'attributes', 'types', 'asset_status','asset_brand','users', 'user_list', 'vendor_list'));
    }
    public function create(){
        $attributes = [ 'Type', 'Brand', 'Model', 'Serial_id', 'Product_ID', 'Unique_Office_Id', 'Purchase_at', 'Entry_At', 'Warranty', 'Status', 'Iuser_Id', 'Ivendor_Id'];
        $allUsers= Iuser::all('id','name')->toArray();
        $user_list = [];
        foreach ($allUsers as $user){
            $user_list[$user['id']]=$user['name'];
        }
        $vendors= Ivendor::all('id','name');
        $vendor_list = [];
        foreach ($vendors as $vendor){
            $vendor_list[$vendor['id']]=$vendor['name'];
        }
        $types = array_keys($this->asset_type);
        $asset_status=$this->asset_status;
        $asset_brand=array_keys($this->asset_brand);
        return view('iassets.create', compact('attributes','types', 'asset_status', 'asset_brand','user_list','vendor_list'));
    }
    public function store(CreateIassetRequest $request){
        $request['iasset_id']= $this->getIassetId($request);
        $request['unique_office_id']=$this->asset_type[array_keys($this->asset_type)[$request->get('type')]].'-'.$request->get('unique_office_id');
        $asset = new Iasset($request->all());
        $asset->save();
        $asset->iusers()->attach($asset->iuser_id);
        return redirect('iassets');
    }
   public function update($id, Request $request){
       $asset = Iasset::findOrFail($id);
       //$request['iasset_id']= $this->getIassetId($request);
       $asset->update($request->all());
       $asset->iusers()->attach($asset->iuser_id);
       return redirect('iassets');
    }
    /**
     * @param Request $request
     */
    public function getIassetId(CreateIassetRequest $request)
    {
        $type=$this->asset_type[array_keys($this->asset_type)[$request->get('type')]];
        $brand=$this->asset_brand[array_keys($this->asset_brand)[$request->get('brand')]];
        $date = $request->get('entry_at');
        $yy= substr($date,2,2);
        $mm= substr($date,5,2);
        $dd= substr($date,8,2);
        $section=$this->sections[Iuser::findOrFail($request['iuser_id'])['section']];
        $warranty= $request->get('warranty');
        $serial = Iasset::where('type', '=', $request->get('type'))->count();
        return $type.$dd.$mm.$yy.$brand.$warranty.$section.$serial;
    }
}