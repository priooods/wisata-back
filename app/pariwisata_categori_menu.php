<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class pariwisata_categori_menu extends Model
{
    use Notifiable;
    protected $fillable = ['menu_name','menu_icon_name','menu_status'];
}
