<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $fillable = [
        'customer_id',
        'customer_name',
        'address',
        'email',
        'phone1',
        'phone2',
        'fax',
        'website',
        'pic',
        'pic_phone',
        'npwp_perusahaan',
    ];

    protected $primaryKey = 'customer_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function brand()
    {
        return $this->hasMany(Brand::class, 'customer_id');
    }

    public function item()
    {
        return $this->hasMany(Item::class, 'customer_id');
    }

    public function user_access()
    {
        return $this->hasMany(UserAccess::class, 'customer_id');
    }
}
