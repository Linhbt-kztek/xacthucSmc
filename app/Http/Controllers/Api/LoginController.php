<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Models\Backend\Sinhvien;
use App\Http\Models\Backend\User;
use JWTAuth;

class LoginController extends Controller
{
    /**
     * register api
     * @param fullname
     * @param social_type: 0 = user, 1 = FB, 2 = GG, admin = user_admin
     * @param email
     * @param user_id: user_id: FB-GG, idmsv: user
     * @param os_id: 1: android, 2: ios
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request){
        try {
            $rules = [
                        'fullname' => 'required',
                        'social_type' => 'required',
                        'email' => 'required | email',
                        'user_id' => 'required',
                        'device_id' => 'required',
                        'os_id' => 'required'         
                    ];
            if($request->social_type == 0) {
                $rules['tel'] = 'required';
                $rules['password'] = 'required';
                if(User::where('email', $request->email)->where('social_type', "<>", User::SUPPER_USER)->first()) {
                    $response["status"] = 400;
                    $response["message"] = 'Email đã tồn tại!';
                    $response["data"] = [];
                    return response()->json($response, 400);
                }
                if(User::where('user_id', $request->user_id)->where('social_type', "<>", User::SUPPER_USER)->first()) {
                    $response["status"] = 400;
                    $response["message"] = 'Mã sinh viên đã tồn tại!';
                    $response["data"] = [];
                    return response()->json($response, 400);
                }
            }
        	$validator = \Validator::make($request->all(), $rules);
         	if ($validator->fails()) {
         		$response["status"] = 422;
		        $response["message"] = $validator->errors();
		        $response["data"] = [];
	           	return response()->json($response, 422);
	        }
	        $user = User::where("user_id", $request->user_id)
	        		->where("social_type", $request->social_type)
	        		->first();
	       	$password = "admin!@#";
	       	$tel = "";
	       	$address = "";
            $token_id = "";
	       	if($request->has("password")) $password = $request->password;
	       	if($request->has("tel")) $tel = $request->tel;
	       	if($request->has("address")) $address = $request->address;
            if($request->has("token_id")) $token_id = $request->token_id;
	       	if(!$user) {
	       		\DB::beginTransaction();
	        	$user = new User;
	        	$user->fullname = $request->fullname;
	        	$user->email = $request->email;
	        	$user->status = User::STATUS_ACTIVE;
	        	$user->tel = $tel;
	        	$user->address = $address;
	        	$user->password = bcrypt($password);
	        	$user->social_type = $request->social_type;
	        	$user->user_id = $request->user_id;
                $user->device_id = $request->device_id;
                $user->token_id = $token_id;
                $user->os_id = $request->os_id;
	            $user->save();
	            \DB::commit();
	       	} else {
                $user->device_id = $request->device_id;
                if($token_id != "") {
                    $user->token_id = $token_id;
                }
                $user->save();
            }
	       	$credentials = ["user_id"=>$user->user_id, "password"=>$password, "social_type"=> $user->social_type];
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
            	$response["status"] = 401;
		        $response["message"] = "We cant find an account with this credentials.";
		        $response["data"] = [];
                return response()->json($response, 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
        	$response["status"] = 500;
	        $response["message"] = "Failed to login, please try again.";
	        $response["data"] = [];
            return response()->json($response, 500);
        }
        // all good so return the token
        $response["status"] = 200;
        $response["message"] = "Login success!";
        $response["data"]["access_token"] = "Bearer ".$token;
        $response["data"]["info"] = [
                                        'email' => $user->email,
                                        'fullname' => $user->fullname,
                                        'address' => $user->address,
                                        'tel' => $user->tel,
                                        'user_id' => $user->user_id
                                    ];
        return response()->json($response);

    }

    /**
     * login api
     * @param user_id
     * @param password
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        try {
        	$validator = \Validator::make($request->all(), [
			                'password' => 'required',
			                'user_id' => 'required',
                            'device_id' => 'required'
			            ]);
         	if ($validator->fails()) {
         		$response["status"] = 422;
		        $response["message"] = $validator->errors();
		        $response["data"] = [];
	           	return response()->json($response, 422);
	        }
	       	$credentials = ["user_id"=>$request->user_id, "password"=>$request->password];
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
            	$response["status"] = 401;
		        $response["message"] = "We cant find an account with this credentials.";
		        $response["data"] = [];
                return response()->json($response, 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
        	$response["status"] = 500;
	        $response["message"] = "Failed to login, please try again.";
	        $response["data"] = [];
            return response()->json($response, 500);
        }
        // all good so return the token
        $data_update['device_id'] = $request->device_id;
        if($request->has("token_id") && $request->token_id != "") {
            $data_update['token_id'] = $request->token_id;
        }
        User::where('user_id', $request->user_id)->update($data_update);
        $response["status"] = 200;
        $response["message"] = "Login success!";
        $response["data"]["access_token"] = "Bearer ".$token;
        $response["data"]["info"] = User::select('email','fullname','address','tel','user_id')->where('user_id', $request->user_id)->first();
        return response()->json($response);
    }

    /**
     * updateProfile api
     * @param id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request){
        $user = JWTAuth::parseToken()->authenticate();
        try {
            $rules = [
                        'fullname' => 'required',
                        'email' => 'required | email',
                        'user_id' => 'required',
                        'tel' => 'required'       
                    ];
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $response["status"] = 422;
                $response["message"] = $validator->errors();
                $response["data"] = [];
                return response()->json($response, 422);
            }
            $user = User::find($user->id);
            \DB::beginTransaction();
            $user->fullname = $request->fullname;
            $user->email = $request->email;
            $user->tel = $request->tel;
            $user->address = $request->has("address") ? $request->address : "";
            $user->user_id = $request->user_id;
            $user->save();
            \DB::commit();
            // all good so return the token
            $response["status"] = 200;
            $response["message"] = "Update success!";
            $response["data"]["info"] = [
                                            'email' => $user->email,
                                            'fullname' => $user->fullname,
                                            'address' => $user->address,
                                            'tel' => $user->tel,
                                            'user_id' => $user->user_id
                                        ];
            return response()->json($response);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            $response["status"] = 500;
            $response["message"] = "Failed to login, please try again.";
            $response["data"] = [];
            return response()->json($response, 500);
        }
    }
    
    public function changePass(Request $request) 
    {
        $user = JWTAuth::parseToken()->authenticate();
        $user = User::find($user->id);
        try {
            /*validate data request*/
            Validator::make($request->all(), [
                'oldPass' => 'required',
                'newPass' => 'required | confirmed',
                'newPass_confirmation' => 'required | same:newPass'
            ])->validate();
            if(!\Hash::check($request->oldPass, $user->password)) {
                $response["status"] = 200;
                $response["message"] = "Old password is not correct";
                return response()->json($response);
            }
            $user->password = bcrypt($request->newPass);
            $user->save();
            $response["status"] = 200;
            $response["message"] = "Update success!";
            $response["data"]["info"] = [
                                            'email' => $user->email,
                                            'fullname' => $user->fullname,
                                            'address' => $user->address,
                                            'tel' => $user->tel,
                                            'user_id' => $user->user_id
                                        ];
            return response()->json($response);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            $response["status"] = 500;
            $response["message"] = "Failed to login, please try again.";
            $response["data"] = [];
            return response()->json($response, 500);
        }
    }

    public function checkPassword(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                            'password' => 'required',
                            'user_id' => 'required'       
                        ]);
            if ($validator->fails()) {
                $response["status"] = 422;
                $response["message"] = $validator->errors();
                $response["data"] = [];
                return response()->json($response, 422);
            }
            $user = User::where("user_id", $request->user_id)
                    ->first();
            $response["status"] = 200;
            $response["message"] = "Xác thực người dùng";
            if (isset($user) && \Hash::check($request->password, $user->password)) {
                $response["data"] = true;
            } else {
                $response["data"] = false;
            }
            return response()->json($response);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            $response["status"] = 500;
            $response["message"] = "Failed to login, please try again.";
            $response["data"] = [];
            return response()->json($response, 500);
        }
    }
}
