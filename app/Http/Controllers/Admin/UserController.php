<?php

namespace LaraDev\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use LaraDev\Http\Controllers\Controller;
use LaraDev\Http\Requests\Admin\User as UserRequest;
use LaraDev\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function team()
    {
        $users = User::where('admin', 1)->get();
        return view('admin.users.team', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $usercreate = User::create($request->all());
        if (!empty($request->file('cover'))){
            $usercreate->cover = $request->file('cover')->store('user');
            $usercreate->save();
        }
        return redirect()->route('admin.users.edit',[
            'user' => $usercreate->id
        ])->with(['color' => 'green', 'message' => 'cliente cadastrado com sucesso.']);

//        $user = new User();
//        $user->fill($request->all());
//        dd($user->getAttributes(), $request->all());
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
        $user = User::where('id', $id)->first();
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->setLessorAttribute($request->lessor);
        $user->setLesseeAttribute($request->lessee);
        if (!empty($request->file('cover'))){
            Storage::delete($user->cover);
            $user->cover = '';
        }
        $user->fill($request->all());
        if (!empty($request->file('cover'))){
            $user->cover = $request->file('cover')->store('user');
        }
        if (!$user->save()){
            return redirect()->back()->withInput()->withErrors();
        }

        return redirect()->route('admin.users.edit',[
            'user' => $user->id
        ])->with(['color' => 'green', 'message' => 'cliente atualizado com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function teste()
    {
        return view('admin.master.teste');
    }
}
