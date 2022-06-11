<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pariwisata_destinasi_detail extends Model
{
    // use Notifiable;
    protected $fillable = [
        "description","lokasi","biaya_masuk","latitude","image_list","longitude","destinasi_id"
    ];

    protected $casts  = [
        "image_list" => "array"
    ];
}
