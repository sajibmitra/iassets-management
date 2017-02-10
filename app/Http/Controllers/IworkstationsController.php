<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Iasset;
use App\Iuser;
use App\Iworkstation;
class IworkstationsController extends Controller
{
    public $net_switch_list =[
        'BAR-MA-01-ASW-01' => '10.96.255.101',
        'BAR-MA-02-ASW-02' => '10.96.255.102',
        'BAR-MA-03-ASW-03' => '10.96.255.103',
        'BAR-MA-04-ASW-04' => '10.96.255.104',
        'BAR-MA-05-ASW-05' => '10.96.255.105'
    ];
    public $os_info_list =[
        'WX32' => 'WinXP_X86_32bit',
        'WX64' => 'WinXP_X86_64bit',
        'W732' => 'Win7_X86_32bit',
        'W764' => 'Win7_X86_64bit',
        'W832' => 'Win8_X86_32bit',
        'W864' => 'Win8_X86_64bit',
        'W032' => 'Win10_X86_32bit',
        'W064' => 'Win10_X86_64bit'
    ];
    //Add your attribute into following table carefully[at the bottom of any array...]
    public function __construct(){
        $this->middleware('auth');
    }
    public function  index () {
        $objects= Iworkstation::latest('updated_at')->get();
        $attributes = [ 'Iworkstation_Id', 'Net_Switch_Id', 'Net_Login_Status', 'OS_Detail_Info', 'Lnk_Printer_Id', 'Iuser_Id'];
        $os_info_list= $this->os_info_list;
        $net_switch_list= array_keys($this->net_switch_list);
        $lnk_printers= Iasset::all('id','unique_office_id','type')->where('type','3')->toArray();
        $lnk_printer_list = [];
        foreach ($lnk_printers as $printer){
            $lnk_printer_list[$printer['id']]=$printer['unique_office_id'];
        }
        $allUsers= Iuser::all('id','name')->toArray();
        $user_list = [];
        foreach ($allUsers as $user) {
            $user_list[$user['id']]=$user['name'];
        }
//        dd(view('iworkstations.index', compact('objects', 'attributes', 'user_list','os_info_list','net_switch_list','lnk_printer_list')));
        return view('iworkstations.index', compact('objects', 'attributes', 'user_list','os_info_list','net_switch_list','lnk_printer_list'));
    }
    public function show($id){
        $object= Iworkstation::findOrFail($id);
        $users = $object->iusers;
        $lnkAssets = $object->iassets;
        $assets=[];
        foreach ($lnkAssets as $asset){
            $assets[$asset['id']]=$asset['unique_office_id'];
        }
        $os_info_list= $this->os_info_list;

        $net_switch_list= array_keys($this->net_switch_list);
        $allAssets = Iasset::all('id','unique_office_id')->toArray();
        $asset_list =[];
        foreach ($allAssets as $asset){
            $asset_list[$asset['id']]=$asset['unique_office_id'];
        }
        $allUsers= Iuser::all('id','name')->toArray();
        $user_list = [];
        foreach ($allUsers as $user) {
            $user_list[$user['id']]=$user['name'];
        }
        $lnk_printers= Iasset::all('id','unique_office_id','type')->where('type','3')->toArray();
        $lnk_printer_list = [];
        foreach ($lnk_printers as $printer){
            $lnk_printer_list[$printer['id']]=$printer['unique_office_id'];
        }
        $attributes = [ 'Net_Switch_Id', 'Net_Switch_Port', 'Net_DHCP_Ip', 'Net_MAC_Id', 'Net_Login_Status', 'Net_Faceplate_Id', 'OS_Detail_Info', 'Lnk_Printer_Id', 'Sys_Product_Id', 'Iuser_Id','Asset_List'];
        return view('iworkstations.show', compact('object', 'attributes','users','assets', 'user_list','os_info_list', 'net_switch_list','lnk_printer_list','asset_list'));
    }
    public function create(){
        $attributes = [ 'Iuser_Id','Net_Switch_Id', 'Net_Switch_Port', 'Net_DHCP_Ip', 'Net_MAC_Id', 'Net_Login_Status', 'Net_Faceplate_Id', 'OS_Detail_Info', 'Lnk_Printer_Id', 'Sys_Product_Id', 'Asset_List'];

        $allAssets = Iasset::all('id','unique_office_id')->toArray();
        $asset_list = [];
        foreach ($allAssets as $asset){
            $asset_list[$asset['id']]=$asset['unique_office_id'];
        }
        $allUsers= Iuser::all('id','name')->toArray();
        $user_list= [];
        foreach ($allUsers as $user) {
            $user_list[$user['id']]=$user['name'];
        }
        $os_info_list= $this->os_info_list;
        $net_switch_list= array_keys($this->net_switch_list);
        $lnk_printers= Iasset::all('id','unique_office_id','type')->where('type','3')->toArray();
        $lnk_printer_list=[];
        foreach ($lnk_printers as $printer){
            $lnk_printer_list[$printer['id']]= $printer['unique_office_id'];
        }
        return view('iworkstations.create', compact('attributes','user_list','os_info_list','net_switch_list','lnk_printer_list','asset_list'));
    }
    public function store(Request $request){

        $request['iworkstation_id']= $this->getIworkstationId($request);

        $workstation = new Iworkstation($request->all());
        $workstation->save();
        if($request['asset_list'] != null) {
            foreach ($request['asset_list'] as $iasset_id) {
                $workstation->iassets()->attach($iasset_id);
            }
        }
        $workstation->iusers()->attach($workstation->iuser_id);

        return redirect('iworkstations');
    }
    public function update($id, Request $request)
    {
        $workstation = Iworkstation::findOrFail($id);
        $workstation->update($request->all());
        $workstation->iusers()->attach($workstation->iuser_id);
        if ($request['asset_list'] != null) {
            foreach ($request['asset_list'] as $iasset_id) {
                $workstation->iassets()->attach($iasset_id);
            }
        }
        else{
            //write some code here... for empty workstation
        }
        return redirect('iworkstations');
    }
    /**
     * @param Request $request
     */
    public function getIworkstationId(Request $request){
        return $request->get('sys_product_id');
    }
}
