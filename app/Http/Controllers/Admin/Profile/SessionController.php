<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use App\UserType;
use App\Company;
use Validator;
use Auth;
use Hash;
use Mail;

class SessionController extends Controller
{
    public function __construct()
    {

    }

    public function info()
    {
        return view('admin.profile.index')
        ->with('recUserType',UserType::all())
        ->with('recCompanyByUserID',Company::where('user_id',Auth::user()->id)->first());
    }

    public function update_info(Request $request)
    {
        $userId = Auth::user()->id;

        $rules=[
            'name' => 'required|min:5|max:100',
            'no_hp' => 'required|min:8|max:30',
            'user_type_id' => 'required',
            'address' => 'required',
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
            $error = '';
            foreach ($validation->errors()->all('<li>:message</li>') as $item) {
                $error .= $item;
            }
            return redirect(route('profile'))->with('error',$error);
        }

        $user = User::find($userId);
        $user->user_type_id = trim($request->input('user_type_id'));
        $user->name = trim($request->input('name'));
        $user->no_hp = trim($request->input('no_hp'));
        $user->address = trim($request->input('address'));

        //Avatar
        if( $request->has('mypic') ) {
            $file = $request->file('mypic');
            $fileName = $userId.'-'.Str::slug($request->input('name')).'.'.$file->getClientOriginalExtension();

            $destinationPath = public_path('uploads/mypic');
            $file->move($destinationPath,$fileName);
            $user->mypic = $fileName;
        }
        $user->save();

        return redirect(route('profile'))->with('success-update','Your work has been saved!');
    }

    public function update_specific_info(Request $request)
    {
        $userId = Auth::user()->id;

        $rules=[
            'company_name' => 'required|min:5|max:100',
            'company_phone' => 'required|min:8|max:50',
            'company_email' => 'required|email|max:50',
            'company_address' => 'required',
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
            $error = '';
            foreach ($validation->errors()->all('<li>:message</li>') as $item) {
                $error .= $item;
            }
            return redirect(route('profile'))->with('error',$error)->with('profile-tab','specific');
        }

        $company = Company::firstOrNew(['user_id' => $request->user_id]);
        $company->user_id = $request->user_id;
        $company->name = trim($request->company_name);
        $company->email = trim($request->company_email);
        $company->phone = trim($request->company_phone);
        $company->fax = trim($request->company_fax);
        $company->address = trim($request->company_address);
        $company->save();

        return redirect(route('profile'))->with('success-update','Your work has been saved!')->with('profile-tab','specific');
    }

    public function change_password()
    {
        return view('admin.profile.change_password');
    }

    public function change_password_action(Request $request)
    {
        // dd($request->all());

        $userId = Auth::user()->id;

        $rules=[
            'current_password'=>'required',
            'new_password'=>'required|min:8',
            'verify_password'=>'required|same:new_password',
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          $error = '';
          foreach ($validation->errors()->all('<li>:message</li>') as $item) {
            $error .= $item;
          }
          return redirect(route('change.password'))->with('errors',$error);
        }

        if (Hash::check($request->input('current_password'), Auth::user()->password)) {
            $user = User::find($userId);
            $user->password = Hash::make($request->input('new_password'));
            $user->save();

                //sent email for verification
                $activationCode = strtolower(Str::random(65));

                $user = User::find($userId);
                $user->is_verified = 0;
                $user->activation_code = $activationCode;
                $user->save();

                $data = [
                    'name'=> $user->name,
                    'email'=> $user->email,
                    'code'=> $activationCode,
                    'id'=> $user->id,
                    'link'=> url('')
                ];
            
                Mail::send('emails.change-password-confirmation', $data, function($message) use($data) {
                    $message->to($data['email'], $data['name']);
                    $message->subject('User Activation');
                    $message->from(env('MAIL_FROM'),env('MAIL_NAME_FROM'));
                });

        } else {
            return redirect(route('change.password'))->with('errors','The current password you entered was not correct!');
        }

        return redirect(route('change.password'))->with('success-update','Your work has been saved!');
    }

}
