<?php 
if(isset($_SESSION["user_type"]))
{
    if(($_SESSION["user_type"]=="doctor") and ($_SESSION["doctor_logged"]==1))
    {
        header("Location: ./doctorAppointments.php");
    }

}
?>