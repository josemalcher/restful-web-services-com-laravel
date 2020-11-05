<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description'];

    public function rules()
    {
        return [
            'name' => 'required|min:3|max100|unique:products',
            'description'=> 'required|min:3|max1500'
        ];
    }
}
