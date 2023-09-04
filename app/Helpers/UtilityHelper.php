<?php

namespace App\Helpers;


class UtilityHelper
{
    public static function toMinutesFromHour(?float $value = null): ?float {
        return ($value) ? round($value * 60) : $value;
    }

    public static function toHourFromMinutes(?float $value = null): ?float {
        return ($value) ? ($value / 60) : $value;
    }
    
    public static function convertHTMLToText(string $html): string
    {
        $text = preg_replace("/\n\s+/", "\n", rtrim(html_entity_decode(strip_tags($html))));
        return $text;
    }

    /**
     * Generate initials from a name
     *
     * @source https://chrisblackwell.me/generate-perfect-initials-using-php/ Generate Initials using PHP
     */
    public static function generateInitials(?string $name = null): string {
        if(is_null($name)) return '';

        $words = explode(' ', $name);
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
        }
        return self::makeInitialsFromSingleWord($name);
    }

    /**
     * Make initials from a word with no spaces
     *
     * @source https://chrisblackwell.me/generate-perfect-initials-using-php/ Generate Initials using PHP
     */
    public static function makeInitialsFromSingleWord(?string $name = null): string {
        if(is_null($name)) return '';

        preg_match_all('#([A-Z]+)#', $name, $capitals);
        if (count($capitals[1]) >= 2) {
            return substr(implode('', $capitals[1]), 0, 2);
        }
        return strtoupper(substr($name, 0, 2));
    }

    public static function generateSingleInitialLetter(?string $name = null): string {
        if(is_null($name)) return '';
        return strtoupper($name[0]);
    }


    public static function formatNumber($number) {
        return number_format((float) $number, 2, '.', ',');
    } 


    public static function formatAmount($amount)
    {
        function naira_format($number, $decimals = 2, $decimalPoint = '.', $thousandsSeparator = ',')
        {
            return '₦'. number_format($number, $decimals, $decimalPoint, $thousandsSeparator);
        }

        $formattedAmount = naira_format($amount);
        return $formattedAmount;
    }


    public static function generateTransactionReference()
    {
        $length = 15;
        $characters = '984765432100123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLenth = strlen($characters);
        $generatedTransactionReference = '';
        for ($i = 0; $i < $length; $i++) {
            $generatedTransactionReference .= $characters[rand(0, $charactersLenth - 1)];
        }
        return $generatedTransactionReference . time(). "-IBEDC";
    }


   
}