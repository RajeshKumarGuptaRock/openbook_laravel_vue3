<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Registration Code
    public function register(Request $request){
        //validator here...
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($response, 400); //400 for validation 
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        $response = [
            'success' => true,
            'data' => $success,
            'message' =>"User register successfully"
        ];

        return response()->json($response, 200);
    }
    // Login Code
    public function login(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = $request->user();
            $token = $user->createToken('MyApp')->plainTextToken;
            $user_name = $user->name;

            $response = [
                'success' => true,
                'token' =>$token,
                'name' => $user_name,
                'message' =>"User login successfully"
            ];
            return response()->json($response, 200);
        }else{
            $response = [
                'success' => false,
                'message' =>"Incorrect username or password. "
            ];
            return response()->json($response, 401); // status code 401 for Unauthorized User
        }
    }
}
