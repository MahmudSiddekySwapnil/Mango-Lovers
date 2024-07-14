<?php

namespace App\Http\Controllers\landingViewController;

use App\Http\Controllers\Controller;
use App\Models\AdminModel\Banners;
use App\Models\LandingModel\Users;
use App\Models\LandingModel\ProductImage;
use App\Models\LandingModel\Products;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function home()
    {
        $result['banners'] = Banners::where('status', 1)->get();
        $result['products'] = Products::where('status', 1)->get();
        return view('landing_view.pages.home', $result);
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
                'phone' => 'required|string|max:20',  // Adjusted to allow for special characters
                'password' => 'required',  // Ensure password meets minimum length
            ]);
            // Create a new user instance and set its properties
            $user = new Users();
            $user->Username = $validatedData['name'];
            $user->Email = $validatedData['email'];
            $user->Phone = $validatedData['phone'];
            $user->PasswordHash = Hash::make($validatedData['password']); // Hash the password

            // Save the user to the database
            if ($user->save()) {
                // Authenticate the user
//                Auth::login($user);

                // Save the authenticated user's ID
                $UserID=Str::random(5);
                $user->userid =$user->id;
                $user->save();

                return response()->json(['success' => true, 'user_id' => Auth::id()]);
            } else {
                return response()->json(['success' => false, 'error' => 'Failed to save user.']);
            }
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function userLoginProcess(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to find the user by email
        $user = Users::where('email', $request->input('email'))->first();
        // Check if user exists and password is correct
        if ($user && Hash::check($request->input('password'), $user->PasswordHash)) {
            // Log the user in by setting session data
            $request->session()->put('username', $user->Username);
            $request->session()->put('userid', $user->Userid);
            $request->session()->put('user_login_frontend', 'user_logged');
            $request->session()->put('USER_LOGIN',true);
            // Merge cart items from session to user
            $this->mergeCartItems($user->id, $request->session()->getId());
            // Return success response with redirect URL
            return response()->json(['message' => 'Login successful', 'redirect' => '/dashboard']);
        } else {
            // Return error response if credentials are invalid
            return response()->json(['error' => 'The provided credentials do not match our records.'], 401);
        }
    }

// Method to merge cart items from session to user
    private function mergeCartItems($userId, $sessionId)
    {
        // Retrieve cart items associated with the session ID
        $sessionCartItems = DB::table('Carts')
            ->where('session_id', $sessionId)
            ->get();

        foreach ($sessionCartItems as $item) {
            // Check if the item already exists in the user's cart
            $existingItem = DB::table('Carts')
                ->where('userid', $userId)
                ->where('sku', $item->sku)
                ->first();

            if ($existingItem) {
                // Update the quantity and total price if the item already exists
                DB::table('Carts')
                    ->where('id', $existingItem->id)
                    ->update([
                        'quantity' => $existingItem->quantity + $item->quantity,
                        'total_price' => ($existingItem->quantity + $item->quantity) * $item->price,
                        'updated_at' => now(),
                    ]);
            } else {
                // Otherwise, add the user_id to the item without clearing the session_id
                DB::table('Carts')
                    ->where('id', $item->id)
                    ->update([
                        'userid' => $userId,
                        'updated_at' => now(),
                    ]);
            }
        }
    }




    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/');
    }
}
