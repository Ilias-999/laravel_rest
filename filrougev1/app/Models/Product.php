<?php

namespace App\Models;

use App\Models\Pivots\OrderProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->using(OrderProduct::class); //->withPivot('quantity');
    }

}
