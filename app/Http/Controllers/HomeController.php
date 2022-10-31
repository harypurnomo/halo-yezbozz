<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use DB;
use Session;
use App\Banners;
use App\Services;
use App\Testimonials;
use App\Teams;
use App\Patners;
use App\Facilities;
use App\Articles;
use App\ContactUs; 
use App\Subscribe; 
use App\Products;
use App\Popup;
use App\UserType;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * START HOMEPAGE
    **/
    public function index()
    {
        return redirect(route('lang.signin',['lang'=>'en']));
        // return view('public.v2.home')
        // ->with('lang',NULL)
        // ->with('recPatner',Patners::where('is_active',1)->orderBy('sort', 'asc')->get())
        // ->with('recTestimonial',Testimonials::where('is_active',1)->get())
        // ->with('recArticle',Articles::getAllIsActive()->limit(3)->get())
        // ->with('recPopup',Popup::where('is_active',1)->orderBy('created_at', 'desc')->first())
        // ->with('recProducts',Products::getAllIsActive()->get());
    }

    public function langHome($lang)
    {
        return view('public.v2.home')
        ->with('lang',$lang)
        ->with('recPatner',Patners::where('is_active',1)->orderBy('sort', 'asc')->get())
        ->with('recTestimonial',Testimonials::where('is_active',1)->get())
        ->with('recArticle',Articles::getAllIsActive()->limit(3)->get())
        ->with('recPopup',Popup::where('is_active',1)->orderBy('created_at', 'desc')->first())
        ->with('recProducts',Products::getAllIsActive()->get());
    }

    public function langShop($lang)
    {
        return view('public.v2.shop')
        ->with('lang',$lang);
    }

    public function langAbout($lang)
    {
        return view('public.v2.about')
        ->with('lang',$lang);
    }

    public function langBlog($lang)
    {
        return view('public.v2.blog')
        ->with('lang',$lang);
    }

    /**
     * START CONTACT US
    **/
    public function langContactUs($lang){
        return view('public.v1.contact-us')
        ->with('lang',$lang);
    }

    public function SubmitContactUs(Request $request){
        
        $lang = trim($request->input('lang'));

        $rules=[
            'name'=>'required|min:3|max:50',
            'email'=>'required|email',
            'phone_number'=>'required|min:8|max:20',
            'subject'=>'required|min:3|max:50',
            'message'=>'required|min:3|max:140',
            'g-recaptcha-response'=>'required|recaptcha'
        ];
        $message=[
            'g-recaptcha-response.recaptcha' => 'Captcha verification failed',
            'g-recaptcha-response.required' => 'Please complete the captcha'     
        ];

        $validation = Validator::make($request->input(),$rules,$message);
        if($validation->fails()) {  
            $error = '';
            foreach ($validation->errors()->all('<li>:message</li>') as $item) {
                $error .= $item;
            }
            return response()->json(['status'=>0,'message'=>$error], 200);
        }

        $rec = new ContactUs;
        $rec->name = trim($request->input('name'));
        $rec->phone_number = trim($request->input('phone_number'));
        $rec->email = trim($request->input('email'));
        $rec->subject = trim($request->input('subject'));
        $rec->message = trim($request->input('message'));
        $rec->ip = $request->ip();
        $rec->save();

        Mail::send('emails.contactus', ['row'=>$rec,'lang'=>$lang], function($message) use($rec) {
            $message->from(env('MAIL_FROM'),env('MAIL_NAME_FROM'));
            $message->to($rec->email, $rec->name);
            $message->cc(env('MAIL_USERNAME'));
            $message->subject($rec->subject);
            $message->priority(3);
        });

        DB::commit();

        return response()->json(['status'=>'1','message'=>'Thank you for your request.'], 200);
    }

    public function subscribes(Request $request){
        // dd($request->all());

        $lang = trim($request->input('lang'));

        $rules=[
            'email'=>'required|email|unique:subscribe,email',
            'g-recaptcha-response'=>'required|recaptcha'
        ];
        $message=[
            'g-recaptcha-response.recaptcha' => 'Captcha verification failed',
            'g-recaptcha-response.required' => 'Please complete the captcha'     
        ];

        $validation = Validator::make($request->input(),$rules,$message);
        if($validation->fails()) {  
            $error = '';
            foreach ($validation->errors()->all('<li>:message</li>') as $item) {
                $error .= $item;
            }
            return response()->json(['status'=>0,'message'=>$error], 200);
        }
        
        $rec = new Subscribe;
        $rec->email = trim($request->input('email')); 
        $rec->ip = $request->input('ipaddress');
        $rec->save();

        Mail::send('emails.subscribe', ['row'=>$rec,'lang'=>$lang], function($message) use($rec) {
            $message->from(env('MAIL_FROM'),env('MAIL_NAME_FROM'));
            $message->cc(env('MAIL_USERNAME'));
            $message->to($rec->email, $rec->email);
            $message->subject('Email Subscription Request');
        });

        return response()->json(['status'=>'1','message'=>'Thank you for your request.'], 200);
    }

    /**
     * SIGN IN
    **/
    public function langSignIn($lang){        
        return view('public.v1.sign-in')
        ->with('lang',$lang)
        ->with('error',NULL);
    }

    /**
     * SIGN UP
    **/
    public function langSignUp($lang){        
        return view('public.v1.sign-up')
        ->with('recUserType',UserType::where('is_active',1)->get())
        ->with('lang',$lang)
        ->with('error',NULL);
    }

    /**
     * START FORGOT PASSWORD
    **/
    public function langForgotPassword($lang){        
        return view('public.v1.forgot-password')
        ->with('lang',$lang)
        ->with('error',NULL);
    }

    /**
     * START SUCCESS MESSAGE
    **/
    public function langSuccessMessage($lang){        
        return view('public.v1.success-message')->with('lang',$lang);
    }
    
}
