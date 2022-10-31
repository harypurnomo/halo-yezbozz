<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BroadcastRecipientLinks;

class TrackController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index(Request $request){
        $id = (int)$request->input('id');
        $redirectUrl = $request->input('url');
        BroadcastRecipientLinks::where(['broadcast_rec_id'=>$id,'broadcast_link'=>$redirectUrl])->update(['is_clicked'=>1,'clicked_at'=>date('Y-m-d H:i:s')]);

        return redirect($redirectUrl);
    }

}
