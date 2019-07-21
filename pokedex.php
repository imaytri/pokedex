<?php 
//======= init ==============//
$q = "Tapu Koko";
$q_url = str_replace(" ", "-", strtolower(trim($q)));
$output = "";

//======= call api ==========//
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://pokeapi.co/api/v2/pokemon/". $q_url ."/");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$res = curl_exec($curl);
curl_close($curl);

//========== PRocessing ===========//
$res_arr = json_decode($res);
$output = "# " . $res_arr->id . " - " . $q . "\n" . "Type : ";

foreach($res_arr->types as $i => $type){
    $output .= $type->type->name;
    if($i< count($res_arr->types)-1){
        $output .= " - ";
    }else{
        $output .= "\n\nAbilities:\n";
    }
}


//========= PRint Output ==========//
echo $output;
// echo $res;