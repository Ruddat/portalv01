<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModShop extends Model
{
    use HasFactory;

    protected $guarded = [];



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

}
