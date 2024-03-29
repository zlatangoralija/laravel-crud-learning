<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function store(UsersRequest $request)
    {

        //Provjeravanje da li ima passworda, ako ga ima zanemaruje se i unose se ostali podaci u bazu podataka
        if (trim($request->password) == ''){
            $input = $request->except('password');
        } else {
            $input = $request->all();
        }


        //Porvjeravamo da li se uploada fajl, zazim kreiramo fajl sa imenom, smjestamo ga u "Photos" i premjestamo sliku i "images" direktorij
        if ($file = $request->file('photo_id')){

            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id'] = $photo->id;
        }


        $input['password'] = bcrypt($request->password);
        User::create($input);

        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        $user = User::findOrFail($id);

        //Provjeravanje da li ima passworda, ako ga ima zanemaruje se i unose se ostali podaci u bazu podataka
        if (trim($request->password) == ''){
            $input = $request->except('password');
        } else {
            $input = $request->all();
        }

        if ($file = $request->file('photo_id')){
            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['photo_id']= $photo->id;
        }

        $input['password'] = bcrypt($request->password);
        $user->update($input);

        //kreiranje poruke prilikom edita usera
        Session::flash('edited_user', 'The user has been edited');

        return redirect('/admin/users');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        unlink(public_path().$user->photo->file);
        $user->delete();

        //kreiranje poruke prilikom brisanja usera
        Session::flash('deleted_post', 'The user has been deleted');
        return redirect('/admin/users');
    }
}
