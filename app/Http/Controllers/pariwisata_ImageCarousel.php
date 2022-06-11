<?php

namespace App\Http\Controllers;

use App\pariwisata_image_carousel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class pariwisata_ImageCarousel extends Controller
{

    public function __construct()
    {
        $this->middleware('pariwisata:api');
    }

    public function show(){
        $carousel = pariwisata_image_carousel::where('status','0')->get();
        foreach ($carousel as $value) {
            $value->urls = "http://". env('SERVER_ADDR'). "/Angeline_Laravel/public/image" . '/' . $value->filename;
        }
        return $this->resSuccess($carousel);
    }

    public function add(Request $request){
        if ($validate = $this->validing($request->all(),[
            'files' => 'required',
        ]))
            return $validate;


        // Mapping images
        $file = $request->file('files');
        $filename = Carbon::now()->format('Ymdhis') . '_' . $file->getClientOriginalName();
        $file->move(public_path('image'), $filename);

        // setup value to db
        $request["filename"] = $filename;
        $request["urls"] = "http://". env('SERVER_ADDR'). "/Angeline_Laravel/public/image" . '/' . $filename;
        $images = pariwisata_image_carousel::create($request->all());

        return $this->resSuccess($images);
    }
}
