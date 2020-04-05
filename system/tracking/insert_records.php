<?php



if(isset($_POST['techdevelopers_session_id']))
{
echo $techdevelopers_user_ip= $_POST['techdevelopers_user_ip'];
echo $techdevelopers_session_id= $_POST['techdevelopers_session_id'];
echo $techdevelopers_user_agent= $_POST['techdevelopers_user_agent'];
echo $techdevelopers_current_url= $_POST['techdevelopers_current_url'];
echo $techdevelopers_reference_url= $_POST['techdevelopers_reference_url'];
echo $techdevelopers_isp = $_POST['techdevelopers_isp'];
echo $techdevelopers_org = $_POST['techdevelopers_org'];
echo $techdevelopers_country = $_POST['techdevelopers_country'];	 
echo $techdevelopers_country_code = $_POST['techdevelopers_country_code'];	 
echo $techdevelopers_region_code = $_POST['techdevelopers_region_code'];
echo $techdevelopers_region = $_POST['techdevelopers_region'];
echo $techdevelopers_city = $_POST['techdevelopers_city'];
echo $techdevelopers_zip = $_POST['techdevelopers_zip'];
echo $techdevelopers_lat = $_POST['techdevelopers_lat'];
echo $techdevelopers_lon = $_POST['techdevelopers_lon'];
echo $techdevelopers_timezone = $_POST['techdevelopers_timezone'];
echo $techdevelopers_as = $_POST['techdevelopers_as'];
echo $techdevelopers_status = $_POST['techdevelopers_status']; 

include("../../system/main/db/connect_techdevelopers_system_content_manager/connect.php");

//----RECORDS INSERTION
echo $insert_tracking_record = "INSERT INTO system_logs(session_id,user_agent,user_ip,current_url,referring_url,isp,org,country,country_code,region_code,region,city,zip,lat,lon,timezone,as_info,status) VALUES ('$techdevelopers_session_id','$techdevelopers_user_agent','$techdevelopers_user_ip','$techdevelopers_current_url','$techdevelopers_reference_url','$techdevelopers_isp','$techdevelopers_org','$techdevelopers_country','$techdevelopers_country_code','$techdevelopers_region_code','$techdevelopers_region','$techdevelopers_city','$techdevelopers_zip','$techdevelopers_lat','$techdevelopers_lon','$techdevelopers_timezone','$techdevelopers_as','$techdevelopers_status')";

if ($conn->query($insert_tracking_record) === TRUE) {
	echo '<script> alert("Inserted")</script>';
    
} 
else {
	echo "<script> alert('URCI ERROR')</script>";
}
}

else
{
   // header("Location: ../index.php");

}


?>