<?php

namespace App\Http\Controllers;

use App\pariwisata_destinasi;
use App\pariwisata_destinasi_detail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class pariwisata_DestinasiController extends Controller
{

    public function __construct()
    {
        $this->middleware('pariwisata:api');
    }

    public function add(Request $request){
        if ($validate = $this->validing($request->all(),[
            'nama' => 'required',
            'kota' => 'required',
            'categori' => 'required',
            'files' => 'required',
        ]))
            return $validate;

        // setup files
        $file = $request->file('files');
        $filename = Carbon::now()->format('Ymdhis') . '_' . $file->getClientOriginalName();
        $file->move(public_path('image'), $filename);

        $request["image_filename"] = $filename;
        $request["image_urls"] = "http://". env('SERVER_ADDR'). "/Angeline_Laravel/public/image" . '/' . $filename;
        $destinasi = pariwisata_destinasi::create($request->all());

        return $this->resSuccess($destinasi);
    }

    public function add_details(Request $request){
        if ($validate = $this->validing($request->all(),[
            'description' => 'required',
            'lokasi' => 'required',
            'biaya_masuk' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'destinasi_id' => 'required',
        ]))
            return $validate;

        // mapping images
        $file_mapping = [];
        if(count($request->file()) > 0){
            foreach ($request->file('files') as $value) {
                $filename = Carbon::now()->format('Ymdhis') . '_' . $value->getClientOriginalName();
                $value->move(public_path('image_destination_detail'), $filename);
                array_push($file_mapping,$value->getClientOriginalName());
            }
            $request["image_list"] = $file_mapping;
        }
        $des_detail = pariwisata_destinasi_detail::create($request->all());
        return $this->resSuccess($des_detail);
    }

    public function show_header(){
        $destinasi = pariwisata_destinasi::all();
        $this->mapping_image_header_url($destinasi);
        return $this->resSuccess($destinasi);
    }

    public function show_header_detail(Request $request){
        if ($validate = $this->validing($request->all(),[
            'destinasi_id' => 'required'
        ]))
            return $validate;

        $destinasi = pariwisata_destinasi_detail::where('destinasi_id', $request->destinasi_id)->first();
        if(!is_null($destinasi)) $this->mapping_image_header_detail_url($destinasi);
        return $this->resSuccess($destinasi);
    }

    public function show_destinasi_by_categori(Request $request){
        if ($validate = $this->validing($request->all(),[
            'categori' => 'required'
        ]))
            return $validate;

        $destinasi = pariwisata_destinasi::where('categori', $request->categori)->get();
        $this->mapping_image_header_url($destinasi);
        return $this->resSuccess($destinasi); 
    }

    public function mapping_image_header_url($destinasi){
        foreach ($destinasi as $value) {
            $value->image_urls = "http://". env('SERVER_ADDR'). "/Angeline_Laravel/public/image" . '/' . $value->image_filename;
        }
    }

    public function mapping_image_header_detail_url($destinasi){
        $image_list = [];
        foreach ($destinasi->image_list as $value) { 
            array_push($image_list,"http://". env('SERVER_ADDR'). "/Angeline_Laravel/public/image_destination_detail" . '/' .$value);
        }
        $destinasi->image_list = $image_list;
    }
}
