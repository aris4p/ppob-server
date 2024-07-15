<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Product extends Model
{
    use HasFactory;

    protected  $fillable=['kategori','kd_produk','nama','qty','harga','gambar'];

    public function transaction(): hasOne
    {
        return $this->hasOne(Transaction::class);
    }
}
