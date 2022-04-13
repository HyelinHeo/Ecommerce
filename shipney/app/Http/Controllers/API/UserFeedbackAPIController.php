<?php
/**
 * File name: UserFeedbackAPIController.php
 * Last modified: 2020.05.04 at 09:04:09
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\UserAPIController;
use App\Models\UserFeedback;
use App\Repositories\UserFeedbackRepository;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class UserFeedbackAPIController extends Controller
{
    private $userFeedbackRepository;

    private $userAPICtrl;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserFeedbackRepository $userFeedbackRepo, UserAPIController $userAPIController)
    {
        $this->userFeedbackRepository = $userFeedbackRepo;
        $this->userAPICtrl = $userAPIController;
    }

    /**
     * Create a new feedbac instance.
     *
     * @param array $data
     * @return
     */
    function register(Request $request)
    {
        try {
            $this->validate($request, [
                'type' => 'required',
            ]);

            $result = $this->userFeedbackRepository->create(
                $request->all()
            );

            if($request['type'] == 4) {
                // 탈퇴 회원
                $userid = $request->get("user_id");
                if($userid > 0) {
                    $this->userAPICtrl->withdrawal($userid);
                }
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }


        return $this->sendResponse("success", 'feedback successfully');
    }
}
