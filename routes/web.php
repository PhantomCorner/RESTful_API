<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', [TestController::class, 'index']);
Route::get('/greeting', function () {
    return 'Hello World';
});

Route::get('/setup', function () {
    $credentials = [
        'email' => 'admin@admin.com',
        'password' => 'password'
    ];
    if (!Auth::attempt($credentials)) {
        $user = new User();
        $user->name = 'Admin';
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);
        $user->save();
        if (Auth::attempt($credentials)) {
            $adminToken = $user->createToken('adminToken', ['create', 'update', 'delete'])->plainTextToken;
            $updateToken = $user->createToken('updateToken', ['update'])->plainTextToken;
            $basicToken = $user->createToken('basicToken')->plainTextToken;
            return response()->json(['adminToken' => $adminToken, 'updateToken' => $updateToken, 'basicToken' => $basicToken]);
        }
    }
});

// {"adminToken":"1|7qAzd8djfh9652hNNmh1hbOgKPzVwuF5lj6WVz9p69d38278","updateToken":"2|LCLxDWR64nHqpsCLTsO454AM4YTOeXuYNxpyvlC6d51c6c04","basicToken":"3|rfXJK4eIPGhZFgVSdy073Z1kp0e1c5HMkCZAakJc844c7058"}
