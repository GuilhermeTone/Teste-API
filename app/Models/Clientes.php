<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;
    protected $fillable = ['Nome', 'Telefone', 'CPF', 'PlacaCarro'];

    // public function products()
    // {
    //     return $this->hasMany(Product::class);
    // }
}
