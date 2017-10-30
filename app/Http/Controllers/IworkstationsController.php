<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateIworkstationRequest;
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
    protected $storeRoomUserID='1';
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
        $attributes = [ 'Iworkstation_Id', 'Net_Switch_Id', 'Net_Login_Status', 'OS_Detail_Info', 'Lnk_Printer_Id', 'OS_Host_Id','Iuser_Id'];
        return view('iworkstations.index', compact('objects', 'attributes', 'user_list','os_info_list','net_switch_list','lnk_printer_list'));
    }
    public function show($id){
        $object= Iworkstation::findOrFail($id);
        $users = $object->iusers;
        $assets = $object->iassets->toArray();
        $lnk_assets=[];
        foreach ($assets as $asset){
                $lnk_assets[$asset['id']]=$asset['unique_office_id'];
        }
        $os_info_list= $this->os_info_list;
        $net_switch_list= array_keys($this->net_switch_list);
      //  $allUsers= Iuser::all('id','name')->toArray();
      //  array_shift($allUsers);
        $user_list = [];
        foreach ($allUsers as $user) {
            $user_list[$user['id']]=$user['name'];
        }
        $lnk_printers= Iasset::all('id','unique_office_id','type')->where('type','3')->toArray();
        $lnk_printer_list = [];
        foreach ($lnk_printers as $printer){
            $lnk_printer_list[$printer['id']]=$printer['unique_office_id'];
        }
        $attributes = [ 'Net_Switch_Id', 'Net_Switch_Port', 'Net_DHCP_Ip', 'Net_MAC_Id', 'Net_Login_Status', 'Net_Faceplate_Id', 'OS_Detail_Info', 'Lnk_Printer_Id', 'OS_Product_Key', 'OS_Host_Id', 'Iuser_Id', 'Asset_List'];
        return view('iworkstations.show', compact('object', 'attributes','users','lnk_assets', 'user_list','os_info_list', 'net_switch_list','lnk_printer_list','asset_list','assets'));
    }
    public function create(){
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
        $attributes = [ 'Iuser_Id','Net_Switch_Id', 'Net_Switch_Port', 'Net_DHCP_Ip', 'Net_MAC_Id', 'Net_Login_Status', 'Net_Faceplate_Id', 'OS_Detail_Info', 'Lnk_Printer_Id', 'OS_Product_Key', 'OS_Host_Id'];
        return view('iworkstations.create', compact('attributes','user_list','os_info_list','net_switch_list','lnk_printer_list'));
    }
    public function store(CreateIworkstationRequest $request){
        $request['iworkstation_id']= $this->getIworkstationId($request);

        $this->validate($request, [
            'net_switch_port' => 'required|unique:iworkstations',
            'iuser_id' => 'required|unique:iworkstations',
            'net_faceplate_id' => 'required|unique:iworkstations',
            'net_mac_id' => 'required|unique:iworkstations'
        ]);
        $workstation = new Iworkstation($request->all());
        $workstation->save();
        $currentUser = $workstation->iuser_id;
        $workstation->iusers()->attach($currentUser);
        $user = Iuser::findOrFail($currentUser);
        $assets= $user->iassets->toArray();

        foreach ($assets as $asset) {
          if($currentUser == $asset['iuser_id'])
            $workstation->iassets()->attach($asset['id']);
        }

        return redirect('iworkstations');
    }
    public function update($id, CreateIworkstationRequest $request){
        $workstation = Iworkstation::findOrFail($id);

        $userChanged = true;
        if($workstation->iuser_id == $request->iuser_id)
            $userChanged= false;

        $previousUser = $workstation->iuser_id;
        if($userChanged){                       //Previous user has to release all assets
            $lnkAssets = Iasset::all('id','unique_office_id','iuser_id')->where('iuser_id',$previousUser);
            foreach ($lnkAssets as $asset) {
                $asset->update(['iuser_id'=>$this->storeRoomUserID]);
                $asset->iusers()->attach($this->storeRoomUserID);
            }
            $workstation->iusers()->attach($this->storeRoomUserID); //entry for releasing user as storeRoomUser
        }

        $workstation->update($request->all()); //update Workstations table
        $currentUser = $workstation->iuser_id;

        if($currentUser != $previousUser) {   //Iuser-Workstation linked table entry
            $workstation->iusers()->attach($currentUser); //entry for new user in iuser-workstation
        }

        if ($request['asset_list'] != null) { //New User be linked with existing assets
            foreach ($request['asset_list'] as $iasset_id) {
                $workstation->iassets()->attach($iasset_id); //updating iasset-workstation id
                    $asset= Iasset::findOrFail($iasset_id);
                    $asset->update(['iuser_id'=>$currentUser]); //updating user in iassets table
                    $asset->iusers()->attach($currentUser); //updating iasset-iuser table
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
    public function getIworkstationId(CreateIworkstationRequest  $request){
        $net_faceplate_id = $request->get('net_faceplate_id');
        return 'MA'.$net_faceplate_id;
    }
}
