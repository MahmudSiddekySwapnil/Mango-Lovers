<?php

namespace App\Http\Controllers\landingViewController;

use App\Http\Controllers\Controller;
use App\Models\LandingModel\Users;
use App\Models\LandingModel\ProductImage;
use App\Models\LandingModel\Products;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function home()
    {
        $result['products'] =  Products::where('status', 1)->get();
        return view('landing_view.pages.home',$result);
    }

    public function userLogin()
    {
        return view('landing_view.pages.login_page');
    }

    public function userRegister()
    {
        return view('landing_view.pages.register_page');
    }

    public function userRegistrationProcess(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:Users,email',
                'phone' => 'required|string|max:20',
                'password' => 'required',
            ]);
            $user = new Users();
            $user->Username = $validatedData['name'];
            $user->Email = $validatedData['email'];
            $user->Phone = $validatedData['phone'];
            $user->PasswordHash = Hash::make($validatedData['password']); // Hash the password
            if ($user->save()) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false, 'error' => 'Failed to save user.']);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function userLoginProcess(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = Users::where('email', $request->input('email'))->first();
        if ($user && Hash::check($request->input('password'), $user->PasswordHash)) {
            $request->session()->put('username', $user->Username);
            $request->session()->put('user_login_frontend', 'user_logged');
            return response()->json(['message' => 'Login successful', 'redirect' => '/dashboard']);
        } else {
            return response()->json(['error' => 'The provided credentials do not match our records.'], 401);
        }
    }


    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/');
    }
}
