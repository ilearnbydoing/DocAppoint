<?php
include("./includes/system_essentials.php");
unset($_SESSION[md5("SearchingForDoctors")]);
if (isset($_GET[session_id()])) {
    if ($_GET[session_id()] === md5(session_id())) {


        if(isset($_GET[md5("LocationQuery")]))
        {
            $query = "SELECT DISTINCT(city),state,country FROM users,user_types where ((users.city like '%".$_GET[md5("LocationQuery")]."%') or (users.country like '%".$_GET[md5("LocationQuery")]."%') or (users.state like '%".$_GET[md5("LocationQuery")]."%') ) and users.user_type_id=2 and users.status=1 and users.user_type_id=user_types.user_types_id";
			$result = $conn->query($query);
			if ($result->num_rows > 0) {
                echo "<div style='padding:8px;'>";
                while ($row = $result->fetch_assoc()) {
                    echo "<div onclick='selectLocation(\"".ucfirst($row["city"])."\", \"".ucfirst($row["state"])."\", \"".ucfirst($row["country"])."\")' style='cursor:pointer;'>".ucfirst($row["city"])."  (".ucfirst($row["country"]).")  </div>";
                }
                echo "</div>";
            }
            else
            {
                echo "<div style='padding:8px;'>";
                echo "No Suggestions";
                echo "</div>";
            }
        }
        else if($_GET[md5("DoctorQuery")])
        {
            $query = "SELECT DISTINCT(specialities) FROM users,user_profile where ((user_profile.specialities like '%".$_GET[md5("DoctorQuery")]."%')) and  users.status=1 and user_profile.user_profile_id=users.user_profile_id";
            $result = $conn->query($query);
            $specialities="";
            $i=0;
			if ($result->num_rows > 0) {
                echo "<div style='padding:8px;'>";

                //SPECIALITIES SEARCH AND SORT START
                while ($row = $result->fetch_assoc()) {
                    $specialities .= trim($row["specialities"]);
                }
                $specialities = array_unique(array_filter(preg_split("/\,/", trim($specialities))));
                foreach($specialities as $i) {
                  if(strpos(strtolower(trim($i)), strtolower(trim($_GET[md5("DoctorQuery")]))) !== false)
                    {
                        echo "<div onclick='selectDoctor(\"".ucfirst(trim($i))."\")' style='cursor:pointer;'>".ucfirst(trim($i))."  </div>"; 
                    }
                }
                //SPECIALITIES SEARCH AND SORT END
                echo "</div>";
            }
            else
            {
                echo "<div style='padding:8px;'>";
                echo "No Suggestions";
                echo "</div>";
            }
        }
        else
        {

        }
    } else {
        exit(0);
    }
}
?>
