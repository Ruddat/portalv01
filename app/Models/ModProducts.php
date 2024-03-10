<?php

namespace App\Models;

use App\Models\ModShop;
use App\Models\ModBottles;
use App\Models\ModCategory;
use App\Models\ModProductSizes;
use App\Models\ModProductSizesPrices;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModProducts extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = [];


    public function shop()
    {
        return $this->belongsTo(ModShop::class);
    }

    public function productSizes()
    {
        return $this->hasMany(ModProductSizes::class, 'parent', 'id')->orderBy('ordering');
       // return $this->hasMany(ModProductSizes::class, 'product_id', 'id');

    }

    public function productSizesPrices()
    {
        return $this->hasMany(ModProductSizesPrices::class, 'parent', 'id');
    }


    public function category()
    {
     //   return $this->belongsTo(ModCategory::class);
       // return $this->belongsTo(ModCategory::class, 'category_id'); // 'category_id' ist die Fremdschlüsselspalte in der Tabelle 'mod_products'
       return $this->belongsTo(ModCategory::class, 'category_id');

    }

    public function bottle()
    {
        return $this->belongsTo(ModBottles::class, 'bottles_id');
    }


    public function sluggable(): array
    {
        return [
            'product_slug' => [
                'source' => ['shop.title', 'product_title'],
                'separator' => '-',
            ]
        ];
    }

    public function getProductImageUrlAttribute()
    {
        $shopId = $this->shop_id; // Annahme: Das Shop-ID-Attribut im Modell ist 'shop_id'

        if ($this->product_image) {
            return asset('uploads/shops/' . $shopId . '/images/products/' . $this->product_image);
        } else {
            return asset('/images/default/small/shopping-cart.png'); // Hier solltest du den Pfad zum Standardbild anpassen
        }
    }


// product mit bild loeschen
public function deleteProduct(Request $request)
{
    $productId = $request->productId;
    $product = ModProducts::findOrFail($productId);

    // Überprüfen, ob das Produktbild vorhanden ist und löschen
    if ($product->product_image) {
        $imagePath = 'uploads/shops/' . $product->shop_id . '/images/products/' . $product->product_image;
        if (file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }
    }

    // Produkt aus der Datenbank löschen
    $product->delete();

    // Erfolgsmeldung zurückgeben
    return response()->json(['success' => true, 'message' => 'Product deleted successfully']);
}


}
