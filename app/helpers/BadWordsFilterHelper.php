<?php

namespace app\Helpers;

use App\Models\Badword;
use App\Models\ModAdminBadword;

class BadWordsFilterHelper
{
    public static function filterComment($content)
    {
        $badwords = ModAdminBadword::pluck('word')->toArray();
        $containsBadwords = false;

        foreach ($badwords as $badword) {
            if (stripos($content, $badword) !== false) {
                $containsBadwords = true;
                $content = str_ireplace($badword, '****', $content);
            }
        }

        return [
            'filteredContent' => $content,
            'containsBadwords' => $containsBadwords
        ];
    }
}
