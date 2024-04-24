<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_url',
        'image_public_id',
        'price',
        'barcode',
        'quantity',
        'cabinet',
        'category_id',
        'supplier_id',
        'user_id',
        'created_by',
        'updated_by',
    ];

    protected static function boot()
    {
        parent::boot();

        // Generate a UUID automatically when creating a new product and limit it to 6 characters
        static::creating(function ($product) {
            $uuid = Str::uuid();
            $product->id = substr($uuid, 0, 6); // Limit to the first 6 characters
        });
    }

    // Accessor to return the first 5 characters of the UUID
    public function getIdAttribute($value)
    {
        return substr($value, 0, 6);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
