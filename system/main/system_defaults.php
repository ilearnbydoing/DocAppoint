<?php
$sql = "SELECT * FROM system_default";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) 
	{
$home_page_name=$row["HOME_PAGE_NAME"];

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


?>