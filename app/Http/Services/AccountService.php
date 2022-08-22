<?php

namespace App\Services;


use App\Model\Expense;
use App\Model\ExpenseDetails;
use App\Model\ExpenseHead;

/**
 *
 */
class AccountService
{
    public function expenseHeadAddEdit($request)
    {
        $data = ['status' => false, 'message' => 'Something went wrong', 'data' => []];

        $expHeadData['name'] = $request->name;
        $expHeadData['active_status'] = $request->active_status;


        if ($request->edit_id) {

            $expHead = ExpenseHead::where('id', $request->edit_id)->first();
            if ($expHead) {
                $success = $expHead->update($expHeadData);

                if ($success) {
                    return [
                        'status' => true,
                        'message' => __('Expense Head Successfully updated'),
                        'data' => $expHead,
                    ];
                }
            }
            return $data;
        }


        $expHead = ExpenseHead::create($expHeadData);        // add/create new Brand

        if ($expHead) {
            return [
                'status' => true,
                'message' => __('Expense Head Successfully added'),
                'data' => $expHead,
            ];
        }
        return $data;

    }

    //    ***************** End add and Update Brand *******************

    /*
     *  * Brand Brand
     */

    public function delete($id)
    {
        $data = ['status' => false, 'data' => '', 'message' => __('Something went wrong, please try again, Thanks')];

        $expHead = ExpenseHead::where(['id' => decrypt($id)])->first();

        $success = $expHead->delete();
        if ($success) {
            $data['success'] = true;
            $data['message'] = __('Expense Head successfully deleted');

            return $data;
        }
        return $data;
    }

    public function expenseAddEdit($request)
    {
        $data = ['status' => false, 'data' => '', 'message' => __('Something went wrong, please try again, Thanks')];

        $expData['total'] = $request->get('grand_total');
        $exp = Expense::create($expData);

        if ($exp) {
            $index = count($request->ingredient_id);

            for ($i = 0; $i < $index; $i++) {

                $expDetailsData['expense_id'] = $exp->id;
                $expDetailsData['expense_head_id'] = $request->get('ingredient_id')[$i];
                $expDetailsData['value'] = $request->get('unit_price')[$i];
                $expDetailsData['description'] = $request->get('description')[$i];

                ExpenseDetails::create($expDetailsData);
            }
            $data['status'] = true;
            $data['message'] = 'Successfully added';

            return $data;
        }

        return $data;
    }
}
