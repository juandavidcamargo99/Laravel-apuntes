<?php

namespace App\Http\Controllers;

use App\User; 
use App\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function userIndex()
    {
        $title = 'Listado de usuarios';
        $users = User::all();
        // return view('users')
        // ->with('users',$users)
        // ->with('title',$title);
        return view('users.users', compact('title', 'users'));
    }

    public function userShow(User $user)
    {
        $title= 'Detalle de usuario';
        $message = "Mostrando detalle del usuario: {$user}";
        $profession = Profession::find($user->professionid);
        return view('users.usersdetail',compact('title','user','profession'));
    }

    public function createUser()
    {
        $professions = Profession::all();
        return view('users.userscreate',compact('professions'));
    }
    public function storeUser(User $user)
    {
        $data = request()->validate([
            'professionid' => 'required',
            'name' => 'required',
            'email'=> ['required', 'email', Rule::unique('users')->ignore($user->userid, 'userid')],
            'password' => 'required'
        ]);
        // forma antiguita de hacer las  validaciones
        // if(empty($data['name'])){
        //     return redirect(route('usuarios.nuevo'))->withErrors([
        //         'name' => 'El campo es obligatorio'
        //     ]);
        // }
        factory(User::class)->create([
            'professionid' => $data['professionid'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);
        return redirect()->route('usuarios');
    }

    public function editUser(User $user)
    {
        $professions = Profession::all();
        return view('users.usersedit', ['user' => $user], compact('professions'));
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'professionid' => 'required',
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->userid, 'userid')],
            'password' => ''
        ]);
        if($data['password'] != null){
            $data['password'] = $data['password']; 
        }else{
            unset($data['password']);
        }
        //return redirect("usuarios/{$user->id}");
        $user->update($data);
        return redirect()->route('usuarios.detalles', ['user' => $user["userid"]]);
    }
    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('usuarios');
    }
   
}   
