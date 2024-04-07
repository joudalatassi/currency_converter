<?php 

define("ACC_API_BASE", "your_api");// Put Your API Here
define("ACC_API_KEY", "your_key");// Put Your API Key Here
define("ACC_API_RATIOS_TRANSIENT_NAME", "your_rations");// Put Your API Ration Here


function acc_api_get_ratios(){

    $cache = get_transient(ACC_API_RATIOS_TRANSIENT_NAME);

    if($cache){
        return $cache;
    }


    $url = add_query_arg([
            'apikey' => ACC_API_KEY,
            'base_currency' => get_option('woocommerce_currency'),
        ]
    , ACC_API_BASE);


    $response = wp_remote_get($url);

    if(is_wp_error($response) || wp_remote_retrieve_response_code($response) !=200 ){
        error_log("ERROR: acc api ratios : " . print_r($response, true));
        return [];
    }


    $data = json_decode(wp_remote_retrieve_body($response), ARRAY_A)['data'];
    
    set_transient(ACC_API_RATIOS_TRANSIENT_NAME, $data, DAY_IN_SECONDS * 1 );

    return $data;
}



?>