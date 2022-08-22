<?php

namespace App\Http\Services;


use App\Models\TalentTeam;

class TalentTeamService
{
    /*
     *  * store Talent team
     */

    public function store($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $talentData['name'] = $request->name;
        $talentData['designation'] = $request->designation;
        $talentData['active_status'] = $request->active_status;


        if (!empty($request->image)) {

            $old_img = '';
            $talentData['image'] = fileUpload($request['image'], path_talent_team_image(), $old_img);  // upload image/file
        }

        $talentTeam = TalentTeam::create($talentData);

        if ($talentTeam) {

            $data['success'] = true;
            $data['message'] = __('The Team member successfully added');
            $data['data'] = $talentTeam;

            return $data;
        }
        return $data;

    }

    //    ***************** End add  Talent team *******************

    /*
     *  * update Talent team
     */

    public function update($request)
    {
        $data = ['success' => false, 'message' => 'Something went wrong', 'data' => []];

        $talentData['name'] = $request->name;
        $talentData['designation'] = $request->designation;
        $talentData['active_status'] = $request->active_status;

        $talent = TalentTeam::where('id', $request->edit_id)->first();

        if ($talent) {

            if (!empty($request->image)) {

                $old_img = isset($talent) ? $talent->image : '';

                $talentData['image'] = fileUpload($request['image'], path_talent_team_image(), $old_img);  // upload image/file
            }

            $success = $talent->update($talentData);

            if ($success) {

                $data['success'] = true;
                $data['message'] = __('The Team member successfully updated');
                $data['data'] = $talent;

                return $data;
            }

            return $data;
        }

        $data['message'] = "Talent doesn't exists";
        return $data;
    }

    //    ***************** End update  Talent team *******************


    public function delete($id)
    {
        $data = ['success' => false, 'data' => '', 'message' => __('Something went wrong, please try again, Thanks')];

        $talent = TalentTeam::where(['id' => decrypt($id)])->first();
        if ($talent) {

            removeImage(path_talent_team_image(), $talent->image);

            $success = $talent->delete();
            if ($success) {

                $data['success'] = true;
                $data['message'] = __('The Talent successfully deleted');

                return $data;
            }
            return $data;
        }

        $data['message'] = "Team member doesn't exists";
        return $data;

    }

}
