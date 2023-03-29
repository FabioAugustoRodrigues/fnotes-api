<?php

namespace App\Utils;

class SlugUtil
{
    public static function generateSlug($text) {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        $text = trim($text, '-');
        $suffix = substr(md5(uniqid()), 0, 6);
        
        return "{$text}-{$suffix}";
      }
}
