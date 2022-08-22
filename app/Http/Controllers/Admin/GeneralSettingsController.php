<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\District;
class GeneralSettingsController extends Controller
{
    public function delivery(Request $request)
    {


    	if($request->ajax())
    	{
    		$delivery=District::select('id','name','delivery_charge')->orderBy('id','ASC');

    		return datatables($delivery)

            ->editColumn('action',function($delivery){

                return  '<a href="javascript:;" class="btn btn-sm btn-info delivery"><i class="fas fa-edit"></i></a>';
            })
    		->addIndexColumn()
    		->rawColumns(['action'])
    		->make(true);
    	}
    	
//' . route('admin.deliverySettings.edit', encrypt($delivery->id)) . '

    	return view('admin.generalSettings.delivery',['menu'=>'Delivery Settings','page_title'=>'Delivery Settings','task'=>'View']);
    }


    public function editDeliveryCharge(Request $request)
    {

        $district=District::where('id',$request->district_id)->first();

        $data['delivery_charge']=$request->delivery_charge;


        $result=$district->update($data);
        if($result)
        {
            return view('admin.generalSettings.delivery',['menu'=>'Delivery Settings','page_title'=>'Delivery Settings','task'=>'View']);
        }
    }
}
