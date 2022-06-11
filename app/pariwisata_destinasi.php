<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class pariwisata_destinasi extends Model
{
    use Notifiable;
    protected $fillable = [
        "nama","kota","rating","image_filename","image_urls","status","categori"
    ];

    public function get_detail(){
        return $this->hasOne(pariwisata_destinasi_detail::class,'destinasi_id','id');
    }
}
