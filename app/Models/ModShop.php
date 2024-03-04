<?php

namespace App\Models;


use App\Models\Seller;
use App\Models\ModCategory;
use App\Models\ModProducts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModShop extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $guarded = [];
    protected $appends = ['logo_url'];

    public function categories()
    {
        return $this->hasMany(ModCategory::class);
    }


    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where(function ($query) use ($search) {
                foreach (static::getSearchableColumns() as $column) {
                    $query->orWhere($column, 'like', '%'.$search.'%');
                }
            });
    }

    public static function getSearchableColumns()
    {
        // Definiere hier die durchsuchbaren Spalten
        return ['id', 'title', 'email'];
    }

    public function sellers()
    {
        return $this->belongsToMany(Seller::class, 'mod_seller_shops');
    }

    public function getPictureAttribute($value)
    {
        if ($value ) {
            return asset('/uploads/images/user/sellers/' . $value);
        } else {
            return asset('/uploads/images/user/default-avatar.png');
        }
     //   return $value ? asset('storage/' . $value) : asset('storage/images/default.png');
    }

    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return asset('uploads/shops/' . $this->id . '/images/' . $this->logo);
        } else {
            return asset('uploads/images/default/logo.png');
        }
    }

    public function products()
    {
        return $this->hasMany(ModProducts::class, 'shop_id', 'id');
    }


}
