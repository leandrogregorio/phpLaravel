<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Client extends Model
{
    use HasFactory;
    use softDeletes;
    protected $fillable = ['name','email','phone','address','number','complement','district',
                           'county','state','country','zip_code','rg','cpf_cnpj'];
                             
}
