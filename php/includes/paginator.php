<?php
	$number_of_rows = ceil($number_of_pages/$mn_pgn8tr_menu_items);
	
		echo '<div id="mn_paginator_menu_container">';
		echo '<table class="mn_paginator_menu_table"><tr><th colspan="'.$number_of_pages.'">Select More Results Pages</th></tr>';
		for($a=1; $a <= $number_of_rows; $a++){
		echo '<tr style="background: #1ab7ea; ">';
		if($number_of_pages < $mn_pgn8tr_menu_items){
		//if there are less than the selected $mn_pgn8tr_menu_items (configured at plugin install in dashboard) then only loop through for the number of pages (and not the setting)
		$mn_pgn8tr_menu_items = $number_of_pages;
		}
		for($b=1; $b <= $mn_pgn8tr_menu_items; $b++){
		if($a > 1){
		$page_number = (($a -1)* 10)+$b;
		}
		else
		{
		$page_number = $b;
		}
		if ( 1 === $b ) {
		$page_num       = 1;
		
		$newnumber_of_pages = $number_of_pages;//renaming whiletrying to fix JS
	  echo "<td><a class=\"mn_btn\" href=\"\" onclick=\"getLinksAllInOne('" . htmlspecialchars( $page_number ) . "', '" . htmlspecialchars( $category_id ) . "', '" . htmlspecialchars( $tregional_num ) . "', " . $newnumber_of_pages . ", '" . htmlspecialchars( $number_of_links ) . "', '" . htmlspecialchars( $lft ) . "', '" . htmlspecialchars( $rgt ) . "', '" .  htmlspecialchars( $mn_agent_url ) . "', '" . htmlspecialchars( $mn_agent_folder ) . "'); return false; \">" . htmlspecialchars( $page_number ) . '</a></td>';					
		} elseif ( $b > 1 && $page_number <= $number_of_pages ) {
		$lower_limit       = 20 * ( $b - 1 );
		$upper_limit       = ( 20 * $b ) - 1;
		$page_num = $b;
					
	echo "<td><a class=\"mn_btn\" href=\"\" onclick=\"getLinksAllInOne('" . htmlspecialchars( $page_number ) . "', '" . htmlspecialchars( $category_id ) . "',  '" . htmlspecialchars( $tregional_num ) . "', ". $newnumber_of_pages . ", '" . htmlspecialchars( $number_of_links ) . "', '" . htmlspecialchars( $lft ) . "', '" . htmlspecialchars( $rgt ) . "', '" .  htmlspecialchars( $mn_agent_url ) . "', '" . htmlspecialchars( $mn_agent_folder ) . "'); return false; \">" . htmlspecialchars( $page_number ) . '</a></td>';			
			} 
			else {
			//fill remainder of menu row with empty <td>s
			echo '<td>&nbsp; </td>';
			}
		}
	echo '</tr>';	}//close row counter for loop
	echo '</table></div>';
	?>
