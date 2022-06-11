<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class pariwisata_image_carousel extends Model
{
    use Notifiable;
    protected $fillable = ["filename" , "urls", "status"];
    protected $hidden = ["created_at","updated_at","status"];
}
