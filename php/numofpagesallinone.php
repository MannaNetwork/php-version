<?php

$file = "https://".$mn_agent_url."/".$mn_agent_folder."/mannanetwork-dir/getNumberOfPagesAllInOne.php";
/*
'category_id'     => $category_id,
				'tregional_num'     => $tregional_num,
*/
		$post = [
    'category_id' => $category_id,
    'tregional_num'     => $tregional_num,
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
	$number_of_pages = $response;//response is already json encoded at enterprise site - just pass it on encoded and decode when used
	//echo $response['body'];
	}
?>
