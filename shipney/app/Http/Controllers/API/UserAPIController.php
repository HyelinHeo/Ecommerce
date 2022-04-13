<?php
/**
 * File name: UserAPIController.php
 * Last modified: 2020.05.04 at 09:04:09
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\CustomFieldRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UploadRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Prettus\Validator\Exceptions\ValidatorException;

class UserAPIController extends Controller
{
    private $userRepository;
    private $uploadRepository;
    private $roleRepository;
    private $customFieldRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, UploadRepository $uploadRepository, RoleRepository $roleRepository, CustomFieldRepository $customFieldRepo)
    {
        $this->userRepository = $userRepository;
        $this->uploadRepository = $uploadRepository;
        $this->roleRepository = $roleRepository;
        $this->customFieldRepository = $customFieldRepo;
    }

    function login(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                // Authentication passed...
                $user = auth()->user();
                $user->device_token = $request->input('device_token', '');
                $user->save();
                return $this->sendResponse($user, 'User retrieved successfully');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }

    }
    
    function loginSns(Request $request)
    {
        try {
            $this->validate($request, [
                //'email' => 'required|email',
                'reg_type' => 'required',
                'sns_token' => 'required',
            ]);

            $user = User::where('sns_token',$request->input('sns_token'))->where('reg_type',$request->input('reg_type'))->first();
            //$user = User::where('sns_token',$request->input('token'))->first();

            if($user){
                /*
                $user = new User;
                $user->name = $userSocial->name;
                $user->email = $userSocial->email;
                $user->password = bcrypt(str_random());
                $user->save();
                $defaultRoles = $this->roleRepository->findByField('default','1');
                $defaultRoles = $defaultRoles->pluck('name')->toArray();
                $user->assignRole($defaultRoles);
    
                try {
                    $upload = $this->uploadRepository->create(['uuid' => $userSocial->token]);
                    $upload->addMediaFromUrl($userSocial->avatar_original)
                        ->withCustomProperties(['uuid' => $userSocial->token])
                        ->toMediaCollection('avatar');
    
                    $cacheUpload = $this->uploadRepository->getByUuid($userSocial->token);
                    $mediaItem = $cacheUpload->getMedia('avatar')->first();
                    $mediaItem->copy($user, 'avatar');
                } catch (ValidatorException $e) {
                    Flash::error($e->getMessage());
                }
                */
                auth()->login($user,true);
                $user->device_token = $request->input('device_token', '');
                $user->save();

                return $this->sendResponse($user, 'User retrieved successfully');
            } else {
                return $this->sendResponse(null, 'cannot found successfully');
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }
    }
    
    /**
     * getUserEmailByPhone.
     *
     * @param array $data
     * @return
     */
    function getUserEmailByPhone(Request $request)
    {
        try {
            if($request->input('reg_type') == "0") {
                $checkUserPhone = User::where('reg_type',$request->input('reg_type'))->where('country_digit',$request->input('country_digit'))->where('phone',$request->input('phone'))->first();

                if($checkUserPhone != null) {
                    // already reg phone
                    return $this->sendResponse($checkUserPhone->email, "successfully");
                }
            }
            /*
            if (copy(public_path('images/avatar_default.png'), public_path('images/avatar_default_temp.png'))) {
                $user->addMedia(public_path('images/avatar_default_temp.png'))
                    ->withCustomProperties(['uuid' => bcrypt(str_random())])
                    ->toMediaCollection('avatar');
            }
            */
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("", 'successfully');
    }
    
    function checkDupUserEmail(Request $request)
    {
        try {
            if($request->input('reg_type') == "0") {
                $checkUserEmail = User::where('reg_type',$request->input('reg_type'))->where('email',$request->input('email'))->first();

                if($checkUserEmail != null) {
                    // already reg phone
                    return $this->sendResponse($checkUserEmail->email, "successfully");
                }
            }
            /*
            if (copy(public_path('images/avatar_default.png'), public_path('images/avatar_default_temp.png'))) {
                $user->addMedia(public_path('images/avatar_default_temp.png'))
                    ->withCustomProperties(['uuid' => bcrypt(str_random())])
                    ->toMediaCollection('avatar');
            }
            */
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("", 'successfully');
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return
     */
    function register(Request $request)
    {
        try {
            $checkUser = null;
            $password = "";

            if($request->input('reg_type') == "0") {    
                // email regist
                $this->validate($request, [
                    'name' => 'required',
                    'email' => 'required',
                    'phone' => 'required',
                    'password' => 'required',
                ]);

                $checkUser = User::where('email',$request->input('email'))->where('reg_type',$request->input('reg_type'))->first();

                if($checkUser != null) {
                    // already reg email
                    return $this->sendResponse(null, 'managed:101');
                }

                $password = $request->input('password');
            } else {
                // sns regist
                $this->validate($request, [
                    'name' => 'required',
                    'email' => 'required',
                    'phone' => 'required',
                ]);

                $checkUser = User::where('sns_token',$request->input('sns_token'))->where('reg_type',$request->input('reg_type'))->first();
                if($checkUser != null) {
                    // already reg sns
                    return $this->sendResponse(null, 'managed:201');
                }

                $password = str_random(16);
            }

            $user = new User;

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->reg_type = $request->input('reg_type', '0');
            $user->sns_token = $request->input('sns_token', '');
            $user->device_token = $request->input('device_token', '');
            $user->password = Hash::make($password);
            $user->api_token = str_random(60);
            $user->phone = $request->input('phone');
            $user->country_code = $request->input('country_code', '');
            $user->country_digit = $request->input('country_digit', '');
            $user->language_code = $request->input('language_code', '');
            $user->friend_auto_add = $request->input('friend_auto_add', '');
            $user->friend_allow_add_me = $request->input('friend_allow_add_me', '');
            $user->allow_notify = $request->input('allow_notify', '');
            $user->allow_notify_shipping = $request->input('allow_notify_shipping', '');
            $user->allow_notify_event = $request->input('allow_notify_event', '');
            $user->allow_notify_event = $request->input('allow_notify_notice', '');
            $user->agree_privacy = $request->input('agree_privacy', 'N');
            $user->agree_terms = $request->input('agree_terms', 'N');
            $user->agree_mobile = $request->input('agree_mobile', 'N');
            $user->agree_over_14 = $request->input('agree_over_14', 'N');

            $user->save();

            $defaultRoles = $this->roleRepository->findByField('default', '1');
            $defaultRoles = $defaultRoles->pluck('name')->toArray();
            $user->assignRole($defaultRoles);


            /*
            if (copy(public_path('images/avatar_default.png'), public_path('images/avatar_default_temp.png'))) {
                $user->addMedia(public_path('images/avatar_default_temp.png'))
                    ->withCustomProperties(['uuid' => bcrypt(str_random())])
                    ->toMediaCollection('avatar');
            }
            */
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 401);
        }

        return $this->sendResponse($user, 'success');
    }

    function logout(Request $request)
    {
        $user = $this->userRepository->findByField('api_token', $request->input('api_token'))->first();
        if (!$user) {
            return $this->sendError('User not found', 401);
        }
        try {
            auth()->logout();
        } catch (\Exception $e) {
            $this->sendError($e->getMessage(), 401);
        }
        return $this->sendResponse($user['name'], 'User logout successfully');

    }

    function user(Request $request)
    {
        $user = $this->userRepository->findByField('api_token', $request->input('api_token'))->first();

        if (!$user) {
            return $this->sendError('User not found', 401);
        }
        
        return $this->sendResponse($user, 'User retrieved successfully');
    }

    function settings(Request $request)
    {
        $settings = setting()->all();

        $settings = array_intersect_key($settings,
            [
                'app_name' => '',
                'app_version' => '',

                'google_maps_key' => '',

                'currency_right' => '',
                'enable_paypal' => '',
                'enable_stripe' => '',

                'default_currency' => '',
                'default_currency_code' => '',
                'default_currency_decimal_digits' => '',
                ]
        );

        if (!$settings) {
            return $this->sendError('Settings not found', 401);
        }

        return $this->sendResponse($settings, 'Settings retrieved successfully');
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param Request $request
     *
     */
    public function update($id, Request $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            return $this->sendResponse([
                'error' => true,
                'code' => 404,
            ], 'User not found');
        }

        $input = $request->except(['reg_type', 'password', 'api_token']);

        if($request->has('newpassword')) {
            $newpassword = $request->get("newpassword"); 
            if($newpassword != null && strlen($newpassword) > 0) {
                $input['password'] = Hash::make($newpassword);
            }
        }

        try {
            if ($request->has('device_token')) {
                $user = $this->userRepository->update($request->only('device_token'), $id);
            } else {
                //$customFields = $this->customFieldRepository->findByField('custom_field_model', $this->userRepository->model());
                $user = $this->userRepository->update($input, $id);

                /*
                foreach (getCustomFieldsValues($customFields, $request) as $value) {
                    $user->customFieldsValues()
                        ->updateOrCreate(['custom_field_id' => $value['custom_field_id']], $value);
                }
                */                
            }
        } catch (ValidatorException $e) {
            return $this->sendError($e->getMessage(), 401);
        }

        //return $this->sendResponse($user, __('lang.updated_successfully', ['operator' => __('lang.user')]));
        return $this->sendResponse("success", __('lang.updated_successfully', ['operator' => __('lang.user')]));
    }

    function sendResetLinkEmail(Request $request)
    {
        $email = "";

        if ($request->has('email') == false) {
            return $this->sendError("error:000", 401);
        } else {
            $email = $request->get("email"); 

            if(strlen($email) < 5) {
                return $this->sendError("error:000", 401);
            }
        }

        try {

            $user = User::where('email',$email)->where('reg_type', 0)->first();

            if (empty($user)) {
                $user = User::where('email',$email)->where('reg_type', '!=', 0)->first();

                if (!empty($user)) {
                    return $this->sendResponse(false, 'error:002,sns'.$user->reg_type.'sns');
                }
            }

            if (empty($user)) {
                return $this->sendResponse(false, 'error:001');
            }

            $response = Password::broker()->sendResetLink(
                $request->only('email')
            );
    
            if ($response == Password::RESET_LINK_SENT) {
                return $this->sendResponse(true, 'Reset link was sent successfully');
            } else {
                return $this->sendResponse(false, 'error:010');
            }

        } catch (\Exception $e) {
            return $this->sendError("error:000", 401);
        }

        return $this->sendError("error:000", 401);
    }

    public function withdrawal($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            return -1;
        }

        $cleardata['name'] = '********';
        $cleardata['email'] = '********';
        //$cleardata['password'] = 'withdraw'.str_random(50);
        $cleardata['device_token'] = '';
        $cleardata['api_token'] = 'withdraw'.str_random(50);
        $cleardata['sns_token'] = 'withdraw'.str_random(50);
        $cleardata['phone'] = '********';
        $cleardata['photo'] = '';

        try {
            $user = $this->userRepository->update($cleardata, $id);
        } catch (ValidatorException $e) {
            return -2;
        }

        //return $this->sendResponse($user, __('lang.updated_successfully', ['operator' => __('lang.user')]));
        return 0;
    }
}
