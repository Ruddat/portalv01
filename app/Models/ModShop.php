<?php

namespace App\Models;


use App\Models\Seller;
use App\Models\ModOrders;
use App\Models\ModCategory;
use App\Models\ModProducts;
use Illuminate\Support\Str;
use App\Models\DeliveryArea;
use App\Models\ModSysStornos;
use App\Models\ModSellerHoliDay;
use App\Models\ModSellerVotings;
use App\Models\ModSellerWorktimes;
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

        static::creating(function ($restaurant) {
            $restaurant->shop_slug = $restaurant->generateSlug($restaurant->title . '-' . $restaurant->city, 'shop_slug');
        });

        static::updating(function ($restaurant) {
            $restaurant->shop_slug = $restaurant->generateSlug($restaurant->title . '-' . $restaurant->city, 'shop_slug');
        });
    }

    public function sluggable(): array
    {
        return [
            'shop_slug' => [
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
        // Erstelle den Slug nur aus dem Titel und der Stadt
        $slug = Str::slug($value);

        // Stelle sicher, dass der Slug eindeutig ist
        return $this->ensureUniqueSlug($slug);
    }


    public function categories()
    {
        return $this->hasMany(ModCategory::class, 'shop_id');
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


    // fuer kopiershop

    public function openingHours()
    {
        return $this->hasMany(ModSellerWorktimes::class, 'shop_id');
    }

    public function holidays()
    {
        return $this->hasMany(ModSellerHoliDay::class, 'shop_id');
    }
    public function deliveryAreas()
    {
        return $this->hasMany(DeliveryArea::class, 'shop_id');
    }
    public function orders()
    {
        return $this->hasMany(ModOrders::class, 'parent');
    }

    public function votes()
    {
        return $this->hasMany(ModSellerVotings::class, 'shop_id');
    }


    public function stornos()
    {
        return $this->hasMany(ModSysStornos::class, 'shop_id');
    }

}
