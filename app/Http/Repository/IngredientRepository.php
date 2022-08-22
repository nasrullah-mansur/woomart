<?php

namespace App\Repository;

use App\Model\Adjustment;
use App\Model\DeliveryDetail;
use App\Model\Product;
use App\Model\IngredientUnit;
use Illuminate\Support\Facades\Auth;

class IngredientRepository
{


    public function getAllIngredient()
    {
        return Product::get();
    }


    public function getIngredientForDatatable($condition)
    {
        return Product::where($condition)->with('category')->select('id', 'name', 'category_id', 'quantity', 'used', 'alert_quantity', 'unit_price', 'unit', 'adjustment', 'update_date', 'status', 'image');

    }


    public function first($condition)
    {
        return Product::where($condition)->first();
    }


    public function get($condition, $orderBy = null, $sequence = null)
    {

        return Product::where($condition)->orderBy($orderBy, $sequence)->get();
    }


    public function store($data)
    {
        return $product = Product::create($data);
    }


    public function update($data)
    {
        $product = Product::where('id', $data['edit_id'])->first();

        $product->update($data);

        return $product;
    }


    public function delete($ingredient)
    {
        return $ingredient->delete();
    }


    public function changeStatus($id, $status)
    {
        $product = Product::where('id', decrypt($id))->first();

        if (!empty($product)) {

            $update = $product->update(['status' => decrypt($status)]);
            return $update;
        }

        return false;
    }



//    *********************************** Ingredients Units *********************************


        public function getAllUnitsForDatatable($condition = null)
        {
            return IngredientUnit::select('*');
        }



        # Unit create
        public function unitStore($unitData)
        {
           return IngredientUnit::create($unitData);
        }

        # Unit Update
        public function unitUpdate($unitData, $id)
        {
           $ingredient =  IngredientUnit::where('id', $id);
           $data = $ingredient->update($unitData);
           return $data;
        }



        # Unit change status
        public function unitChangeStatus($id, $status)
        {
            $ingredient = IngredientUnit::where('id', decrypt($id))->first();

            if (!empty($ingredient)) {

                $update = $ingredient->update(['status' => decrypt($status)]);
                return $update;
            }

            return false;
        }

        # Unit Delete
        public function unitDelete($id)
        {
            $unit = IngredientUnit::where('id', $id)->first();
            return $unit->delete();
        }

        # Unit First
        public function unitFirst($id)
        {
            $ingredient = IngredientUnit::where('id', decrypt($id))->first();
            return $ingredient;
        }







//    *********************************** Ingredients Adjustment *********************************

    public function adjustmentStore($data)
    {
        return Adjustment::create($data);
    }


    public function getAdjustmentsForDatatable($condition)
    {

        return Ingredient::where($condition)->has('getAdjustments')->select('*');
    }

    public function getAdjustmentsDetailsForDatatable($condition)
    {
        return Adjustment::where($condition)->select('*');
    }


}
