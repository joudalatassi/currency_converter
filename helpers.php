<?php 

// --------------------------------------------------------------------------------------
// Debugging

// Dump Data
if(! function_exists('dd')){
    function dd($var, $display=false, $msg = ''){
        $display_class = ($display)? 'style="display:block;"' : '';
        echo "<pre $display_class class='dd'>$msg ";var_dump($var);echo'</pre>';
    }
}
// Dump Data & Die
if(! function_exists('ddd')){
    function ddd($var, $display=false, $msg = ''){
        dd($var, $display, $msg);
        die;   
    }
}
// Dump Data to debug.log
if(! function_exists('ldd')){
    function ldd($var,$msg = ''){
        error_log($msg . print_r($var,1));
    }
}

// Get Backtrace function call
if(! function_exists('get_backtrace')){
    function get_backtrace(): string{
        $e = new \Exception;
        return $e->getTraceAsString();
    }
}