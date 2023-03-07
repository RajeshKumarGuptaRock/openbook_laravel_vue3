<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = "client_id";

    public function contact(){
        return $this->hasMany('\App\Models\Contact','client_id','client_id');
    }
}
