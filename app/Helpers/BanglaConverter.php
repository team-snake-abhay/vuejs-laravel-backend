<?php
    namespace App\Helpers;

    class BanglaConverter {
        public static $bn = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        public static $en = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

        public static function bn2en($number) {
            return str_replace(self::$bn, self::$en, $number);
        }

        public static function en2bn($number) {
            return str_replace(self::$en, self::$bn, $number);
        }
    }

// echo BanglaConverter::bn2en("This is ২০১৬\n");
// echo BanglaConverter::en2bn("42 আমার প্রিয় সংখ্যা\n");
