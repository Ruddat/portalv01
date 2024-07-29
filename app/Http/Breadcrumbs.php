<?php

namespace App\Http;

class Breadcrumbs
{
    public static function generate($items)
    {
        $breadcrumbs = '<nav aria-label="breadcrumb">';
        $breadcrumbs .= '<ol class="breadcrumb">';

        foreach ($items as $item) {
            if (isset($item['url'])) {
                $breadcrumbs .= '<li class="breadcrumb-item"><a href="' . $item['url'] . '">' . $item['label'] . '</a></li>';
            } else {
                $breadcrumbs .= '<li class="breadcrumb-item active" aria-current="page">' . $item['label'] . '</li>';
            }
        }

        $breadcrumbs .= '</ol>';
        $breadcrumbs .= '</nav>';

        return $breadcrumbs;
    }
}
