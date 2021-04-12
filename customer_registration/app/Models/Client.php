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
    
    /*lembrando de incluir o accept no Header na aplicação Client para que seja 
    posivel receber a validação via JSON*/

    public function rules(){
        return  [
            'email'=>'required|unique:clients,email,'.$this->id,
            'cpf_cnpj'=>'required|unique:clients,cpf_cnpj,'.$this->id,
            'rg'=>'required|unique:clients,rg,'.$this->id
        ];
    }                  

    public function feedback(){
        return  [
            'unique' => 'O :attribute do cliente já existe',
            'required' => 'O campo :attribute é obrigatorio!'
        ];
    }
}
