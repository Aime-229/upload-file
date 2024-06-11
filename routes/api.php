<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::post('/login', function(Request $request){

    $credentials = $request->only('email','password');

    if(Auth::attempt($credentials))
    {
        $user = User::where('email',$request->email)->first();

        $token = $user->createToken('token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    return response()->json(['message' => 'Non authorisé'], 401);
});


Route::middleware('auth:sanctum')->get('/getUploadData/{code}', [App\Http\Controllers\UploadController::class,'getUploadData']);