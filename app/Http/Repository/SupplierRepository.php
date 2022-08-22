<?php

namespace App\Repository;

use App\Model\Supplier;
use App\Model\SupplierPayment;
use Illuminate\Support\Facades\Hash;
use DataTables;

class SupplierRepository
{

    public function getAllSupplier()
    {
        return Supplier::get();
    }


    public function getSupplierForDatatable($condition)
    {

        return Supplier::select('id', 'vendor_id', 'name', 'contact_person', 'phone', 'email', 'address', 'description','total_amount','paid','due','adjustment', 'status');

    }


    public function first($condition)
    {
        return Supplier::where('id', $condition)->first();
    }


    public function get($condition, $orderBy=null, $sequence = null)
    {
        return Supplier::where($condition)->orderBy($orderBy, $sequence)->get();
    }


    public function store($data)
    {
        return $Supplier = Supplier::create($data);
    }

    public function update($data)
    {
        $Supplier = Supplier::where('id', $data['edit_id'])->first();

        $Supplier->update($data);

        return $Supplier;
    }


    public function delete($id)
    {
        $Supplier = Supplier::where('id', decrypt($id))->first();
        return $Supplier->delete();
    }


    public function changeStatus($id, $status)
    {
        $Supplier = Supplier::where('id', decrypt($id))->first();

        if (!empty($Supplier)) {
            $Supplier->update(['status' => decrypt($status)]);
            return true;
        }

        return false;
    }



    public function storePayment($data)
    {
        return $payment = SupplierPayment::create($data);
    }

    public function getSupplierPaymentList($condition)
    {
        return SupplierPayment::where($condition)->select('*');
    }

}
