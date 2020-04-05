
<?php
$custom_css="";
include("system/main/db/connect_techdevelopers_system_content_manager/connect.php");
include("system/main/user_tracking.php");
$sql = "SELECT * FROM system_default";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) 
	{
$home_page_name=$row["HOME_PAGE_NAME"];
$about_page_name=$row["ABOUT_US_PAGE_NAME"];
$gallery_page_name=$row["OUR_WORK_PAGE_NAME"];
$team_page_name=$row["TEAM_PAGE_NAME"];
$blog_page_name=$row["SERVICES_PAGE_NAME"];
$contact_page_name=$row["CONTACT_PAGE_NAME"];
$donate_page_name=$row["CLIENT_PAGE_NAME"];
$maintanance_page_name=$row["CAREER_PAGE_NAME"];

$home_page_title=$row["WEBSITE_TITLE"];
$home_page_meta_tags=$row["WEBSITE_META"];
$home_page_fav_icon=$row["WEBSITE_ICON"];

$home_page_top_links_left=$row["WEBSITE_TOP_CONTACT"];
$home_page_top_links_right=$row["WEBSITE_TOP_SOCIAL"];


//$testimonial_heading=$row[""];
//load testimonial loop section

$bottom_contact_banner_header=$row["WEBSITE_CONTACT_BANNER_HEADING"];
$bottom_contact_banner_sub_header=$row["WEBSITE_CONTACT_BANNER_SUB_HEADING"];

$bottom_about_us_content=$row["WEBSITE_FOOTER_ABOUT_CONTENT"];
$bottom_quick_links=$row["WEBSITE_FOOTER_QUICK_LINKS"];
$bottom_contact_us_content=$row["WEBSITE_FOOTER_CONTACT_CONTENT"];
$bottom_contact_us_address=$row["WEBSITE_FOOTER_ADDRESS"];
$bottom_contact_us_mail=$row["WEBSITE_FOOTER_MAIL"];
$bottom_contact_us_mail2=$row["WEBSITE_FOOTER_LEFT_LINE"];	
$bottom_contact_us_mobile=$row["WEBSITE_FOOTER_MOBILE"];
$bottom_social_links=$row["WEBSITE_FOOTER_ABOUT_SOCIAL"];

$bottom_year=$row["WEBSITE_FOOTER_YEAR"];
$bottom_left_content=$row["WEBSITE_FOOTER_LEFT_LINE"];
$bottom_right_content=$row["WEBSITE_FOOTER_RIGHT_LINE"];



//JAVASCRIPT
$additional_js_top=$row["WEBSITE_JS_TOP"];
$additional_js_bottom=$row["WEBSITE_JS_BOTTOM"];
	}
}
//$conn->close();

//===CHECK DEVICE


//Detect special conditions devices
$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");

//do something with this information
if( $iPod || $iPhone ){
$custom_css = '.navbar-header { position: absolute;right: 0px; top: 0;z-index: 9; }   header a.cart i {    display: inline-block;float: right;    line-height: 42px;    vertical-align: middle; }';   
//browser reported as an iPhone/iPod touch -- do something here
}else if($iPad){
    //browser reported as an iPad -- do something here
}else if($Android){
    //browser reported as an Android device -- do something here
}else if($webOS){
    //browser reported as a webOS device -- do something here
}



?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script src="sweetalert2.all.min.js"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 -->
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
