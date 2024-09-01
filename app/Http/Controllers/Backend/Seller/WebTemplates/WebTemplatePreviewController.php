<?php

namespace App\Http\Controllers\Backend\Seller\WebTemplates;

use App\Models\ModShop;
use Illuminate\Http\Request;
use App\Models\ModProductSales;
use App\Models\ModSellerHoliDay;
use App\Models\ModSellerVotings;
use App\Models\ModSellerWorktimes;
use App\Models\ModSharedTemplates;
use App\Models\ModSharedTemplateJs;
use App\Http\Controllers\Controller;
use App\Models\ModSharedTemplateCss;
use App\Models\ModSharedTemplateSections;

class WebTemplatePreviewController extends Controller
{

    public function preview($shopId, $templateId)
    {
        // Lade das Template und seine zugehörigen Daten
        $templateData = ModSharedTemplates::find($templateId);

        if ($templateData) {
            $templateData->css = ModSharedTemplateCss::where('template_id', $templateId)->get();
            $templateData->js = ModSharedTemplateJs::where('template_id', $templateId)->get();
            $templateData->sections = ModSharedTemplateSections::where('template_id', $templateId)->get();

            // Zusammenführen der Inhalte der Sektionen und Anpassen der Pfade
            $templateContent = $this->mergeAndReplaceSections($shopId, $templateId, $templateData->sections);
            //$templateContent = $this->mergeAndReplaceSections
            //($shopId, $templateId, $templateData->sections);
            $shopData = $this->getShopData($shopId);
            $workTimes = $this->getWorkTimes($shopId);
            $productSales = $this->getProductSales($shopId);
            $votings = $this->getBestVotings($shopId);

        } else {
            return abort(404, 'Template nicht gefunden');
        }

        return view('backend.pages.seller.WebTemplates.template-preview', [
            'templateContent' => $templateContent,
            'templateData' => $templateData,
        ]);
    }


    protected function getShopData($shopId)     // Get shop data
    {
        $shopData = ModShop::find($shopId);
    // dd($shopData);
        return $shopData;
    }

    protected function getWorkTimes($shopId) // Get opening hours
    {
        $workTimes = ModSellerWorktimes::where('shop_id', $shopId)->get();
        // Get the opening hours of the shop and holliday's
        // opening hours
     //   $holiday = ModSellerHoliDay::where('shop_id', $shopId)->where('is_holiday', 1)->get();
     //  dd($workTimes, $holiday);
        return $workTimes;
    }


    protected function getProductSales($shopId) // Get product sales
    {
        // Hol die meistverkauften Produkte für den festen Shop
        $bestSellingProducts = ModProductSales::where('shop_id', $shopId)
                                ->orderBy('quantity', 'desc')
                                ->limit(10)
                                ->get();

//dd($bestSellingProducts);

        return $bestSellingProducts;
    }


    protected function getBestSellingProducts ($orderBy, $limit)
    {
        $bestSellingProducts = ModProductSales::where('shop_id', $shopId)
                                ->orderBy('quantity', 'desc')
                                ->limit($limit)
                                ->get();

        return $bestSellingProducts;
    }

    protected function getBestVotings($shopId)
    {
        $votings = ModSellerVotings::where('shop_id', $shopId)->get();
//dd($votings);
        return $votings;
    }


    protected function mergeAndReplaceSections($shopId, $templateId, $sections)
    {
        $content = '';

        foreach ($sections as $section) {
            $content .= $section->content;
        }

        $shopAssetPath = asset("storage/uploads/shops/{$shopId}/templates/template_{$templateId}/images");

        // Ersetze alle statischen Pfade durch den dynamischen Pfad
       // $content = str_replace("assets/images", $shopAssetPath, $content);
                // Ersetze alle statischen Pfade durch den dynamischen Pfad
                $content = str_replace("assets/images/shapes", $shopAssetPath, $content);
                $content = str_replace("assets/images/background", $shopAssetPath, $content);
                $content = str_replace("assets/images/about", $shopAssetPath, $content);
                $content = str_replace("assets/images/offer", $shopAssetPath, $content);
                $content = str_replace("assets/images/logos", $shopAssetPath, $content);
                $content = str_replace("assets/img/gallery", $shopAssetPath, $content);
                $content = str_replace("assets/img/gallery", $shopAssetPath, $content);
                $content = str_replace("assets/img/icons", $shopAssetPath, $content);
        return $content;
    }
}
