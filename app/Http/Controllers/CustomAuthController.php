<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Info;
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
        $faculities = Faculty::all();
        return view('auth.register', compact('faculities'));
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
        $data['gender'] = true;
        $data['user_id'] = $user->id;
        $info = Info::create($data);
        $info->save();

        dd($request);
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

    public function accountManager(Request $request)
    {
        $user = Auth::user();
        if ($user->isEmployer()) {
            $employer = $user->aboutEmployer()->get()[0];
            $projects = $user->projects()->get()->all();
            return view('accounts.employer', compact('user', 'employer', 'projects'));
        }

        $info = $user->info()->get()[0];
        $major = null;
        $faculty = null;
        $resume = null;
        $projects = [];
        $data = [];
        if ($user->resumes()->exists()) {
            $resume = $user->resumes()->orderBy('created_at', 'DESC')->get()[0];
        }

        if ($info->major()->exists()) {
            $major = $info->major()->get()[0];
        }

        if ($info->faculty()->exists()) {
            $faculty = $info->faculty()->get()[0];
        }

        if ($user->projects()->exists())
            $projects = $user->projects()->get()->all();

        if ($user->replies()->exists())
            $data['replies'] = $user->replies()->get();

        $data['info'] = $info;
        $data['major'] = $major;
        $data['faculty'] = $faculty;
        $data['resume'] = $resume;
        $data['projects'] = $projects;


        return view('accounts.activist', compact('user', 'data',));
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
