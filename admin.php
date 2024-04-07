<?php 

define("ACC_OPTIONS", "acc_options");

// --------------------------------------------------------------------------------------
// Admin Menu & Settings CRUD
add_action('admin_menu','acc_admin_menu');
function acc_admin_menu(){
    add_menu_page('Currency Settings','Currency Settings','manage_options','acc','acc_view_admin_menu', 'dashicons-rest-api');
}

function acc_view_admin_menu(){

    // Get plugin options
    $options = get_option(ACC_OPTIONS,[]);

    if($_POST['submit'] ?? false){
        $options['target_currency'] =  $_POST['target_currency'];

        update_option(ACC_OPTIONS, $options);
    }


    // Get user selected currency 
    if( ! isset($options['target_currency'])){
        $selected = "default";
    }else{
        $selected = $options['target_currency'];
    }

    // Get all available currencies from API
    $all_currencies = acc_api_get_ratios();

    ?>
    <style>
        select {
            width: 100%;
        }
    </style>
    <h1>إعدادات تحويل العملة</h1>
    <form action="" method="POST">
        <select name="target_currency" id="">
            <option value="default">default</option>
            <?php foreach($all_currencies as $code => $ratio): ?>
                <option value="<?=$code?>" <?= selected($selected, $code)?>><?=$code?></option>
            <?php endforeach ?>
        </select>
        <?php submit_button()?>
    </form>

    <?php
}
