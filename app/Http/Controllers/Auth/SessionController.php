<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Mail;
use Hash;
use Illuminate\Support\Str;
use Validator;
use App\User;
use App\ForgetPassword;
use Socialite;

class SessionController extends Controller
{

	public function login(Request $request,$lang)
    {   
        // dd($request->all());

        $rules=[
            'email'=>'email',
            'password'=>'required',
            'g-recaptcha-response'=>'required|recaptcha'
        ];
        $message=[
            'g-recaptcha-response.recaptcha' => 'Captcha verification failed',
            'g-recaptcha-response.required' => 'Please complete the captcha'     
        ];

        $email = trim($request->input('email'));
        $password = trim($request->input('password'));

        $validation = Validator::make($request->input(),$rules,$message);
        if($validation->fails()) {  
            return redirect(route('lang.signin',['lang'=>$lang]))->withErrors($validation)->withInput();
        }

        if( Auth::attempt(['email'=>$email, 'password'=>$password, 'is_active'=>'1']) )
        {
            return redirect(route('dashboard'));
        } 
        else{
            return view('public.v1.sign-in')
            ->with('lang',$lang)
            ->with('error','Your email/password is invalid. Please try again !');
        } 
    }

	public function register(Request $request,$lang)
    {

        // dd($request->all());

		$rules=[
            'name'=>'required|min:3|max:100',
            'email'=>'required|email|unique:users,email',
            'no_hp'=>'required|min:8|max:20',
            'password'=>'required|min:6',
            'user_type'=>'required|exists:user_type,type_id',
            'g-recaptcha-response'=>'required|recaptcha'
        ];
        $message=[
            'g-recaptcha-response.recaptcha' => 'Captcha verification failed',
            'g-recaptcha-response.required' => 'Please complete the captcha'     
        ];

        if(!$request->input('agree')){
            
            return view('public.v1.sign-up')
            ->with('lang',$lang)
            ->with('error','Please check the Terms of Service !');
        
        }else{
            
            $validation = Validator::make($request->input(),$rules,$message);
            if($validation->fails()) {  
              return redirect(route('lang.signup',['lang'=>$lang]))->withErrors($validation)->withInput();
            }

            $activationCode = strtolower(Str::random(65));
            $email = trim($request->input('email'));

            $newRecord = new User;
            $newRecord->name = trim($request->input('name'));
            $newRecord->email = $email;
            $newRecord->no_hp = trim($request->input('no_hp'));
            $newRecord->user_type_id = trim($request->input('user_type'));
            $newRecord->password = bcrypt(trim($request->input('password')));         
            $newRecord->group_id = 1; //is member
            $newRecord->is_active = 0;
            $newRecord->is_verified = 0;
            $newRecord->activation_code = $activationCode;
            $newRecord->save();
            $userId = $newRecord->id;

            $data = [
                'name'=> trim($request->input('name')),
                'email'=> $email,
                'code'=> $activationCode,
                'id'=> $userId,
                'link'=> url('')
            ];
        
            Mail::send('emails.registerconfirmation', $data, function($message) use($data) {
                $message->to($data['email'], $data['name']);
                $message->subject('User Activation');
                $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'));
            });

            return redirect(route('lang.successmessage',['lang'=>$lang]));
        }
    }
    
    public function activate_user($id,$kode)
    {
        $user = User::where(['id'=>$id,'activation_code'=>$kode])->first();
        if($user) 
        {
            $user->is_verified = 1;
            $user->is_active = 1;
            $user->update();

            Auth::loginUsingId($id);

            return redirect('administrator/dashboard')->with('success-update','Activation process successful!');
        } 
        else 
        {
            return redirect('en/home')->with('info','Code not found!');
        }
    }

    public function forgot_password(Request $request,$lang)
    {
        // dd($request->all());
        $rules=[
            'email'=>'required|email',
            'g-recaptcha-response'=>'required|recaptcha'
        ];
        $message=[
            'g-recaptcha-response.recaptcha' => 'Captcha verification failed',
            'g-recaptcha-response.required' => 'Please complete the captcha'     
        ];
        $validation = Validator::make($request->input(),$rules,$message);
        if($validation->fails()) {
            return redirect(route('lang.forgotpassword',['lang'=>$lang]))->withErrors($validation)->withInput();
        }

        $email = trim($request->input('email'));
        $user = User::where(['email'=>$email])->first();
        
        if($user) 
        {
            $token = strtolower(Str::random(65));
            $reset = new ForgetPassword;
            $reset->email = $email;
            $reset->token = $token;
            $reset->save();

            $data = [
                'name'=>$user->name,
                'email'=>$user->email,
                'id'=>$user->id,
                'token'=>$token,
                'lang'=>$lang
            ];

            Mail::send('emails.fotgot-password', $data, function($message) use($data) {
                $message->to($data['email'], $data['name']);
                $message->subject('Your password has been reset');
                $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'));
            });

            return redirect(route('lang.successmessage',['lang'=>$lang]));
        } 
        else 
        {
            return view('public.v1.forgot-password')
            ->with('lang',$lang)
            ->with('error','Your email is invalid. Please try again !');
        }
    }

    public function forgot_password_form($lang,$id,$token)
    {
        $validToken = ForgetPassword::where(['token'=>$token])->first();
        if(!$validToken) return redirect('en/home')->with('error','Token not found!');
        return view('public.v1.reset-password')
        ->with('lang',$lang)
        ->with('id',$id)
        ->with('token',$token);
    }

    public function forgot_password_action(Request $request)
    {
        // dd($request->all());

        $rules=[
            'new_password'=>'required|min:6',
            'new_password_confirmation'=>'required|same:new_password',
        ];

        $messages=[
            'new_password.required'=>'The new password must be filled in',
            'new_password.min'=>'Password must be at least 6 characters long',
            'new_password_confirmation.required'=>'Confirmation New password must be filled',
            'new_password_confirmation.same'=>'The new password and confirmation password are not the same'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('reset.password.form',['lang'=>$request->input('lang'),'id'=>$request->input('user_id'),'token'=>$request->input('token')]))->withErrors($validation)->withInput();
        }

        $userId = $request->input('user_id');
        $token = $request->input('token');
        $password = trim($request->input('new_password'));

        $user = User::find($userId);
        if($user) 
        {
            $user->is_active = 1;
            $user->is_verified = 1;
            $user->password = Hash::make($password);
            $user->update();

            Auth::loginUsingId($userId);

            return redirect(route('lang.successmessage',['lang'=>$request->input('lang')]));
        }
    }

	public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    // Google Login
    public function langGoogleSignUp($lang, Request $request)
    {
        $request->session()->put('lang', $lang);
        return Socialite::driver('google')->redirect();
    }

    // Google Redirect
    public function langGoogleSignUpRedirect(Request $request)
    {
        // dd( $request->session()->get('lang') );
        $lang = $request->session()->get('lang');
        $user = Socialite::driver('google')->stateless()->user();
        $name = $user->getName();
        $email = $user->getEmail();

        $recUser = User::where(['email'=>$email])->first();
        if($recUser) 
        {
            $userId = $recUser->id;
            Auth::loginUsingId($userId);
            return redirect(route('dashboard'));
        }
        else
        {
            return view('public.v1.google-signup-password')
            ->with('lang',$lang)
            ->with('name',$name)
            ->with('email',$email);
        }
    }

    public function langGoogleSignUpAction(Request $request)
    {
        // dd($request->input());
        $newRecord = new User;
        $newRecord->name = trim($request->input('name'));
        $newRecord->email = trim($request->input('email'));
        $newRecord->password = bcrypt(trim($request->input('password')));         
        $newRecord->group_id = 1; //is member
        $newRecord->is_active = 1;
        $newRecord->is_verified = 1;
        $newRecord->save();
        $userId = $newRecord->id;

        Auth::loginUsingId($userId);

        return redirect(route('dashboard'));
    }

}
