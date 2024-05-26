<?php

namespace App\Models;


use App\Models\Seller;
use App\Models\ModCategory;
use App\Models\ModProducts;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModShop extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;


    protected $guarded = [];
    protected $appends = ['logo_url'];



    protected static function boot()
    {
        parent::boot();

        static::updating(function ($restaurant) {
            $restaurant->shop_slug = Str::slug($restaurant->title . '-' . $restaurant->city);
        //    $restaurant->shop_slug = Str::slug($restaurant->title);
        });
    }


    public function sluggable(): array
    {
        return [
            'shop_slug' => [
                //'source' => ['title', 'city'],
                'source' => null, // Deaktivieren Sie automatisches Erzeugen des Slugs aus anderen Attributen
                'separator' => '-',
                'unique' => true // Hinzugefügt, um sicherzustellen, dass der Slug eindeutig ist
            ]
        ];
    }

    protected function ensureUniqueSlug($slug)
    {
        $originalSlug = $slug;
        $count = 1;

        // Solange der Slug nicht eindeutig ist, füge eine Nummer hinzu
        while (static::where('shop_slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    protected function generateSlug($value, $attribute)
    {
        $slug = SlugService::createSlug(Restaurant::class, $attribute, $value);

        return $this->ensureUniqueSlug($slug);
    }


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

    public function productSizes()
    {
        return $this->hasMany(ModProductSize::class);
    }


}
