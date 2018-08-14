<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\User;
use App\Role;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;


class UsersController extends Controller
{

    public function __construct(){

        $this->middleware('auth',['except' => ['show','index']]);
        $this->middleware('roles:admin,comen',['except' => ['edit','update','show','index']]);
    }

    public function index()
    {
        $key1 = "users.page".request('page',1);

        if(request('sorted') !== null ){
            Cache::flush();
        }

        $users = Cache::Remember($key1, 15, function(){

            return User::with(['roles','note','tags'])
                    ->orderBy('created_at',request('sorted','ASC'))
                    ->paginate(5);//with octimizar la consulta SQL
        });
        
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::pluck('display_name', 'id');
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreateUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        
        $u = User::create(array_slice($request->validated(), 0,3));
        $u->roles()->attach($request->roles);
        Cache::flush();
        
        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$u = User::findOrFail($id);

        $u = Cache::remember("users.{$id}", 5, function() use ($id){

            return User::findOrFail($id);
        });


        return view('users.show',compact('u'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $u = Cache::remember("users.{$id}", 5, function() use ($id){

            return User::findOrFail($id);
        });

        $this->authorize('edit', $u);

        $roles = Role::pluck('display_name', 'id');
        
        return view('users.edit',compact('u','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
         
        $u = User::findOrFail($id);
        $this->authorize('update', $u);
        $u->update($request->validated());
        $u->roles()->sync($request->roles);

        Cache::flush();
        
        return back()->with('info','Usuario actualizado');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $u = User::findOrFail($id);
        $this->authorize('delete', $u);
        $u->delete($request->validated());

        Cache::flush();
      

        return back()->with('info','Usuario Eliminado');

    }
}
