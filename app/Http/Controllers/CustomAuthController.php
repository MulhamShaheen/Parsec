<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Hash;
use Session;
use App\Models\User;
use App\Models\Employer;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            return view('home');
        }
        return redirect('login')->withSucces('Sign in please.');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function registration()
    {
        return view('auth.register');
    }

    public function registrationEmployer()
    {
        return view('auth.employers.register');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'prof_picture' => 'mimes:jpg,jpeg,png|max:2048',
        ]);
        $data = $request->all();
        $user = $this->create($data);

        if ($request->hasFile('prof_picture')) {
            $file = $request->file('prof_picture');
            $filename = $user->prof_picture;
            $file->storeAs('/', $filename, 'public_profiles');
        }

        return ($this->customLogin($request));

    }

    public function employerRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'prof_picture' => 'mimes:jpg,jpeg,png|max:2048',
        ]);
        $data = $request->all();
        $user = $this->create($data);
        $employer = $this->createEmployer($data, $user);

        if ($request->hasFile('prof_picture')) {
            $file = $request->file('prof_picture');
            $filename = $user->prof_picture;
            $file->storeAs('/', $filename, 'public_profiles');
        }

        return ($this->customLogin($request));

    }

    public function customLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request['remember'] == 'on')) {
//            dd($credentials);
            return redirect()->intended('home')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'prof_picture' => isset($data['prof_picture']) ? time() . $data['prof_picture']->getClientOriginalName() : "default.jpg",
            'role' => $data['role'] ?? "2",
        ]);
    }

    public function createEmployer(array $data, User $user)
    {
        return Employer::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $user->id,

        ]);
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('home');
    }

    public function userReturner()
    {
        if (Auth::check()) {
            return Auth::user();
        }
    }



    public function updateProfPicture(Request $request)
    {
        if ($request->file('prof_picture')) {
            $user = Auth::user();
            $now = time();
            $file = $request->file('prof_picture');
            $filename = $now . $file->getClientOriginalName();
            $file->storeAs('/', $filename, 'public_profiles');

            $user->prof_picture = $now . $request['prof_picture']->getClientOriginalName();

            $user->save();
        }
        return Redirect('account');
    }

    public function updateProfName(Request $request)
    {

        if ($request->name) {
            $user = Auth::user();

            $user->name = $request->name;

            $user->save();
        }
        return Redirect('account');
    }

}
