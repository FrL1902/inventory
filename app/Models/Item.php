<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
        'item_name',
        'stocks',
        'item_pictures',
    ];

    protected $primaryKey = 'item_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function incoming()
    {
        return $this->hasMany(Incoming::class, 'item_id');
    }

    public function outgoing()
    {
        return $this->hasMany(Outgoing::class, 'item_id');
    }

    public function pallet()
    {
        return $this->hasMany(Pallet::class, 'item_id');
    }

    public function inPallet()
    {
        return $this->hasMany(InPallet::class, 'item_id');
    }

    public function outPallet()
    {
        return $this->hasMany(OutPallet::class, 'item_id');
    }

    // public static function checkNullItemBrand($id)
    // {
    //     // $nullCheckItem = Item::where('brand_id', $id)->first();
    //     // if (is_null($nullCheckItem)) {
    //     //     return "kosong";
    //     // } else {
    //     //     return "ada";
    //     // }


    //     // this is v2, above this is v1
    //     if (Item::where('brand_id', $id)->exists()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public static function checkItemDeletable($id)
    // {
    //     // $itemIncoming = Incoming::where('item_id', $id)->first();
    //     // $itemOutgoing = Outgoing::where('item_id', $id)->first();

    //     // if (is_null($itemIncoming) && is_null($itemOutgoing)) {
    //     //     return "kosong";
    //     // } else {
    //     //     return "ada";
    //     // }

    //     this is v2, above this is v1
    //     if (Incoming::where('item_id', $id)->exists() || Outgoing::where('item_id', $id)->exists()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
