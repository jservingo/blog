<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Post;
use App\Kpost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Events\UserWasCreated;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      /*      
      $users = User::all();
      return view('admin.users.index',compact('users'));
      */
 
      if (auth()->user()->hasPermissionTo('view_users'))
      {
  	    $users = User::all();
      }
      else
      {
        $users = User
        	::where("id","=",auth()->id())
        	->get();
      }
      return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new User);

        $user = new User;
        $roles = Role::pluck('name','id');
        $permissions = Permission::pluck('name','id');
        return view('admin.users.create',compact('user','roles','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', new User);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
        ]);
        $password = str_random(8);
        $data['password'] = bcrypt($password);

        //Crear el usuario
        $user = User::create($data);
        $user->assignRole($request->roles);
        $user->givePermissionTo($request->permissions);

        //Crear el post del usuario
        $post = Post::create([
          'title' => $request->get('name'),
          'type_id' => 24,
          'ref_id' => $user->id,
          'user_id' => $user->id,
          'published_at' => Carbon::now()
        ]);

        $kpost = Kpost::create([
          'post_id' => $post->id,
          'user_id' => $user->id,
          'sent_by' => $user->id,
          'sent_at' => Carbon::now() 
        ]);
        
        //Enviar el email
        UserWasCreated::dispatch($user, $password);

        return redirect()->route('admin.users.index')->withFlash('El usuario ha sido creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view',$user);

        return view('admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update',$user);

    	$roles = Role::pluck('name','id');
        $permissions = Permission::pluck('name','id');
        return view('admin.users.edit',compact('user','roles','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
    	$this->authorize('update',$user);

        //Validación del request 
    	//OJO aqui se hace uso del UpdateUserRequest
        $data = $request->validated();

        //Encriptar contraseña
        $data['password'] = bcrypt($data['password']);

        $user->update($data);

        return back()->withFlash('Usuario actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
       $this->authorize('delete',$user); 

       $user->delete();

       return redirect()->route('admin.users.index')->withFlash('El usuario fue eliminado');
    }
}
