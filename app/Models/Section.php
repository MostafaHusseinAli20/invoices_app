<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_name' ,
        'section_description', 
        'Created_by'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'section_id');
    }

}
