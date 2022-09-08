
<script>
/* The main (perhaps ONLY?) difference between this javascipt and similarly name mn_ajax.js file is that this one omits the calls to the updateGoButton And deleted the function itself*/
function paginatorMenu(catid, pageid,mn_agent_url,mn_agent_folder,tregional_num,numberOfPages)
{

     /*FIRST, build a replacement for the paginator menu */
   if(numberOfPages > 5){
  /*add the previous page arrows and button to end of pages */ 
  var output = '<caption>Select More Results Pages</caption><tr>';
for ( j = 0; j < numberOfPages; j++) {
if ( j === 1 ) {
	var lower_limit = 0;
	var upper_limit = 19;
	var link_page_num       = 1;
	output += "<td style=\"text-align:center;\"><a class=\"mn_btn\" href=\"\" onclick=\" paginatorMenu('" +catid+ "','" +pageid+ "','" +mn_agent_url+ "','" +mn_agent_folder+ "','" +tregional_num+ "','" +numberOfPages+ "'); return false;\">Temp Constant"+pageid+'</a>';
} else if ( j > 1 && j !== $number_of_pages ) {
	var lower_limit       = 20 * ( j - 1 );
	var upper_limit       = ( 20 * j ) - 1;
	var link_page_num = j;
	output += "<td style=\"text-align:center;\"><a class=\"mn_btn\" href=\"\" onclick=\" paginatorMenu('" +catid+ "','" +pageid+ "','" +mn_agent_url+ "','" +mn_agent_folder+ "','" +tregional_num+ "','" +numberOfPages+ "'); return false;\">Temp Constant"+pageid+'</a>';
} else {
	var lower_limit                  = 20 * ( j - 1 );
	var number_of_links_on_last_page = count( $url_array ) % 20;
	var upper_limit                  = $lower_limit + $number_of_links_on_last_page;
	var link_page_num            = j;
	output += "<td style=\"text-align:center;\"><a class=\"mn_btn\" href=\"\" onclick=\" paginatorMenu('" +catid+ "','" +pageid+ "','" +mn_agent_url+ "','" +mn_agent_folder+ "','" +tregional_num+ "','" +numberOfPages+ "'); return false;\">Temp Constant"+pageid+'</a>';
	}
     }
output += "</td></tr></table></div>";
 
   } else {
 /* Only tag the currently selected page with different color if not > 5 */  
  var output = '<caption>Select More Results Pages</caption><tr>';
for ( j = 0; j < numberOfPages; j++) {
if ( j === 1 ) {
	var lower_limit = 0;
	var upper_limit = 19;
	var link_page_num       = 1;
	output += "<td style=\"text-align:center;\"><a class=\"mn_btn\" href=\"\" onclick=\" paginatorMenu('" +catid+ "','" +pageid+ "','" +mn_agent_url+ "','" +mn_agent_folder+ "','" +tregional_num+ "','" +numberOfPages+ "'); return false;\">Temp Constant"+pageid+'</a>';
} else if ( j > 1 && j !== $number_of_pages ) {
	var lower_limit       = 20 * ( j - 1 );
	var upper_limit       = ( 20 * j ) - 1;
	var link_page_num = j;
	output += "<td style=\"text-align:center;\"><a class=\"mn_btn\" href=\"\" onclick=\" paginatorMenu('" +catid+ "','" +pageid+ "','" +mn_agent_url+ "','" +mn_agent_folder+ "','" +tregional_num+ "','" +numberOfPages+ "'); return false;\">Temp Constant"+pageid+'</a>';
} else {
	var lower_limit                  = 20 * ( j - 1 );
	var number_of_links_on_last_page = count( $url_array ) % 20;
	var upper_limit                  = $lower_limit + $number_of_links_on_last_page;
	var link_page_num            = j;
	output += "<td style=\"text-align:center;\"><a class=\"mn_btn\" href=\"\" onclick=\" paginatorMenu('" +catid+ "','" +pageid+ "','" +mn_agent_url+ "','" +mn_agent_folder+ "','" +tregional_num+ "','" +numberOfPages+ "'); return false;\">Temp Constant"+pageid+'</a>';
	}
     }
 output += "</td></tr></table></div>";
}
  document.getElementById("mn_paginator_menu_table").innerHTML=output;
}

function showSubMenu(str, currentLevel,cat_id,type,agent_url,agent_folder) 
{
/*
Process description:
1) Query remote server, receive JSON string of next menu items
2) Create the next html menu from the data - store as variable "output"
3) Add the next holder for the next menu to ouput var - name it with # currentlevel + 1
4) Replace the div created by previous menu with the new code (note the name of the replaced div will be the same as the current level number)
*/
var myarr = str.split(":");
var nextLevel= parseFloat(currentLevel) + 1;
if(type=="regions"){
var currentBlockNameStr= 'locHint'+(parseFloat(currentLevel));
var nextBlockNameStr= 'locHint'+(parseFloat(currentLevel) + 1);
}
else
{
var currentBlockNameStr= 'catHint'+(parseFloat(currentLevel));
var nextBlockNameStr= 'catHint'+(parseFloat(currentLevel) + 1);
}

  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
var data = this.responseText;
var combo_list = JSON.parse(data);

if(typeof(combo_list)!=='string'){
var output = '<select name="';
	if(type=="regions"){
	output += 'selected_region_id" onchange="showSubMenu(this.value,'+nextLevel+','+cat_id+',\''+type+'\',\''+agent_url+'\',\''+agent_folder+'\')">';
	output += '<option value="">' + wording_ajax_regional_menu1 + '</option>';
	}
	else
	{
	output += 'selected_cat_id" onchange="showSubMenu(this.value,'+nextLevel+','+cat_id+',\''+type+'\',\''+agent_url+'\',\''+agent_folder+'\')">';
	output += '<option value="">' + wording_ajax_menu1 + '</option>';
	}
 
	for ( j = 0; j < combo_list.length; j++) {
		if ( '' !== combo_list[j].name ) {
			if ( combo_list[j].lft + 1 < combo_list[j].rgt ) {
			//y or n tells the AJAX functions whether there are any more subcategories
				output += "<option value='y:" + combo_list[j].id + ':' + combo_list[j].name + "'>" + combo_list[j].name + '</option>';
			} else {
				output += "<option value='n:" + combo_list[j].id + ':' + combo_list[j].name + "'>" + combo_list[j].name + '</option>';
				}
			}
		}
	if(type=="regions"){
	output += '<input type="hidden" id="location_name" name="location_name" class ="location_name" value="">';
	output += '<input type="hidden" id="location_id" name="location_id" class ="location_id" value="'+myarr[1]+'"></select>';
	
	      document.getElementById(currentBlockNameStr).innerHTML=output+'<div class="'+nextBlockNameStr+'" id="'+nextBlockNameStr+'" name="'+nextBlockNameStr+'" >'+still_more_cats_reg+'</div>';
	      document.getElementById("selected_region_menu_name").value = myarr[2];
	      document.getElementById("location_name").value = myarr[2];
	document.getElementById("selected_region_name").value = myarr[2];
	document.getElementById("selected_region_id").value = myarr[1];
	}
	else
	{
	output += '<input type="hidden" id="cat_name" name="cat_name" class ="cat_name" value="">';
	output += '<input type="hidden" id="cat_id" name="cat_id" class ="cat_id" value="'+myarr[1]+'"></select>';
	    document.getElementById(currentBlockNameStr).innerHTML=output+'<div class="'+nextBlockNameStr+'" id="'+nextBlockNameStr+'" name="'+nextBlockNameStr+'" >'+still_more_cats+'</div>';

	   document.getElementById("selected_cat_menu_name").value = myarr[2];
	document.getElementById("selected_cat_name").value = myarr[2];
	document.getElementById("selected_cat_id").value = myarr[1]; 
	}
}
else//if(combo_list == "NO MORE SUB CATEGORIES" || combo_list == "Sorry, No More Regional Filters Found.")
{
document.getElementById(currentBlockNameStr).innerHTML=combo_list+'<div class="'+nextBlockNameStr+'" id="'+nextBlockNameStr+'" name="'+nextBlockNameStr+'" style="background-color: yellow;"></div>';
	 if(type=="regions"){
	 document.getElementById("selected_region_id").value = myarr[1];
	  document.getElementById("selected_region_menu_name").value = myarr[2];
	 document.getElementById("city_street_address").innerHTML="<span>Your street address (optional)<input type='text' name='city_street_address' value='' />       Link To Map (optional)<input type='text' name='map_link' value='' /></span>";
	 }
	 else
	 {
	document.getElementById("selected_cat_id").value = myarr[1]; 
	 document.getElementById("selected_cat_menu_name").value = myarr[2];
	}
      }   
    }
  }

if(type=="regions"){
  xmlhttp.open("GET","getsubloc1.php?tregional_num="+myarr[1]+"&type=regions&agent_url="+agent_url+"&agent_folder="+agent_folder);
}
else
{
xmlhttp.open("GET","getsubloc1.php?q="+myarr[1]+"&type=categories&agent_url="+agent_url+"&agent_folder="+agent_folder);
}
  xmlhttp.send();
}



function deleteAllLevels(category_id,original_cat_id) 
{
//deprecated - removed the 'Clear button from the display
	var regional_dropdown = "<form action=''><table id='mn_location_table'><tr><td><select name='regional_menu' onchange=\"showSubLoc1(this.value,1,"+category_id+",'regions')><option value=''>"+ wording_ajax_menu1+" </option><option value='y:2566:Africa'>Africa</option><option value='y:2567:America - Central'>America - Central</option><option value='y:2568:America - North'>America - North</option><option value='y:2569:America - South'>America - South</option><option value='y:2572:Asia'>Asia</option><option value='y:2573:Australia/Oceania'>Australia/Oceania</option><option value='y:2756:Caribbean'>Caribbean</option><option value='y:2575:Europe'>Europe</option><option value='y:2740:Middle East'>Middle East</option></select> <input type='hidden' id='regional_name' name='regional_name' class ='regional_name' value=''><input type='hidden' id='tregional_num' name='tregional_num' class='tregional_num'></td></tr></table></form><div id='locHint1' name='locHint1' class='locHint1'><b>"+still_more_cats_reg+"</b></div>";
document.getElementById("mn_location_container").innerHTML = regional_dropdown;
document.getElementById("goLink").innerHTML=""; 
var str="'y':"+original_cat_id+":";
var currentBlockNameStr= 'catHint'+ 1;


 if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {

    if (this.readyState==4 && this.status==200) {
var data = this.responseText;

var combo_list = JSON.parse(data);
var output = '<form action=""><table id=\'mn_location_table\'><tr><td><select name=\'regional_menu\' onchange="showSubLoc1(this.value,1, \''+original_cat_id+'\' ,\'categories\')"><option value=""> '+wording_ajax_menu1+' </option>';
for ( j = 0; j < combo_list.length; j++) {
		if ( '' !== combo_list[j].name ) {
			if ( combo_list[j].lft + 1 < combo_list[j].rgt ) {
			//y or n tells the AJAX functions whether there are any more subcategories
				output += "<option value='y:" + combo_list[j].id + ':' + combo_list[j].name + "'>" + combo_list[j].name + '</option>';
			} else {
				output += "<option value='n:" + combo_list[j].id + ':' + combo_list[j].name + "'>" + combo_list[j].name + '</option>';
				}
			}
		}
}
	output += '<div class="catHint1" id="catHint1" name="catHint1"><b>' +still_more_cats+ '</b></div><input type="hidden" id="category_name" name="category_name" class ="category_name" value=""><input type="hidden" id="category_id" name="category_id" class ="category_id" value=""<input type="hidden" id="tregional_num" name="tregional_num" class ="tregional_num" value="" ></select></form>';
document.getElementById("mn_subcat_container").innerHTML = output;

}
xmlhttp.open("GET","getsubcat1.php?q="+original_cat_id+"&type=categories");

   xmlhttp.send();
}


</script>
