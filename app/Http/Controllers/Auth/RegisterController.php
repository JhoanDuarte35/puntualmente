<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'username'=>['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono'=>['required', 'numeric', 'unique:users', 'min:10', 'max:10'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ],
        [
            'nombre.required'=>'El campo No puede estar vacio',
            'apellido.required'=>'El campo No puede estar vacio',
            'username.required'=>'El campo No puede estar vacio',
            'email.required'=>'El campo No puede estar vacio',
            'password.required'=>'El campo No puede estar vacio',
            'telefono.required'=>'La El campo No puede estar vacio',
            'password.required'=>'La El campo No puede estar vacio',


            'username.unique'=>'El nombre de usuario ya existe',
            'email.unique'=>'El correo ya existe',
            'telefono.unique'=>'El telefono ya existe',


            'password.confirmed'=>'Las contraseñas no coinciden',
            'telefono.numeric' => 'El telefono debe ser de tipo numerico',

            'password.min'=>'La contraseña debe tener minimo 8 caracteres',
            'telefono.min'=>'La numero debe tener minimo 10 caracteres',
            'telefono.max'=>'La numero debe tener maximo 10 caracteres',






        ]
    
    );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
