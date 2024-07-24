<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register a new user",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name" , "email", "password"},
     *              @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  example="Ben"
     *              ),
     *              @OA\Property(
     *                  property="email",
     *                  type="email",
     *                  example="ybier@esme-solutions.com"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  example="12345678"
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *          response=200, 
     *          description="User registered successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="token" , type="object")
     *          )
     *     ),
     *     @OA\Response(
     *          response=400, 
     *          description="Validation error" ,
     *          @OA\JsonContent(
     *              @OA\Property(property="message" , type="string")
     *          )
     *     )
     * )
     */
    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $this->createToken($user->email , $request->password);
        
        return response()->json(['token' => $token] , 201);
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Log in a user",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"email", "password"},
     *              @OA\Property(
     *                  property="email",
     *                  type="email",
     *                  example="ybier@esme-solutions.com"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  example="12345678"
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *          response=200, 
     *          description="User logged in successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="token" , type="object")
     *          )
     *     ),
     *     @OA\Response(
     *          response=401, 
     *          description="Invalid credentials" ,
     *          @OA\JsonContent(
     *              @OA\Property(property="message" , type="string")
     *          )
     *     )
     * )
     */
    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email' , $request->email)->first();

        if(!$user || !Hash::check($request->password , $user->password)){
            return response()->json(['error' => 'Invalid credentials'] , 401);
        }

        $token = $this->createToken($user->email , $request->password);

        return response()->json(['token' => $token] , 200);
    }

    /**
     * @OA\Post(
     *     path="/oauth/token",
     *     summary="Issue access token",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"grant_type", "client_id", "client_secret", "scope"},
     *              @OA\Property(
     *                  property="grant_type",
     *                  type="string",
     *                  example="password | client_credentials "
     *              ),
     *              @OA\Property(
     *                  property="client_id",
     *                  type="string",
     *                  example="9c80690e-c5b4-44b1-a0b8-9ae617b4e0e6"
     *              ),
     *              @OA\Property(
     *                  property="client_secret",
     *                  type="string",
     *                  example="3NSV8PpIZfOi0hyE5qC6TGOJrMVTGcQlIGYhze27"
     *              ),
     *              @OA\Property(
     *                  property="scope",
     *                  type="string",
     *                  example=""
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *          response=200, 
     *          description="Token issued",
     *          @OA\JsonContent(
     *              @OA\Property(property="token" , type="object")
     *          )
     *     ),
     *     @OA\Response(
     *          response=401, 
     *          description="Invalid credentials" ,
     *          @OA\JsonContent(
     *              @OA\Property(property="message" , type="string")
     *          )
     *     )
     * )
     */
    public function createToken($email, $password){

        $client = Client::where('password_client' , 1)->first();
        
        $response = Http::asForm()->post(config('app.url') . '/oauth/token' , [
            'grant_type' => 'password', 
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $email,
            'password' => $password, 
            'scope' => ''
        ]);

        return $response->json();
    }
}
