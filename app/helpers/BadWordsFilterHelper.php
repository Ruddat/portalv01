<?php

namespace app\Helpers;

use App\Models\Badword;
use App\Models\ModAdminBadword;

class BadWordsFilterHelper
{
    public static function filterComment($content)
    {
        $badwords = ModAdminBadword::all();
        $containsBadwords = false;

        foreach ($badwords as $badword) {
            if (stripos($content, $badword->word) !== false) {
                $containsBadwords = true;
                $content = str_ireplace($badword->word, '****', $content);
                // Increment the count for the badword
                $badword->increment('count');
            }
        }

        return [
            'filteredContent' => $content,
            'containsBadwords' => $containsBadwords
        ];
    }
}
