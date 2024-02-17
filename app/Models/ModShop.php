<?php

namespace App\Models;


use App\Models\Seller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModShop extends Model
{
    use HasFactory;

    protected $guarded = [];


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

}
