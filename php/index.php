<?php 

//include('includes/bootstrap_header.php');
include('includes/basic_html_header.php');
include('css/manna_network.css');
include('translations/en.php');
include("js/registration.js");
include("translations/en.js"); 

//verify that the lnk (i.e link) number above is yours to insure your lnk credit and payments
//change the configurations in the member_config.php page. All of the settings there can be gotten by logging into your advertiser dashboard (at your agent's site) and clicking the "Settings" button by the appropriate link/ad. 
include('member_config.php');
echo '<br>in php index.php $mn_local_lnk_num = ', $mn_local_lnk_num;
//now we will put in a new check to make sure they changed their link_num
if ($mn_local_lnk_num == "change_me" OR $mn_local_lnk_num == ""){
$url = $_SERVER['SERVER_NAME'];
$args = array(
'http_host' =>   $_SERVER['HTTP_HOST'],
'script-type' => "php"
);
$file="http://".$mn_agent_url."/".$mn_agent_folder.'/mannanetwork-dir/php_errors/no_link_id.php';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $file);
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);
echo($data);
exit();
}


if (!defined('REGISTRATION_CATEGORY_HEADING')) {
include('translations/en.php')  ;
}
require 'translations/en.js';

if(isset($plugin_is_registered) && $plugin_is_registered !== "yes"){

	if ( '' === $mn_local_lnk_num || '' === $mn_local_lnk_num ) {
	$file = 'https://' . $mn_agent_url . '/' . $mn_agent_folder . '/wp_errors/no_link_id.php';
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
				'http_host' => get_site_url(),
			),
			'cookies'     => array(),
		)
	);

	if ( is_wp_error( $response ) ) {
		$error_message = htmlspecialchars( $response->get_error_message() );
		echo 'Something went wrong: (' . htmlspecialchars( $error_message ) . ' )';
	} else {
		/** Dev Note: the following line generates a PHPCS error about escaping but doing so with kses created parsing problems
*/
		echo $response['body'];

	}
	exit();
}
else
{
 echo '<div style="display: inline">
    <div style="width:30%; display: inline-block; float:left; margin-left: 40px; margin-right: 10px;"><img src="'.get_site_url().'/wp-content/plugins/manna-network/images/dashboard.png" alt="Click the mannanetwork link in your admin dashboard to configure the plugin" width="500" height="600"></div>
    <div style="width: 50%; display: inline-block; border: 1px solid red"><h1 style="color:red;"> You need to configure the Manna Network plugin (see your dashboard)</h1></div>
</div>';
 exit();
}
}

//echo '</div>';//experiment - to close the <div class="entry-content"> in source code created by WP. There will be an extra close div tag as a result
echo '<div id="mn_main_container"><div id="mn_main_menu_container"><ul class="nav">';

include(dirname( __FILE__, 1 ).'/includes/_menu.php');
//include(dirname( __FILE__, 1 ).'/includes/_dropdownmenu.php');
	if ( isset( $_GET['register'] ) ) {
		include 'js/registration.js';
		include 'endorsements/register.php';
		exit();
	} elseif ( isset( $_GET['earn_income'] ) ) {
		include 'endorsements/earn_income.php';
		exit();
	} elseif ( isset( $_GET['about_bitcoin'] ) ) {
		include 'endorsements/about_bitcoin.php';
		exit();
	} elseif ( isset( $_GET['get_hosting'] ) ) { 
		include 'endorsements/get_hosting.php';
		exit();
	} elseif ( isset( $_GET['get_plugin'] ) ) {
		include 'endorsements/get_plugin.php';
		exit();
	} elseif ( isset( $_GET['get_php_code'] ) ) {
		include 'endorsements/get_php_code.php';
		exit();
	} elseif ( isset( $_GET['get_filters_info'] ) ) {
		include 'endorsements/get_filters_info.php';
		exit();
	}
	 elseif ( isset( $_GET['contact_us'] ) ) {
		include 'endorsements/contact_us.php';
		exit();
	}
	 elseif ( isset( $_GET['faq'] ) ) {
		include 'endorsements/faq.php';
		exit();
	}
	echo '</div>';
	
	if ( array_key_exists( 'gocat', $_GET ) && isset( $_GET['gocat'] ) ) {

				/** NOTE gocat comes in from gobutton. Those variables sent by GoButton are the only ones that GET ever provides*/
				$category_id = htmlspecialchars( $_GET['gocat'] ) ;
	} elseif ( array_key_exists( 'q', $_GET ) && isset( $_GET['q'] ) ) {
		// q comes in from AJAX javascript function !
		$category_id = htmlspecialchars( $_GET['q'] ) ;
	} elseif ( array_key_exists( 'category_id', $_GET ) && isset( $_GET['category_id'] ) )  {
		/** // NOTE THIS CATEGORY ID COMES IN FROM THE PAGINATOR MENU */
		$category_id = htmlspecialchars( $_GET['category_id'] ) ;
	} elseif ( array_key_exists( 'category_id', $_POST ) && isset( $_POST['category_id'] ) )  {
		/** // NOTE this comes in from MAIN MENU
It will NEVER have a regional number
*/
		$category_id = htmlspecialchars( $_POST['category_id'] ) ;
	}
	//Note: If it has a trgional_num it ALWAYS was sent by the Go Button. In othere words, the ONLY way the tregional_num variable will ever have a value is IF it comes in as GET. The other thing is that the GoButton is sending that value as a colon separated string. Either we need to change that at the Go Button function (and only send the location id) or we need to explode it here
	if ( array_key_exists( 'tregional_num', $_GET ) && isset( $_GET['tregional_num'] ) ) {
	$tregional_num = $_GET['tregional_num'];
	}
	if ( array_key_exists( 'currentPage', $_GET ) && isset( $_GET['currentPage'] ) ) {
				/** NOTE gocat comes in from gobutton */
		$currentPage = htmlspecialchars( $_GET['currentPage'] ) ;
	} 
	else
	{
	$currentPage = 1;
	}
	
	if ( array_key_exists( 'contact_us', $_GET ) && isset( $_GET['contact_us'] ) ) {
				/** NOTE gocat comes in from gobutton */
		$contact_us = htmlspecialchars( $_GET['contact_us'] ) ;
	} 
	

	/**     // both determiine what links are shown via category id var  */
	if ( isset( $category_id ) && '' !== $category_id ) {
		if ( isset( $_GET['main_cat_nonce'] )
		&& ! wp_verify_nonce( htmlspecialchars( $_GET['main_cat_nonce'] ) , 'main_cat_action' )
		) {
			print '201 Sorry, your nonce did not verify.';
			exit;
		} else {
			if ( isset( $_POST['main_cat_nonce'] ) ) {
				$main_cat_nonce = htmlspecialchars( $_POST['main_cat_nonce'] ) ;
			} elseif ( isset( $_GET['main_cat_nonce'] ) ) {
				$main_cat_nonce = htmlspecialchars( $_GET['main_cat_nonce'] ) ;
			}

			$bsv_pop_mouseover      = 'bsv_pop_mouseover';
			$bsv_pop_link_title     = 'bsv_pop_link_title';
			$bsv_pop_blockt_message = 'bsv_pop_blockt_message';

echo '<h3 style="text-align:center;">More Selections - Filter By Location</h3>
<table style="width:50%; margin-left: auto;
  margin-right: auto;">
<tr><td><div id="upper-left">';
include 'subcatsDropdown.php';
echo'</div></td>
<td><div id="go-button"><p id="goLink" class="goLink">&nbsp;</p><p id="clear_button" class="clear_button">&nbsp;</p></div></td>
<td><div id="upper-right">';
 include 'regionalDropdown.php';
 echo '</div></td>
</tr>
</tbody>
</table>
</div>
	<!--test code -->
	</div>';
  //We have a new function to get the lft rgt of the region at lftRgtRegion($regional_number)
  //We will use it to get the links for the selected category within the "id" array it returns 
  //Once we get the array of locations to select for, we'll query the links table for links in the cat and a location id IN the array. Then whatever number of links we get will be used to calculate number of pages
/*  if($tregional_num > 0){
  include ('numberofpagesregional.php'); //
  }
  else
  {
   include ('numberofpages.php'); //
  }
  */
  //renamed to number0fpagesregional to numofpagesallinone.php - returns a string - $number_of_pages.":".$lft.":".$rgt.":".$count_of_counter;
  include ('numofpagesallinone.php');
$pieces = explode(":", $number_of_pages);
$number_of_pages = $pieces[0];
$lft = $pieces[1];
$rgt= $pieces[2];
$number_of_links= $pieces[3];
//important note: If and/or when there are more than one page, the script generates the paginator menu providing links to the other pages. It is important to realize all those page links use java script, will retrieve the new list of links using the values above and will replace the currently displayed list with the new one using AJAX. In other words, the values above are only loaded at page load but are reused by the JS and paginator to generate more pages.
$display_block = "";
if($number_of_pages ==0){ //could also use $number_of_links=0
    if($tregional_num>0){ 
     $display_block .= NO_LINK_QUERY_RESULTS_REGIONAL;
    }
   else
   {
    $display_block .= NO_LINK_QUERY_RESULTS;
   }
}
else
{
	if ( $number_of_pages > 1) {
	 include('includes/paginator.php');
	}
	//importantnote: Since the javascript and paginator produce the "page_id", this included getLinksAllInOne.php page won't have one yet and is given a default page_id of 1. Subsequent "page loads" will always come from the link(s) in the paginator, will use the javascript function to retrieve the new list of links and will replace the current list here using AJAX. In other words, this included page is only used once at page load.
 include ('getLinksAllInOne.php'); 
}
if(isset($linksList_2)){
	$links_list_3 = json_decode( $linksList_2, true );
		foreach ( $links_list_3 as $key => $value ) {
		$display_block .= '<tr><td><a target="_blank" href="' . htmlspecialchars( $links_list_3[ $key ]['url'] ) . '">' . htmlspecialchars( $links_list_3[ $key ]['name'] ) . '	<br>' . htmlspecialchars( $links_list_3[ $key ]['description'] );
				if ( isset( $links_list_3[ $key ]['website_street'] ) ) {
					$display_block .= '<br>' . htmlspecialchars( $links_list_3[ $key ]['website_street'] );
					$display_block .= '<br>' . htmlspecialchars( $links_list_3[ $key ]['website_district'] );
				}
				$display_block .= '</a></td> </tr>';
				}
	}
echo '<div style="width:80%; margin-left: auto;
  margin-right: auto;"><table id="mn_results_table"><caption>Results Page</caption><tbody>';
echo $display_block;
echo '</table></div>';
			include 'js/mn_ajax.js';
		}
	} else 
	{
	/** // Display the opening, main category list  */
	
	echo '<div class="row" style="width: 60% ;  margin: auto ; border: 3px solid #4287f5; "><form name="main_category_form" method="post" > <input type="hidden" name="category_id" />';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'60\')">Accessories</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'1307\')">Games</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'65\')">Art/Photo/Music</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'1330\')">Health</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'69\')">Automotive</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'1375\')">Home</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'10023\')">Bitcoin</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'1401\')">Kids &amp; Teens</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'102\')">Books/Media</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'10037\')">Members</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'111\')">Business</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'1415\')">News</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'125\')">Careers</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'2822\')">Professional</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'126\')">Clothes/Apparel</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'3\')">Real Estate</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'134\')">Commerce</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'1275\')">Recreation</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'9\')">Computers/Internet</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'1438\')">Reference</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'10037\')">Deals</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'8\')">Religion</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'148\')">Education</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'10010\')">Sales_Reps</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'147\')">Electronics</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'2799\')">Services</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'2198\')">Environment</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'2027\')">Shopping</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'2702\')">Finance</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'2068\')">Society</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'10000\')">Food/Restaurants</a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'2098\')">Sports</a></div>';
		echo '<div class="column" style="background-color:#aaa;"><a href="javascript:select_main_category(\'&nbsp;\')"></a></div><div class="column" style="background-color:#bbb;"><a href="javascript:select_main_category(\'124\')">Travel</a></div>';
		echo '</form></div></div>';
		
		include 'js/mn_main_page.js';
	}
	include('includes/bootstrap_footer.php');

/*

$category_id = '';
$cat_page_num = '';
$link_page_num = '';
$pagem_url_cat = '';
$link_page_id = '';
$link_page_total = '';
$link_record_num = '';
$regional_num = '' ;
//These following links open the endorsement folder's pages in the endorsements directory. You can edit their wording as you wish.
echo '<a href="'.$_SERVER['PHP_SELF'].' ">Top Level</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?add_url=true&lnk_num='.$mn_lnk_num.'">Add URL</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?earn_income=true&lnk_num='.$mn_lnk_num.'">Earn Income</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="?about_bitcoin=true&lnk_num='.$mn_lnk_num.'">About Bitcoin</a>';

if(ISSET($_GET['add_url']) || ISSET($_POST['add_url'])){
include('endorsements/add_url.php');
exit();
}
elseif(ISSET($_GET['earn_income'])){
include('endorsements/earn_income.php');
exit();
}
elseif(ISSET($_GET['about_bitcoin'])){
include('endorsements/about_bitcoin.php');
exit();
}
//those first three called from main web directory page and the menu above
elseif(ISSET($_GET['get_hosting'])){
include('endorsements/get_hosting.php');
exit();
}
elseif(ISSET($_GET['get_plugin'])){
include('endorsements/get_plugin.php');
exit();
}
elseif(ISSET($_GET['get_php_code'])){
include('endorsements/get_php_code.php');
exit();
}
//print_r($_POST);

if( array_key_exists('gocat', $_GET) AND ISSET($_GET['gocat'])){
//NOTE category id comes in from main menu
$category_id = 1;
}

elseif( array_key_exists('q', $_GET) AND ISSET($_GET['q'])){
//NOTE category id comes in from main menu
$category_id = $_GET['q'];
}
elseif( array_key_exists('category_id', $_GET) AND ISSET($_GET['category_id'])){
//NOTE THIS CATEGORY ID COMES IN FROM THE PAGINATOR MENU
$category_id = $_GET['category_id'];
}
elseif(array_key_exists('category_id', $_POST) && ISSET($_POST['category_id'])){

//NOTE q comes in from dropdown 
$category_id = $_POST['category_id'];
}
//both determiine what links are shown via category id var

if(ISSET($category_id) && $category_id !="") {
if(array_key_exists('cat_page_num', $_POST) AND ISSET($_POST['cat_page_num'])){
$cat_page_num = $_POST['cat_page_num'];}
if(array_key_exists('link_page_num', $_POST) AND ISSET($_POST['link_page_num'])){
$link_page_num = $_POST['link_page_num'];}
if(array_key_exists('pagem_url_cat', $_POST) AND ISSET($_POST['pagem_url_cat'])){
$pagem_url_cat = $_POST['pagem_url_cat'];}
if(array_key_exists('link_page_id', $_POST) AND ISSET($_POST['link_page_id'])){
$link_page_id = $_POST['link_page_id'];}
if(array_key_exists('link_page_total', $_POST) AND ISSET($_POST['link_page_total'])){
$link_page_total = $_POST['link_page_total'];}
if(array_key_exists('link_record_num', $_POST) AND ISSET($_POST['link_record_num'])){
$link_record_num = $_POST['link_record_num'];}
if(array_key_exists('regional_num', $_POST) AND ISSET($_POST['regional_num'])){
$regional_num = $_POST['regional_num'] ;
}

$args = array(
'regional_num' => $regional_num,
'link_record_num' => $link_record_num,
'link_page_total' => $link_page_total, 
'link_page_id' => $link_page_id, 
'pagem_url_cat' => $pagem_url_cat,
'link_page_num' => $link_page_num, 
'cat_page_num' => $cat_page_num, 
'category_id' => $category_id, 
'lnk_num' => $mn_lnk_num,
'http_host' =>   $_SERVER['HTTP_HOST']
);


$handle = curl_init();
$url1 = "http://".$mn_agent_url."/".$mn_agent_folder."/mannanetwork-dir/get_category_json.php";
// Set the url
curl_setopt($handle, CURLOPT_URL, $url1);
curl_setopt($handle, CURLOPT_POSTFIELDS,$args);
// Set the result output to be a string.
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
 $jsoncatList = curl_exec($handle);
 curl_close($handle);

echo ' 
          <div class="table-responsive">
            <table class="table table-striped table-sm">
             <tbody>
<tr rowspan="2">
                  <td>
<h2>Select Category</h2>';

$categoryList = json_decode($jsoncatList, true);


$menu_str = '<form action="'. htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8").'"><select name="category_id" onchange="updatecategoryButton(this.value,\'0:0:0\'), showSubCat1(this.value)"><option value="">'.WORDING_AJAX_MENU1.'</option> ';

foreach($categoryList as $key=>$value){
 if($categoryList[$key]['lft']+1 < $categoryList[$key]['rgt']){
	$menu_str .= "<option value='y:" . $categoryList[$key]['id'] .":".$categoryList[$key]['name'] ."'>".$categoryList[$key]['name']."</option>";
	}
	else
	{
	$menu_str .= "<option value='n:" . $categoryList[$key]['id']  .":".$categoryList[$key]['name'] . "'>".$categoryList[$key]['name']."</option>";
	}
}
$menu_str .= '</select><br>
      <div id="txtHint1" name="txtHint1"><b>More Subcategories Available After Selection.</b></div>
		          <div id="txtHint2" name="txtHint2"><b></b></div>
		           <div id="txtHint3" name="txtHint3"><b></b></div>
		            <div id="txtHint4" name="txtHint4"><b></b></div>
<p id="goLink" name="goLink"><b></b></p>
<input type="reset" onclick="deleteAllLevels(2)" class="button standard" value="Clear"><div width: 250px;style="font-size: larger; font-weight:stronger;">Your Current Selection *: <input style="font-size: larger; font-weight:stronger;width: 250px;" type="text" id="category_name"  class="category_name" name="category_named" value="">
<input type="hidden" id="category_id" name="category_id" class ="category_id" value="" readonly>

</form>
</div>
<!--
</td>
</tr>
<tr>
<td width style=" vertical-align: text-top;">
	<div style="width: 500px;">
		<table width = "100%">
		<tr><td  id="summary_header" class="summary_header" name="summary_header">
		<div class="summary" id="summary" name="summary"></div>
<div class="accordian" id="accordian" name="accordian"></div>
		</td></tr>
	<!--	</table>
	</div>-->';
echo $menu_str;

if( array_key_exists('gocat', $_GET) AND ISSET($_GET['gocat'])){
//NOTE category id comes in from main menu
$category_id = $_GET['gocat'];
unset($_GET['gocat']);
unset($_POST['q']);
}

// NOW CHECK AND BUILD REGIONAL FILTER MENU
////????????????????????????????????????????????????????????????????????????????????????????????????????????????????????///////////////////////////
//note let's try to merge this args with the one above but this one we are trying using a single regional num instead of locus array?

$args2 = array(
'regional_num' => $regional_num,
'link_record_num' => $link_record_num,
'link_page_total' => $link_page_total, 
'link_page_id' => $link_page_id, 
'pagem_url_cat' => $pagem_url_cat,
'link_page_num' => $link_page_num, 
'cat_page_num' => $cat_page_num, 
'category_id' => $category_id, 
'lnk_num' => $mn_lnk_num,
'http_host' =>   $_SERVER['HTTP_HOST']
);
$handle = curl_init();
$url1 = "http://".$mn_agent_url."/".$mn_agent_folder."/mannanetwork-dir/get_regions_json.php";

// Set the url
curl_setopt($handle, CURLOPT_URL, $url1);
curl_setopt($handle, CURLOPT_POSTFIELDS,$args2); //use same args as other queries
// Set the result output to be a string.
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
 $jsonregionList = curl_exec($handle);
 curl_close($handle);

//echo '<h2>Select Regional Filters?</h2>';
echo '<BR><BR>'.WORDING_REGIONAL_FILTERS_LABEL;
$regionList = json_decode($jsonregionList, true);

$menu_str = '<form action="'. htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8").'"><select name="regional_num" onchange="updateregionalButton(this.value), showSubLoc1(this.value)"><option value="">'.WORDING_AJAX_REGIONAL_MENU1.'</option> ';

//foreach($regionList as $key=>$value){
// if($regionList[$key]['lft']+1 < $regionList[$key]['rgt']){
	$menu_str .= "
<option value='y:2566:Africa'>Africa</option>
<option value='y:2567:America - Central'>America - Central</option>
<option value='y:2568:America - North'>America - North</option>
<option value='y:2569:America - South'>America - South</option>
<option value='y:2572:Asia'>Asia</option>
<option value='y:2573:Australia/Oceania'>Australia\/Oceania</option>
<option value='y:2756:Caribbean'>Caribbean</option>
<option value='y:2575:Europe'>Europe</option>
<option value='y:2740:Middle East'>Middle East</option>";
//	}
//	else
//	{
//	$menu_str .= "<option value='n:" . $regionList[$key]['id']  .":".$regionList[$key]['name'] . "'>".$regionList[$key]['name']."</option>";
//	}
//}
$menu_str .= '</select><br>
      <div id="locHint1" name="locHint1"><b>Smaller Regions Available After Selection.</b></div>
		          <div id="locHint2" name="locHint2"><b></b></div>
		           <div id="locHint3" name="locHint3"><b></b></div>
		            <div id="locHint4" name="locHint4"><b></b></div>
<div id="locHint5" name="locHint5"><b></b></div>
<div id="locHint6" name="locHint6"><b></b></div>
<p id="filterLink" name="filterLink"><b></b></p>
<input type="reset" onclick="deleteAllLevels(2)" class="button standard" value="Clear"><div width: 250px;style="font-size: larger; font-weight:stronger;">Your Current Selection *: <input style="font-size: larger; font-weight:stronger;width: 250px;" type="text" id="regional_name"  class="regional_name" name="regional_named" value="">
<input type="hidden" id="regional_num" name="regional_num" class ="regional_num" value="" readonly>

</form>

</td><td>
';
echo $menu_str;

if( array_key_exists('regional_num', $_GET) AND ISSET($_GET['regional_num'])){
//NOTE category id comes in from main menu
$regional_num = $_GET['regional_num'];
unset($_GET['regional_num']);
unset($_POST['regional_num']);
}


//



// NOW USE THE ABOVE TWO CRITERIA CHECK, RETRIEVE AND DISPLAY LINKS



$args2 = array(
'regional_num' => $regional_num,
'link_record_num' => $link_record_num,
'link_page_total' => $link_page_total, 
'link_page_id' => $link_page_id, 
'pagem_url_cat' => $pagem_url_cat,
'link_page_num' => $link_page_num, 
'cat_page_num' => $cat_page_num, 
'category_id' => $category_id, 
'lnk_num' => $mn_lnk_num,
'http_host' =>   $_SERVER['HTTP_HOST']
);


$handle = curl_init();
$url2 = "http://".$mn_agent_url."/".$mn_agent_folder."/mannanetwork-dir/get_links_json.php";
//echo '<br>url2 line 288 index.php = ', $url2;
// Set the url
curl_setopt($handle, CURLOPT_URL, $url2);
curl_setopt($handle, CURLOPT_POSTFIELDS,$args2);
// Set the result output to be a string.
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
 $jsonlinksList = curl_exec($handle);
//echo $jsonlinksList;

$linksList2 = json_decode($jsonlinksList, true);
 curl_close($handle);

	if(sizeof($linksList2) > 20){
			//we need to run the paginator
		$number_of_pages =ceil(sizeof($linksList2)/20);

		echo '<div>';


	$menu = "";
	foreach (range(1, $number_of_pages) as $number) {	
		if($number == 1 ){
		$lower_limit = 1;
		$upper_limit = 19;
		}
		elseif($number > 1 AND $number != $number_of_pages)//do some math to fetch the limits)
		{
		$lower_limit = 20* ($number - 1);
		$upper_limit = (20* $number) -1;
		}
		else
		{
		$lower_limit = 20* ($number - 1);
		$number_of_links_on_last_page = sizeof($linksList2)% 20;
		$upper_limit = $lower_limit + $number_of_links_on_last_page ;
		}

	
	$newtable[$number] = $number."|";

		foreach (range($lower_limit, $upper_limit) as $key) {
	if($key < sizeof($linksList2) ){
	$newtable[$number] .=  '<tr><td><a target="_blank" href="http://';
	$newtable[$number] .=  $linksList2[$key]['url'];
	$newtable[$number] .=  '">';
	$newtable[$number] .=  $linksList2[$key]['name'];
	$newtable[$number] .=  '</a><br>';
	$newtable[$number] .=  $linksList2[$key]['description']; 

		if(isset( $linksList2[$key]['website_street'])){
		$newtable[$number] .=  '<br>'. $linksList2[$key]['website_street']; 
		$newtable[$number] .=  '<br>'. $linksList2[$key]['website_district']; 
		}
			$newtable[$number] .=  '</td> </tr>';
		}
	}
//dev note - debug can't get link list paginator to work right
	$menu .= "<a href=\"\" onclick=\"updatelinks('"; //this one loads second page but then nav bar doesn\'t do anything
//$menu .= "<a href=\"\" onclick=\"updatelinks('";//this one, the nav bar still "works" but loads main page instead of cat page
	//We need to build the pagination menu. We need to detect the current page id and modify the menu accordingly
	$encodednewtable = htmlentities($newtable[$number]);
	$menu .= $encodednewtable;
	$menu .= "|";
	$menu .= $number;
	//$menu .= "'); return false;\"> ";//this is supposedly old style and deprecate
$menu .= "'); event.preventDefault();\"> ";//this is suggested way to do the same thing (keep the browser from refreshing)
	$menu .= WORDING_LINKEXCHANGE_PAGE_NAME;
	$menu .= ' #' ;
	$menu .=  $number;
	$menu .=  "</a>&nbsp;|&nbsp;";
	}

	echo '<h4>', $menu;
	echo '</h4>';

	$newTable = '<div id="manna_link_container" class="manna_link_container" name="manna_link_container"><table><tbody>';
	if(array_key_exists('page_number', $_GET) AND ISSET($_GET['page_number'])){
		$current_page_number = $_GET['page_number'];
	$newTable .= $newtable[$current_page_number];
		}
		else
		{
		$current_page_number = 1;
	$pieces=explode("|", $newtable[$current_page_number]);
	$newTable .= $pieces[1];
		}





	$newTable .= "</tbody></table></div>";

	echo $newTable;

	}
else
{
	echo '<div id="manna_link_container"  class="manna_link_container" name="manna_link_container"><table> <tbody>';
	foreach($linksList2 as $key=>$value){

	echo '<tr><td><a target="_blank" href="http://'. $linksList2[$key]['url'].'">'.$linksList2[$key]['name'].'</a> 
	<br>'. $linksList2[$key]['description']; 
		if(isset( $linksList2[$key]['website_street'])){
		echo '<br>'. $linksList2[$key]['website_street']; 
		echo '<br>', $linksList2[$key]['website_district']; 
		}
	echo '</td> </tr>';
	}
}
echo '   </tbody>
    </table>
  </div>';

}
else
{
 
$display_main = '<div style="width: 700px ;
  margin-left: auto ;
  margin-right: auto ;font-weight: bold; font-size: large;"><form name="main_category_form" method="post" action="'. htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8").'"> <input type="hidden" name="category_id" />
<input type="hidden" name="B1" />';
$display_main .= "<table>";
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'60\')">Accessories</a></td><td style="min-width: 300px;">&nbsp;</td><td class="main_menu" ><a href="javascript:select_main_category(\'1307\')">Games</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'65\')">Art/Photo/Music</a></td><td style="min-width: 300px;">&nbsp;</td><td class="main_menu" ><a href="javascript:select_main_category(\'1330\')">Health</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'69\')">Automotive</a></td><td style="min-width: 300px;">&nbsp;</td><td class="main_menu" ><a href="javascript:select_main_category(\'1375\')">Home</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'10023\')">Bitcoin</a></td><td style="min-width: 300px;">&nbsp;</td><td class="main_menu" ><a href="javascript:select_main_category(\'1401\')">Kids &amp; Teens</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'102\')">Books/Media</a></td><td style="min-width: 300px;">&nbsp;</td><td class="main_menu" ><a href="javascript:select_main_category(\'1415\')">News</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'111\')">Business</a></td><td style="min-width: 300px;">&nbsp;</td><td class="main_menu" ><a href="javascript:select_main_category(\'2822\')">Professional</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'125\')">Careers</a></td><td style="min-width: 300px;">&nbsp;</td><td class="main_menu" ><a href="javascript:select_main_category(\'3\')">Real Estate</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'126\')">Clothes/Apparel</a></td><td style="min-width: 300px;">&nbsp;</td><td class="main_menu" ><a href="javascript:select_main_category(\'1275\')">Recreation</a></td></tr>';

$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'134\')">Commerce</a></td><td style="min-width: 300px;">&nbsp;</td><td class="main_menu" ><a href="javascript:select_main_category(\'1438\')">Reference</td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'9\')">Computers/Internet</a></td><td style="min-width: 300px;">&nbsp;</td><td class="main_menu" ><a href="javascript:select_main_category(\'8\')">Religion</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'148\')">Education</a></td><td style="min-width: 300px;">&nbsp;</td><td class="main_menu" ><a href="javascript:select_main_category(\'10010\')">Sales_Reps</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'147\')">Electronics</a></td><td style="min-width: 300px;">&nbsp;</td><td class="main_menu" ><a href="javascript:select_main_category(\'2799\')">Services</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'2198\')">Environment</a></td><td style="min-width: 300px;">&nbsp;</td><td class="main_menu" ><a href="javascript:select_main_category(\'2027\')">Shopping</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'2702\')">Finance</a></td><td style="min-width: 300px;">&nbsp;</td><td class="main_menu" ><a href="javascript:select_main_category(\'2068\')">Society</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'10000\')">Food/Restaurants</a></td><td style="min-width: 300px;">&nbsp;</td><td class="main_menu" ><a href="javascript:select_main_category(\'2098\')">Sports</a></td></tr>';
$display_main .= '<tr><td class="main_menu" ><a href="javascript:select_main_category(\'&nbsp;\')"></a></td><td style="min-width: 300px;">&nbsp;</td><td class="main_menu" ><a href="javascript:select_main_category(\'124\')">Travel</a></td></tr>';
$display_main .= "</table></form></div>";

echo $display_main;


}
include('includes/bootstrap_footer.php');
//echo '</body></html>';
*/
?>

