<?php

//Variables coming in from paginator come as $_GET, otherwise, the variables are already parsed by mannanetwork-main.php before this page is included. The paginator sends the variables to mn_ajax.js where the getLinksAllInOne function uses AJAX to call this page and (again) sends the vars here via $_GET (it might be better to convert the function to sending as $_POST). If/when it is the paginator calling this page then the function accesses this local page (to skirt any javascript settings that might curb access to remote servers) which uses PHP Curl (sic wp_remote_post) (below) to retrieve the next page of ads (as a JSON string convertable to an array). The function then replaces the ad display section with the new list of ads

if(isset($category_id)){
//means all the vars should be correctly set already by the plugin's  mannanetwork-main.php page (even if zero) and we do nothing EXCEPT we need to set the $page_num
$page_num = 1;
}
else
{
//means all the $_GET variables should be correctly set (even if zero) and need to be assigned
$page_num=$_GET['page_num']; 
$category_id=$_GET['category_id'];
$number_of_pages=$_GET['newnum_of_pages']; 
$number_of_links=$_GET['number_of_links']; 
$lft=$_GET['lft']; 
$rgt=$_GET['rgt'];
$mn_agent_url=$_GET['mn_agent_url'];
$mn_agent_folder=$_GET['mn_agent_folder'];
}
unset($linksList_2);
unset($response);
unset($file);

if(!isset($tregional_num)){
$tregional_num = 0;
}
$file = "https://".$mn_agent_url."/".$mn_agent_folder."/mannanetwork-dir/getLinksAllInOne.php";
/*if(function_exists('wp_remote_post')){
$file = "https://".$mn_agent_url."/".$mn_agent_folder."/mannanetwork-dir/getLinksAllInOne.php";
 $response = wp_remote_post(
        $file,
        array(
            'method'      => 'POST',
            'timeout'     => 45,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking'    => true,
            'headers'     => array(),
            'body'        => array(
                'page_num' => $page_num,
                'category_id'     => $category_id,
                'tregional_num' => $tregional_num, 
                'number_of_pages' => $number_of_pages,
                'number_of_links' => $number_of_links,
                'lft' => $lft,
                'rgt' => $rgt,
            ),
            'cookies'     => array(),
        )
    );

    if (is_wp_error($response) ) {
        $error_message =  $response->get_error_message();
        echo 'Something went wrong: (' .  $error_message . ')';
    } else { */
    
    
		$post = [
    		'page_num' => $page_num,
                'category_id'     => $category_id,
                'tregional_num' => $tregional_num, 
                'number_of_pages' => $number_of_pages,
                'number_of_links' => $number_of_links,
                'lft' => $lft,
                'rgt' => $rgt,
    ];
    $ch = curl_init($file);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);
if(!$response){

echo '<br>Curl error in getLinksAllInOne.php';
}
else
{
       if(isset($_GET['category_id'])){
        echo $response; 
        }
        else
        {
        $linksList_2 =  $response; 
        //echo $response; 
        } 
}  
?>
