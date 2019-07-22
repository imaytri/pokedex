<?php

//======== Function ==============//
function callApi($url){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($curl);
    curl_close($curl);
    $res_arr = json_decode($res);
    return $res_arr;
}

function changeStrFormat($str, $reverse=false){
    return $reverse ? ucwords(str_replace("-", " ", $str)) : str_replace(" ", "-", strtolower(trim($str)));
}

function processOut($obj, $type){
    switch ($type) :
        case "pokemon" :
            $output = "\n# " . $obj->id . " - " . changeStrFormat($obj->name, true) . "\n" . "Type : ";

            foreach($obj->types as $i => $type){
                $output .= changeStrFormat($type->type->name, true);
                if($i< count($obj->types)-1){
                    $output .= " - ";
                }else{
                    $output .= "\n\nAbilities:\n";
                }
            }
            
            foreach($obj->abilities as $i => $ability){
                $output .= $i+1 . ". " . changeStrFormat($ability->ability->name, true) . "\n";
                $res_ab = callApi($ability->ability->url);
                foreach($res_ab->effect_entries as $effect){
                    $output .= $effect->effect . "\n";
                }
                $output .= "\n";
            }
            break;
        case "item" :
            $output = "\nItem : " . changeStrFormat($obj->name, true) . "\nCost : " . $obj->cost . "\nEntries : ";
            foreach($obj->effect_entries as $effect){
                $output .= $effect->effect . " ";
            }
            break;
        default :
            $output = false;
    endswitch;
    return $output;
}

?>