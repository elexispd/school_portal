<?php

// app/Helpers/helpers.php

if (! function_exists('getOrdinal')) {
    /**
     * Convert a number into its ordinal form (1st, 2nd, 3rd, etc.)
     *
     * @param  int  $number
     * @return string
     */
    function getOrdinal($number)
    {
        if (in_array(($number % 100), [11, 12, 13])) {
            $suffix = 'th';
        } else {
            switch ($number % 10) {
                case 1:  $suffix = 'st'; break;
                case 2:  $suffix = 'nd'; break;
                case 3:  $suffix = 'rd'; break;
                default: $suffix = 'th'; break;
            }
        }
        return $number . $suffix;
    }
}
