<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function __construct()
    {
        $this->middleware(['auth','admin'], ['only' => ['index']]);
    }

    public function index() {

        $users = User::where('is_admin',0)->get();

        return view('user.index',compact('users'));
    }

    public function create() {
        
        return view('user.create');
    }

    public function store(Request $request) {
        
        $request->validate([
            'name'=>['required','min:3'],
            'email' =>['required','min:5'],
            'password' =>['required','min:8'],
        ]);

        if ($request->hasFile('file')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png'
            ]);

            $request->file->store('user', 'public');
            
            $user = new User([
                'name' => $request->get('name'),
                'username' => $request->get('username'),
                "profile" => $request->file->hashName(),
                'email' => $request->get('email'),
                'password' => $request->get('password'),
                'bio' => $request->get('bio'),
            ]);
            $user->save();
        }

        // User::create($request->all());

        return redirect()
        ->route('user.index')
        ->with('success','user added')
        ;

    }


    public function show(User $user) {
        
        return view('user.show',compact('user'));
    }


    public function edit(User $user) {
        
        return view('user.edit',compact('user'));
    }

    
    public function update(Request $request, User $user) {
        
        $request->validate([
            'name'=>['required','min:3'],
            'email' =>['required','min:5'],
        ]);

        if ($request->hasFile('file')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png'
            ]);

            $request->file->store('user', 'public');
            
            $user->profile = $request->file->hashName();

        }

        $user->update([
            'name' => $request->get('name'),
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'bio' => $request->get('bio'),
        ]);
        $user->save();

        // $user->update($request->all());

        if (auth()->user()->id != $user->id) {
            return redirect()
            ->route('user.index')
            ->with('success','user edited')
            ;
        } else { 
            return redirect()
            ->route('home')
            ->with('success','user edited')
            ;
        }
    }

    public function destroy(User $user) {
        
        $user->delete();

        return redirect()
        ->route('user.index')
        ->with('success','user deleted')
        ;
    }
}
