<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<?php



$session_id=$user_agent=$user_ip=$current_url=$reference_url="";
session_start();
$session_id = session_id();
$user_agent=$_SERVER['HTTP_USER_AGENT'];
$user_ip = '';
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$current_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if(isset($_SERVER['HTTP_REFERER']))
{
$reference_url = $_SERVER['HTTP_REFERER'];
}
else
{
$reference_url="No Reference";
}
?>

<script>
var myjson;
$.getJSON("https://ipapi.co/json", function(json) {
    myjson = json;
    var public_ip = myjson.ip;
    var isp = myjson.org;
    var org = myjson.org;
    var country = myjson.country_name;
    var country_code = myjson.country;
    var region_code = myjson.region_code;
    var region = myjson.region;
    var city = myjson.city;
    var zip = myjson.postal;
    var lat = myjson.latitude;
    var lon = myjson.longitude;
    var timezone = myjson.timezone;
    var as = myjson.asn;
    var status = "success";
    $.post("system/main/insert_records", {
        techdevelopers_user_ip: public_ip,
        techdevelopers_session_id: <?php echo "'".$session_id."'";?>,
        techdevelopers_user_agent: <?php echo "'".$user_agent."'";?>,
        techdevelopers_current_url: <?php echo "'".$current_url."'";?>,
        techdevelopers_reference_url: <?php echo "'".$reference_url."'";?>,
        techdevelopers_isp: isp,
        techdevelopers_org: org,
        techdevelopers_country: country,
        techdevelopers_country_code: country_code,
        techdevelopers_region_code: region_code,
        techdevelopers_region: region,
        techdevelopers_city: city,
        techdevelopers_zip: zip,
        techdevelopers_lat: lat,
        techdevelopers_lon: lon,
        techdevelopers_timezone: timezone,
        techdevelopers_as: as,
        techdevelopers_status: status
    }, function(data, status) {
     //  alert(data);
    })
})
</script> 

<!-- Global site tag (gtag.js) - Google Analytics -->
