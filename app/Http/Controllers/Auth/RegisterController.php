<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request; 
use Auth;
use App\Rules\Captcha;

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
    protected $redirectTo = '/home';

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'country' => ['required', 'string'],
            'phone' => ['required', 'string', 'min:10'],
            'referredBy' => ['sometimes'],
            'referralId' => ['sometimes'],
            'g-recaptcha-response' => new Captcha(),
            
        ]);

    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if (isset($data['referredBy']) && isset($data['referralId'])) {

            $user = User::where(['id'=> $data['referredBy'],'referralId'=>$data['referralId']])->first();
            
            if($user) {
                
                return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'country' => $data['country'],
                    'phone' => $data['phone'],
                    'referralId' => Uuid::uuid4(),
                    'visitor' => request()->ip(),
                    'referredBy' => $data['referredBy'],
                ]);
            } 
            else {

                return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'country' => $data['country'],
                    'phone' => $data['phone'],
                    'visitor' => request()->ip(),
                    'referralId' => Uuid::uuid4(),
                ]);
            }
        }
        else 
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'country' => $data['country'],
                'phone' => $data['phone'],
                'visitor' => request()->ip(),
                'referralId' => Uuid::uuid4(),
            ]);
        }
}
