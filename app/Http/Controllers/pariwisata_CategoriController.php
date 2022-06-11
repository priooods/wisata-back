<?php

namespace App\Http\Controllers;

use App\pariwisata_categori_menu;
use Carbon\Carbon;
use Illuminate\Http\Request;

class pariwisata_CategoriController extends Controller
{

    public function __construct()
    {
        $this->middleware('pariwisata:api');
    }

    public function add(Request $request){
        if ($validate = $this->validing($request->all(),[
            'menu_name' => 'required',
            'files' => 'required'
        ]))
            return $validate;

        $file = $request->file('files');
        $filename = Carbon::now()->format('Ymdhis') . '_' . $file->getClientOriginalName();
        $file->move(public_path('icons'), $filename);

        $request["menu_icon_name"] = $filename;
        
        $categori = pariwisata_categori_menu::create($request->all());
        return $this->resSuccess($categori);
    }

    public function show(){
        $categori = pariwisata_categori_menu::where('menu_status',0)->get();
        $this->mapping_category_url($categori);
        return $this->resSuccess($categori);
    }

    public function change_status(Request $request){
        if ($validate = $this->validing($request->all(),[
            'id' => 'required',
            'menu_status' => 'required'
        ]))
            return $validate;

        $categori = pariwisata_categori_menu::where('id',$request->id)->first();
        if(!is_null($categori))
            $categori->update(['menu_status', $request->menu_status]);
        
        return $this->resSuccess($categori);
    }

    public function mapping_category_url($categori){
        foreach ($categori as $value) {
            $value['urls'] = "http://". env('SERVER_ADDR'). "/Angeline_Laravel/public/icons" . '/' . $value->menu_icon_name;
        }
    }
}
