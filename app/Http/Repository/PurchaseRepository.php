<?php

namespace App\Repository;

use App\Model\Purchase;
use App\Model\PurchaseDetails;
use App\Model\Stock;
use App\Model\Supplier;

class PurchaseRepository
{
	public function getPurchaseListForDatatable($condition)
	{
			return Purchase::where($condition)->with('supplier')->select('*');
	}

	public function store($data)
    {
        return  Purchase::create($data);
    }

    public function storeDetails($data)
    {
    		return PurchaseDetails::create($data);
    }


    public function getPurchaseDetailsForDatatable($condition)
    {
    	return PurchaseDetails::where($condition)->select('*');
    }

    public function getSupplierPurchaseList($condition)
    {
        return Purchase::where($condition)->select('*');
    }
#stock
    public function getStockForDataTable($condition)
    {
        return Stock::where($condition)->select('*');
    }


    public function first($condition)
    {
        return Purchase::where($condition)->first();
    }

    public function purchaseDetails($condition)
    {
        return Purchase::where($condition)->with('purchaseDetails')->first();
    }
}
