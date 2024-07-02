<?php

namespace App\Http\Controllers\AdminViewController;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request){
        if($request->session()->has('ADMIN_LOGIN')){
            return redirect('dashboard');
        }else{
            return view('admin_view.pages.login');
        }
    }
    public function adminDashboard(){
        return view('admin_view.pages.home');
    }


    /**@author Mahmud Siddeky Swapnil
     *Find the user by email
     *Check if a user with the provided email exists
     * Get the password from the form
     * Compare the input password with the hashed password from the database
     * Passwords don't match, so the user is not authenticated
     * User with the provided email does not exist
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function authData(Request $request){
        $data = AdminUser::where('email', $request->email_address)->first();
        if ($data) {
            $inputPassword = $request->password;
            if (Hash::check($inputPassword, $data->password)) {
                $request->session()->put('ADMIN_LOGIN',true);
                return response()->json(['auth_message' => 'successful', 'url' => 'admin_dashboard']);

            } else {
                return response()->json(['auth_message' => 'authFailed', 'url' => 'admin_login']);
            }
        } else {
            return response()->json(['auth_message' => 'Email Not Found', 'url' => 'admin_login']);
        }
    }

    /**
     * @author Mahmud Siddeky Swapnil
     * this method is use for logout from admin panel
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public  function adminLogout(Request $request){
        session()->flush();
        return redirect('admin_login');
    }

}
