<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Post;
use App\Kpost;
use Carbon\Carbon;
use App\VerifyUser;
use App\Mail\VerifyMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'language' => 'es'
        ]);

        //Crear el post del usuario
        $post = Post::create([
          'title' => $data['name'],
          'type_id' => 24,
          'ref_id' => $user->id,
          'user_id' => $user->id,
          'published_at' => Carbon::now('UTC')
        ]);

        $kpost = Kpost::create([
          'post_id' => $post->id,
          'user_id' => $user->id,
          'sent_by' => $user->id,
          'sent_at' => Carbon::now('UTC') 
        ]);

        $verifyUser = VerifyUser::create([
           'user_id' => $user->id,
           'token' => sha1($user->name.time())
        ]);

         $data = [
          'name' => $user->name,
          'email' => $user->email,
          'token' => $verifyUser->token
        ];

        Mail::send('emails.verifyUser', $data, function($message) use ($data) {
          $message->to($data['email'], $data['name'])
                  ->from('no-reply@kodelia.com')
                  ->subject(__('messages.user-registration'));
        });

        return $user;
    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser))
        {
            $user = $verifyUser->user;
            if(!$user->verified)
            {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = __('messages.email-verified');                
            } 
            else 
            {
                $status = __('messages.email-already-verified');
            }
        } 
        else 
        {
            return redirect('/user/login')->with('warning', __('messages.email-not-verified'));
        }       
        return redirect('/user/login')->with('status', $status); 
    }

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('/user/login')->with('status', __('messages.check-email'));
    }
}
