<?php

if(isset($_GET['store']) && !is_array($_GET['store']) &&
isset($_GET['key']) && !is_array($_GET['key'])){
    $store = $_GET['store'];
    $key = $_GET['key'];
    $url = 'https://openapi.etsy.com/v2/shops/'.$store.'/listings/active?api_key='.$key.'&sort_on=score&sort_order=down&limit=100';

    $json = file_get_contents($url);
    $json = json_decode($json);

    // creation_tsz
    // num_favorers
    // views
    // quantity

    foreach ($json->results as $product) {
        echo '<div>';
        echo '<div style="display: inline" id="id">';echo $product->listing_id;echo '</div>';
        echo '<div style="display: inline" id="fav">;';echo $product->num_favorers;;echo '</div>';
        echo '<div style="display: inline" id="views">;';echo $product->views;;echo '</div>';
        echo '<div style="display: inline" id="qte">;';echo $product->quantity;;echo '</div>';

        $now = new DateTime();
        $creation_date = new DateTime();
        $creation_date->setTimestamp($product->original_creation_tsz);
        $interval = date_diff($creation_date, $now);
        echo '<div style="display: inline" id="date">,';echo $interval->format('%R%a days|');echo '</div>';
        echo '</div>';
    }
}
else{
    echo 'wrong parameters';
}

?>