<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = "id";

    public function client(){
        return $this->hasMany('\App\Models\Client','client_id','client_id');
    }
}
