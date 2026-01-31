<?php

if (!function_exists('numberToWords')) {
    /**
     * Convert a number to its word representation in English
     *
     * @param int|float $num The number to convert
     * @return string The number in words
     */
    function numberToWords($num)
    {
        $ones = array(
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen',
        );

        $tens = array(
            0 => '',
            1 => 'Ten',
            2 => 'Twenty',
            3 => 'Thirty',
            4 => 'Forty',
            5 => 'Fifty',
            6 => 'Sixty',
            7 => 'Seventy',
            8 => 'Eighty',
            9 => 'Ninety',
        );

        $scales = array(
            100 => 'Hundred',
            1000 => 'Thousand',
            1000000 => 'Million',
            1000000000 => 'Billion',
            1000000000000 => 'Trillion',
        );

        // Handle decimal numbers
        if (is_float($num)) {
            $parts = explode('.', (string)$num);
            $integer = (int)$parts[0];
            $decimal = isset($parts[1]) ? (int)substr($parts[1], 0, 2) : 0;

            $intWords = convertIntegerToWords($integer, $ones, $tens, $scales);
            $decimalWords = convertIntegerToWords($decimal, $ones, $tens, $scales);

            return $intWords . ' Rupees and ' . $decimalWords . ' Paise';
        } else {
            return convertIntegerToWords((int)$num, $ones, $tens, $scales) . ' Rupees';
        }
    }

    function convertIntegerToWords($num, $ones, $tens, $scales)
    {
        if ($num == 0) {
            return 'Zero';
        }

        $words = array();

        $scale_names = array('Trillion', 'Billion', 'Million', 'Thousand', 'Hundred');
        $scale_values = array(1000000000000, 1000000000, 1000000, 1000, 100);

        for ($i = 0; $i < count($scale_values); $i++) {
            $scale = $scale_values[$i];
            if ($num >= $scale) {
                $quotient = intdiv($num, $scale);
                $remainder = $num % $scale;

                if ($scale >= 1000) {
                    $words[] = convertIntegerToWords($quotient, $ones, $tens, $scales) . ' ' . $scale_names[$i];
                } else {
                    // For hundreds
                    $words[] = $ones[$quotient] . ' ' . $scale_names[$i];
                }

                $num = $remainder;

                if ($num == 0) {
                    break;
                }
            }
        }

        if ($num > 0) {
            if ($num < 20) {
                $words[] = $ones[$num];
            } else {
                $tens_digit = intdiv($num, 10);
                $ones_digit = $num % 10;

                if ($ones_digit == 0) {
                    $words[] = $tens[$tens_digit];
                } else {
                    $words[] = $tens[$tens_digit] . ' ' . $ones[$ones_digit];
                }
            }
        }

        return implode(' ', $words);
    }
}
