<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Library\Library;
use App\Groups;
use App\User;
use App\UserType;
use Validator;
use Hash;
use Auth;
use Mail;

class UserController extends Controller
{

    public function __construct()
    {
        $this->moduleLink = 'administrator/master-user';
    }

    public function index()
    {
        // Validate Access
        Library::validateAccess('view',$this->moduleLink);

        return view('admin.usermanagement.index')->with('recUser',User::getAll()->get());
    }

    public function create()
    {
        // Validate Access
        Library::validateAccess('create',$this->moduleLink);

        return view('admin.usermanagement.create')
        ->with('recGroup',Groups::where('is_active',1)->get())
        ->with('recUserType',UserType::where('is_active',1)->get());
    }

    public function store(Request $request)
    {    	
        // dd($request->all());

        $rules=[
            'name'=>'required|min:5|max:100',
            'email'=>'required|min:5|max:100|email|unique:users,email',
            'no_hp'=>'required|min:8|max:30',
            'group_id'=>'required',
            'user_type_id'=>'required',
            'password'=>'required|min:8|max:100'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-user.create'))->withErrors($validation)->withInput();
        }

        $activationCode = strtolower(Str::random(65));

        $user = new User;
        $user->name = trim($request->input('name'));
        $user->email = trim($request->input('email'));
        $user->no_hp = trim($request->input('no_hp'));
        $user->group_id = $request->input('group_id');
        $user->user_type_id = $request->input('user_type_id');
        $user->password = Hash::make(trim($request->input('password')));
        $user->is_active = 1;
        $user->is_verified = 0;
        $user->activation_code = $activationCode;
        $user->save();

        if($request->has('verified')){
            $data = [
                'name'=> trim($request->input('name')),
                'email'=> trim($request->input('email')),
                'code'=> $activationCode,
                'id'=> $user->id,
                'link'=>url('')
            ];
        
            Mail::send('emails.registerconfirmation', $data, function($message) use($data) {
                $message->to($data['email'], $data['name']);
                $message->subject('User Activation');
                $message->from(env('MAIL_FROM'),env('MAIL_NAME_FROM'));
            });
        }

        return redirect(route('master-user.index'))->with('success-update','Your work has been saved!');
    }

    public function edit($id)
    {
        // Validate Access
        Library::validateAccess('update',$this->moduleLink);

    	return view('admin.usermanagement.edit')
        ->with('recGroup',Groups::where('is_active',1)->get())
        ->with('recUserType',UserType::where('is_active',1)->get())
        ->with('recUserByID',User::find($id));
    }

    public function update($id, Request $request)
    {
        $rules=[
            'name'=>'required|min:5|max:100',
            'email' => 	[	
					        'required',
					        Rule::unique('users')->ignore($id),
					    ],
            'no_hp'=>'required|min:8|max:30',
            'group_id'=>'required',
            'user_type_id'=>'required',
            'is_active'=>'required'
        ];

        $validation = Validator::make($request->input(),$rules);
        if($validation->fails()) {  
          return redirect(route('master-user.edit',['id'=>$id]))->withErrors($validation)->withInput();
        }

        $password = trim($request->input('password'));

        $user = User::find($id);
        $user->name = trim($request->input('name'));
        $user->email = trim($request->input('email'));
        $user->no_hp = trim($request->input('no_hp'));
        $user->is_active = $request->input('is_active');
        $user->group_id = $request->input('group_id');
        $user->user_type_id = $request->input('user_type_id');
        if($password!='') $user->password = Hash::make($password);
        $user->save();

        return redirect(route('master-user.index'))->with('success-update','Your work has been saved!');
    }


    public function sentCode($id)
    {
        $activationCode = strtolower(Str::random(65));

        $user = User::find($id);
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
    
        Mail::send('emails.registerconfirmation', $data, function($message) use($data) {
            $message->to($data['email'], $data['name']);
            $message->subject('User Activation');
            $message->from(env('MAIL_FROM'),env('MAIL_NAME_FROM'));
        });

        return redirect(route('master-user.index'))->with('success-update','Your work has been saved!');
    }

}
