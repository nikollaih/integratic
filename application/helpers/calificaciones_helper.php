<?php
if(!function_exists('get_percent_value_qualification')) {
    function get_percent_value_qualification($qualification, $max_qualification, $percent){
        // Convert the percentage to a decimal (for example, 30% becomes 0.3)
        $percent_decimal = $percent / 100;

        // Calculate the equivalent score as a proportion of the max qualification
        return ($qualification / $max_qualification) * $percent_decimal * $max_qualification;
    }
}