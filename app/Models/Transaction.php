<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        "uuid",
        "user_id",
        "product_id",
        "amount",
        "tax",
        "admin_fee",
        "total"
    ];
    public function details(){
        return $this->hasMany(TransactionDetail::class, 'transactions_id');
    }
}
