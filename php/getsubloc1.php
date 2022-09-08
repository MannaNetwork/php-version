<?php

$regional_num = '';

if ( isset( $_GET['tregional_num'] ) ) {
	$regional_num = htmlspecialchars( $_GET['tregional_num'] ) ;}
else
{$regional_num = 0;
}
if ( isset( $_GET['agent_url'] ) ) {
	$mn_agent_url = htmlspecialchars( $_GET['agent_url'] ) ;}
else
{$mn_agent_url = "";
}
if ( isset( $_GET['agent_folder'] ) ) {
	$mn_agent_folder = htmlspecialchars( $_GET['agent_folder'] ) ;}
else
{$mn_agent_folder = "";
}
if ( isset( $_GET['q'] ) && is_numeric( $_GET['q'] ) ) {
$selected_cat_id = htmlspecialchars( $_GET['q'] ) ; 
}
else
{
$selected_cat_id = 0;
}
//remove https:// and/or http:// from the value to be searched for (because the url stored in MN db doesn't store either)
 if ( strpos( $_SERVER['HTTP_HOST'], 'https://' ) !== false ) {
	$http_host = str_replace( 'https://', '', $_SERVER['HTTP_HOST'] );
} elseif ( strpos( $_SERVER['HTTP_HOST'], 'http://' ) !== false ) {
	$http_host = str_replace( 'http://', '', $_SERVER['HTTP_HOST'] );
} 
if ( isset( $_GET['type'] ) ) {
	$type = htmlspecialchars( $_GET['type'] ) ;}
if($type=="regions"){
$file     = 'https://' . $mn_agent_url . '/' . $mn_agent_folder . '/mannanetwork-dir/get_regions_json.php';
}
else
{
$file     = 'https://' . $mn_agent_url . '/' . $mn_agent_folder . '/mannanetwork-dir/get_category_json.php';
}
	$post = [
	'tregional_num'    => $regional_num,
    'selected_cat_id' => $selected_cat_id,
    'type' => 'categories',
    ];
   $ch = curl_init($file);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);
if(!$response){

echo '<br>Curl error in subcatsDropdown.php';
}
else
{
//$category_list = json_decode( $response, true );
require_once 'translations/en.php';
echo $response;
}
?>
