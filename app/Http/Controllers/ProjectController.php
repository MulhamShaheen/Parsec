<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;

class ProjectController extends Controller
{
    public function create(array $data)
    {
        return Project::create([
            'title' => $data['title'],
            'employer_id' => $data['employer_id'],
            'director' => $data['director'],
            'description' => $data['description'],
            'icon' => time().$data['cover_picture']->getClientOriginalName(),
        ]);
    }

    public function viewProject(Request $request, int $id){
        return view('projects.view',compact('id'));
    }

    public function validateNewProject(Request $request){

        $request->validate([
            'title' => 'required',
            'cover_picture' => 'mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();
        $data = $request->all();
        $data['employer_id'] = $user->aboutEmployer()->get()[0]->id;
        $project = $this->create($data);


        if ($request->hasFile('cover_picture')) {
            $file = $request->file('cover_picture');
            $filename = $user->prof_picture;
            $file->storeAs('/', $filename, 'public_profiles');
        }
        $project->save();


//        dd($project);
//        dd(Auth::user()->projects()->get()->last());
        return redirect('account');
    }
}
