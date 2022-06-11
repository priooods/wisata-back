<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pariwisata_UserController extends Controller
{
    public function updated(Request $request){
        if ($validate = $this->validing($request->all(),[
            'id' => 'required',
        ]))
            return $validate;
    }
}
