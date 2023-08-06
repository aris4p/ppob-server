<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected  $fillable=['product_id','pulsa_id','invoice','reference','email','nohp','amount','status','createdAt'];

    public $timestamps = false;


        /**
         * Get the user that owns the Transaction
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function product(): BelongsTo
        {
            return $this->belongsTo(Product::class);
        }
    
}
