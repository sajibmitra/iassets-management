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
    protected $asset_type = [
        'CPU'   => 'BC',
        'Monitor' => 'BM',
        'UPS'   => 'BU',
        'Printer'=> 'BP',
        'Scanner' => 'BS',
        'Switch'   => 'BW',
        'Projector' => 'BJ',
        'Router'    => 'BR',
        'Laptop'    => 'BL',
        'iPad'  => 'BI'
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
        'Prolink' => 'PLINK',
        'Power Pack'=> 'PPACK',
        'PC Power' => 'PCPOW',
        'Power Guard'=> 'POWGD',
        'IOE LEUMS' => 'LEUMS',
        'FLORA UPS' => 'FLORA',
        'CLONE' => 'CLONE',
        'Power Box'=> 'PBOX_',
        'Canon' => 'CANON',
        'APC' => 'APC__',
        'Konica' => 'KONIC',
        'PowerP5Sonic' => 'PP5SO',
        'NOVA' => 'NOVA_',
        'L-TECH' => 'LTECH',
        'iNeat Ups'=> 'INEAT',
        'Signal Digital Electronics' => 'SDELEC',
        'dbm' => 'DBM__',
        'Index' => 'INDEX',
        'Other' => 'OTHER'
    ];
    protected $brandModelMapping =[
        'HP'=> ['Compaq dx7400 MT', 'Compaq dx7300 MT', 'Pro 2000 MT', 'Prodesk 600 G1 SFF', 'Prodesk 600 G2 SFF', 'V194', 'LV1191','L1710Sc'],
        'Dell' => ['Vostro 460', 'Optiplex 390', 'Optiplex 3020', 'Optiplex 3040','E190Hf'],
        'Sumsang' => ['S19B150B'],
        'Prolink' => ['Pro700c', '700c'],
        'Power Pack' => ['Pro700'],
        'PC Power' => [],
        'Power Guard' => [],
        'Power Pack' =>[],
        'IOE LEUMS' =>['1000c'],
        'FLORA UPS' =>[],
        'Power Box' =>[],
    ];

    protected $asset_status   =[
        'GOOD'   => 'GOOD',
        'BAD'   => 'BAD',
        'Faulty Display' => 'Faulty Display',
        'No Display' => 'No Display',
        'Faulty Mother Board' => 'Faulty Mother Board',
        'Faulty Power Supply' =>'Faulty Power Supply',
        'OS loading Problem' =>'OS loading Problem',
        'STORE ROOM' => 'STORE ROOM',
        'On Warranty' => 'On Warranty'
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
        'FEPD'=> 'FEP',
        'CASH Administration'   => 'C_A',
        'CASH BPS' => 'C_B',
        'CASH Vault'=> 'C_V',
        'CASH Pension'=> 'C_P',
        'CASH PBS Receipt' => 'C_R',
        'CASH DAB Counter' => 'C_D',
        'Prize Bond'   => 'PBS',
        'PAD'    => 'PAD',
        'DAB'=> 'DAB',
        'Banking' => 'BNK',
        'Currency' => 'CUR',
        'DBI' => 'DBI',
        'CIPC' => 'CMS',
        'ICT Store Room' => 'STR',
        'DS Store Room' => 'DSR',
    ];
    public function __construct(){
        $this->middleware('auth');
    }
    public function  index () {
        $objects= Iasset::latest('updated_at')->get();
        $attributes = [ 'Unique_Office_Id', 'Type', 'Brand', 'Model', 'Serial_Id', 'Product_ID', 'Purchase_At', 'Status', 'Iuser_Id','Ivendor_Id'];
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
        $prequest = $request;
        $prequest['unique_office_id']=$this->asset_type[array_keys($this->asset_type)[$request->get('type')]].'-'.$request->get('unique_office_id');
        $this->validate($prequest, [
            'unique_office_id' => 'required|unique:iassets',
            'serial_id' => 'required|unique:iassets',
        ]);
        $asset = new Iasset($request->all());
        $asset->save();
        $asset->iusers()->attach($asset->iuser_id);
        return redirect('iassets');
    }
   public function update($id, Request $request){
       $asset = Iasset::findOrFail($id);
       $userChanged = true;
       if($asset['iuser_id'] == $request['iuser_id'])
           $userChanged= false;
       $asset->update($request->all());
       if($userChanged){
           $asset->iusers()->attach($asset->iuser_id);
       }
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
