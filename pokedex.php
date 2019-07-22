<?php 
require_once('lib.php');

//======= init ==============//
$q = "piKachU";
$q_url = changeStrFormat($q);
$output = "";

//======= process ==========//
$res_poke = callApi("https://pokeapi.co/api/v2/pokemon/". $q_url ."/");
if ($res_poke!=NULL){
    $output = processOut($res_poke, "pokemon");
} else {
    $res_item = callApi("https://pokeapi.co/api/v2/item/". $q_url ."/");
    if($res_item!=NULL){
        $output = processOut($res_item, "item");
    } else {
        $output = "Pokemon or Item not found.";
    }
}

//========= PRint Output ==========//
echo $output;

?>