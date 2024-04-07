<?php

/**
 * Plugin Name: currency-converter
 * Description: Convert Cuurency.
 * Plugin URI: https://github.com/joudalatassi
 * Author: Joud
 * Version: 1.0
 * Author URI: https://github.com/joudalatassi
 */

 
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/api_handler.php';
require_once __DIR__ . '/admin.php';


add_filter( 'woocommerce_product_get_price', 'acc_convert_currency', 10, 2 );
function acc_convert_currency($price, $product){

    $options = get_option(ACC_OPTIONS,[]);
    if( ! isset($options['target_currency'])){
        return $price * 1;
    }
    
    
    $target_currency = $options['target_currency'];

    $all_currencies = acc_api_get_ratios();

    $target_currency_ratio = $all_currencies[$target_currency];

    return $price * $target_currency_ratio;
}


// add_filter('woocommerce_currency_symbol', 'acc_change_existing_currency_symbol', 10, 2);
// function acc_change_existing_currency_symbol( $currency_symbol, $currency ) {
//     return "EUR";
// }












 /*

         // Get the current temperature.
        echo "<pre style='direction:ltr'>";
        var_dump($data);
        echo "</pre>";
*/


