<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Iasset;
use App\User;
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
        'WinXP_X86_32bit' => 'WX32',
        'WinXP_X86_64bit' => 'WX64',
        'Win7_X86_32bit' => 'W732',
        'Win7_X86_67bit' => 'W764',
        'Win8_X86_32bit' => 'W832',
        'Win8_X86_67bit' => 'W864',
        'Win10_X86_32bit' => 'W032',
        'Win10_X86_67bit' => 'W064'
    ];
    //Add your attribute into following table carefully[at the bottom of any array...]
    public function __construct(){
        $this->middleware('auth');
    }
    public function  index () {
        $objects= Iworkstation::latest('updated_at')->get();
        $attributes = [ 'Iworkstation_Id', 'Net_Switch_Id', 'Net_Switch_Port', 'Net_DHCP_Ip', 'Net_MAC_Id', 'Net_Login_Status', 'Net_Faceplate_Id', 'OS_Detail_Info', 'Lnk_Printer_Id', 'Sys_Product_Id', 'User_Id'];
        $os_info_list= array_keys($this->os_info_list);
        $net_switch_list= array_keys($this->net_switch_list);

        $lnk_printer_list= array_keys(Iasset::all()->where('type','3')->keyBy('unique_office_id')->toArray());
        array_unshift($lnk_printer_list,"");
        unset($lnk_printer_list[0]);
        $user_list= array_keys(User::all()->keyBy('name')->toArray());
        array_unshift($user_list, 'Select One');
        return view('iworkstations.index', compact('objects', 'attributes', 'user_list','os_info_list','net_switch_list','lnk_printer_list'));
    }
    public function show($id){
        $object= Iworkstation::findOrFail($id);
        $users = $object->users;
        $os_info_list= array_keys($this->os_info_list);
        $net_switch_list= array_keys($this->net_switch_list);
        $user_list= array_keys(User::all()->keyBy('name')->toArray());
        array_unshift($user_list,"");
        unset($user_list[0]);
        $lnk_printer_list= array_keys(Iasset::all()->where('type','3')->keyBy('unique_office_id')->toArray());
        array_unshift($lnk_printer_list,"");
        unset($lnk_printer_list[0]);
        $attributes = [ 'Iworkstation_Id', 'Net_Switch_Id', 'Net_Switch_Port', 'Net_DHCP_Ip', 'Net_MAC_Id', 'Net_Login_Status', 'Net_Faceplate_Id', 'OS_Detail_Info', 'Lnk_Printer_Id', 'Sys_Product_Id', 'User_Id'];
        return view('iworkstations.show',compact('object', 'attributes','users', 'user_list','os_info_list', 'net_switch_list','lnk_printer_list'));
    }
    public function create(){
        $attributes = [ 'User_Id','Net_Switch_Id', 'Net_Switch_Port', 'Net_DHCP_Ip', 'Net_MAC_Id', 'Net_Login_Status', 'Net_Faceplate_Id', 'OS_Detail_Info', 'Lnk_Printer_Id', 'Sys_Product_Id'];
        $user_list= array_keys(User::all()->keyBy('name')->toArray());
        array_unshift($user_list, 'Select One');
        $os_info_list= array_keys($this->os_info_list);
        $net_switch_list= array_keys($this->net_switch_list);
        $lnk_printer_list= array_keys(Iasset::all()->where('type','3')->keyBy('unique_office_id')->toArray());
        array_unshift($lnk_printer_list,"");
        unset($lnk_printer_list[0]);
        return view('iworkstations.create', compact('attributes','user_list','os_info_list','net_switch_list','lnk_printer_list'));
    }
    public function store(Request $request){
        $request['iworkstation_id']= $this->getIworkstationId($request);
        $workstation = new Iworkstation($request->all());
        $workstation->save();
        $workstation->iusers()->attach($workstation->user_id);
        return redirect('iworkstations');
    }
    public function update($id, Request $request){
        $workstation = Iworkstation::findOrFail($id);
        $workstation->update($request->all());
        $workstation->iusers()->attach($workstation->user_id);
        return redirect('iworkstations');
    }
    /**
     * @param Request $request
     */
    public function getIworkstationId(Request $request)
    {
        return $request->get('sys_product_id');
    }

}
