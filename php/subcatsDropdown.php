<?php
 //if ( isset( $_GET['q'] ) && is_numeric( $_GET['q'] ) ) {	$category_id = htmlspecialchars( $_GET['q'] ) ; }
	
$file = 'https://' . $mn_agent_url . '/' . $mn_agent_folder . '/mannanetwork-dir/get_category_json.php';
	$post = [
    'selected_cat_id' => $category_id,
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
$category_list = json_decode( $response, true );
echo '
<script>
var original_cat_id = "'.htmlspecialchars( $category_id ) . '"
</script>';
		echo '<div id="mn_subcat_container"> 
<form> <table id="mn_submenu_results_table">
<tr><td>
<select name="category_menu" onchange="updategoButton(this.value,\'false\',\'' . htmlspecialchars( $category_id ) . '\'), showSubLoc1(this.value,1,\'' . htmlspecialchars( $category_id ) . '\',\'categories\',\''.htmlspecialchars( $mn_agent_url ) .'\',\''.htmlspecialchars( $mn_agent_folder ) . '\' )"><option value="">' . htmlspecialchars( WORDING_AJAX_MENU1 ) . '</option> ';
		echo "<option label='str' value='y:" . htmlspecialchars( $category_id ) . ":'></option>";
		foreach ( $category_list as $key => $value ) {
		$category_list[ $key ]['name'] = trim($category_list[ $key ]['name']);
			if ( $category_list[ $key ]['lft'] + 1 < $category_list[ $key ]['rgt'] ) {
				echo "<option value='y:" . htmlspecialchars( $category_list[ $key ]['id'] ) . ':' . htmlspecialchars( $category_list[ $key ]['name'] ) . "'>" . htmlspecialchars( $category_list[ $key ]['name'] ) . '</option>';
			} else {
				echo "<option value='n:" . htmlspecialchars( $category_list[ $key ]['id'] ) . ':' . htmlspecialchars( $category_list[ $key ]['name'] ) . "'>" . htmlspecialchars( $category_list[ $key ]['name'] ) . '</option>';
			}
		}
		echo '</select>
		      <div class="catHint1" id="catHint1" ><b>' . htmlspecialchars( WORDING_AJAX_1 ) . '</b></div><input type="hidden" id="selected_cat_name" name="selected_cat_name" class ="selected_cat_name" value="">
<input type="hidden" id="selected_cat_id" name="selected_cat_id" class ="selected_cat_id" value=""><!--</div>--></td></tr></table></form></div>	';
	}

