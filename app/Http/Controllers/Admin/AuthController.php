<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
public function showLogin()
{
return view('admin.login');
}


public function login(Request $request)
{
$request->validate([
'email' => 'required|email',
'password' => 'required',
]);


$creds = $request->only('email', 'password');


if (Auth::attempt($creds)) {
$user = Auth::user();
if ($user->is_admin) {
return redirect()->route('admin.dashboard');
}
Auth::logout();
}


return back()->withErrors(['email' => 'Invalid credentials or not an admin']);
}


public function logout()
{
Auth::logout();
return redirect()->route('admin.login');
}
}