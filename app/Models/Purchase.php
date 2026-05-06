<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'address',
        'contact_number',
        'total_price',
        'payment_method',
    ];

    protected function casts(): array
    {
        return [
            'total_price' => 'decimal:2',
        ];
    }

    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }
}
