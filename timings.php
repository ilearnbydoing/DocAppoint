<?php
include("./includes/system_essentials.php");
include("./includes/validators/validateLoggedUser.php");
if(isset($_POST[md5("timings")]))
{
    $businessHours='';
    for($j=0;$j<7;$j++)
    {
        if(isset($_POST[("start".$j)]) && isset($_POST[("end".$j)]))
        {
            if(($_POST[("start".$j)]=="Closed") or ($_POST[("end".$j)]=="Closed"))
            {
                $businessHours.= ("Closed, ");
            }
            else
            {
                $businessHours.= ($_POST[("start".$j)] ." - ".$_POST[("end".$j)].", ");
            }
        }
        else
        {
            echo " <body>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
        <script src='sweetalert2.all.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>
               <script type='text/javascript'>
               Swal.fire({
                title: 'Please try again!',
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
              }).then(DocAppoint =>{
                 setTimeout(()=>{
                     window.location.href='./timings.php';
                 },10);
              } )</script></body>";
            break;
        }       
    }
    
    $sql = "UPDATE users,user_profile SET 
    business_hours=\"".addslashes(trim($businessHours))."\"
    WHERE users.user_profile_id=user_profile.user_profile_id and users.user_id=".$_SESSION["user_id"];
   if ($conn->query($sql) === TRUE) {
    echo " <body>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
<script src='sweetalert2.all.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>
       <script type='text/javascript'>
       Swal.fire({
        title: 'Schedule Updated!',
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Okay'
      }).then(DocAppoint =>{
         setTimeout(()=>{
             window.location.href='./timings.php';
         },10);
      } )</script></body>";

    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>DocAppoint - Harsh Thakkar Project (1959894)</title>
    <?php include("./includes/metadata.php"); ?>
    <?php include("./includes/icons.php"); ?>
    <?php include("./includes/styling.php"); ?>
</head>

<body class="account-page">
    
    <div class="main-wrapper">
        <?php include("./includes/header.php"); ?>
        <!-- Breadcrumb -->
        <div class="breadcrumb-bar">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-12 col-12">
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Schedule Timings</li>
                            </ol>
                        </nav>
                        <h2 class="breadcrumb-title">Schedule Timings</h2>
                    </div>
                </div>
            </div>
        </div>
        

        
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                        <?php include("./includes/doctorProfileSidebar.php"); ?>

                    </div>

                    <div class="col-md-7 col-lg-8 col-xl-9">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Schedule Timings <i>(Here you can specify time slots for appointment booking)</i></h4>
                                        <div class="profile-box">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card schedule-widget mb-0">

                                                        <!-- Schedule Header -->
                                                        <div class="schedule-header">

                                                            <!-- Schedule Nav -->
                                                            <div class="schedule-nav">
                                                                <ul class="nav nav-tabs nav-justified">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" data-toggle="tab" href="#slot_1">Monday</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" data-toggle="tab" href="#slot_2">Tuesday</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" data-toggle="tab" href="#slot_3">Wednesday</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" data-toggle="tab" href="#slot_4">Thursday</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" data-toggle="tab" href="#slot_5">Friday</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" data-toggle="tab" href="#slot_6">Saturday</a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" data-toggle="tab" href="#slot_7">Sunday</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <!-- /Schedule Nav -->

                                                        </div>
                                                        <!-- /Schedule Header -->

                                                        <!-- Schedule Content -->
                                                        <div class="tab-content schedule-cont">
                                                            <?php
                                                            $query = "SELECT * FROM users,user_profile where user_profile.user_profile_id=users.user_profile_id and users.user_id=" . $_SESSION["user_id"];
                                                            $result = $conn->query($query);
                                                            $i = 0;
                                                            if ($result->num_rows > 0) {
                                                                if ($row = $result->fetch_assoc()) {
                                                                    $days = array_filter(preg_split("/\,/", trim($row["business_hours"])));
                                                                    $mon = $tue = $wed = $thurs = $fri = $sat = $sun = [];
                          
                                                                    $businessHours = [];
                                                                    $days = array_filter(preg_split("/\,/", trim($row["business_hours"])));
                                                                    
                                                                    for ($i = 0; $i < count($days); $i++) {
                                                                        
                                                                        if(strtolower(trim($days[$i]))!=strtolower(trim("Closed")))
                                                                        {   
                                                                        echo '<!-- Day Slot -->
                                                                            <div id="slot_' . ($i + 1) . '" class="tab-pane fade ' . (($i + 1) == 1 ? ("show active") : ("")) . '">
                                                                                <h4 class="card-title d-flex justify-content-between">
                                                                                    <span>Active Time Slots</span> 
                                                                                    <a class="edit-link" data-toggle="modal" href="#edit_time_slot'.($i+1).'"><i class="fa fa-edit mr-1"></i>Edit</a>
                                                                                </h4>
                                                                                <div class="doc-times">';
                                                                        
                                                                        $evaluate_day = array_filter(preg_split("/\ - /", trim($days[$i])));
                                                                        $evaluate_day[0] = str_replace(" ", "", str_replace(":00", "", str_replace("AM", "", $evaluate_day[0])));
                                                                        $evaluate_day[1] = 12 + (str_replace(" ", "", str_replace(":00", "", str_replace("PM", "", $evaluate_day[1]))));
                                                                        
                                                                        for ($j = 0; $j <= ($evaluate_day[1] - $evaluate_day[0]); $j++)
                                                                        {                                                                         
                                                                                echo '<div class="doc-slot-list">
                                                                                ' . date("h:i A",strtotime(($evaluate_day[0] + $j) . ":00"))  . ' - 
                                                                                ' . date("h:i A",strtotime(($evaluate_day[0] + $j+1) . ":00")). '</div>';
                                                                         
                                                                        }


                                                                        echo '</div>      
                                                                                                                                                          
                                                                            </div>
                                                                            <!-- /Day Slot -->';
                                                                    }
                                                                    else
                                                                    {
                                                                        echo '<!-- Day Slot -->
                                                                        <div id="slot_' . ($i + 1) . '" class="tab-pane fade">
                                                                            <h4 class="card-title d-flex justify-content-between">
                                                                                <span>Active Time Slots</span> 
                                                                                <a class="edit-link" data-toggle="modal" href="#edit_time_slot'.($i + 1).'"><i class="fa fa-edit mr-1"></i>Edit</a>
                                                                            </h4>
                                                                            <div class="doc-times">
                                                                            <div style="background-color:#dc3545;border:1px solid #dc3545;" class="doc-slot-list">
                                                                            Closed </div>
                                                                                
                                                                                </div>      
                                                                                                                                                          
                                                                            </div>
                                                                            <!-- /Day Slot -->';
                                                                    }
                                                                }
                                                                }
                                                            }
                                                            ?>

                                                        </div>
                                                        

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
        

        
        <?php include("./includes/footer.php"); ?>

    </div>
    <form method="post" action="./timings.php">    <?php
                                                            $query = "SELECT * FROM users,user_profile where user_profile.user_profile_id=users.user_profile_id and users.user_id=" . $_SESSION["user_id"];
                                                            $result = $conn->query($query);
                                                            $i = 0;
                                                            if ($result->num_rows > 0) {
                                                                if ($row = $result->fetch_assoc()) {
                                                                    $days = array_filter(preg_split("/\,/", trim($row["business_hours"])));
                                                                    $mon = $tue = $wed = $thurs = $fri = $sat = $sun = [];
                          
                                                                    $businessHours = [];
                                                                    $days = array_filter(preg_split("/\,/", trim($row["business_hours"])));
                                                                    $daysName = array('Monday', 'Tuesday', 'Wednesday','Thursday','Friday','Saturday','Sunday');

                                                                    for ($i = 0; $i < count($days); $i++) {
                                                                        
                                                                        echo '
    <!-- Edit Time Slot Modal -->
    <div class="modal fade custom-modal" id="edit_time_slot'.($i+1).'">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Time Slots</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                        <div class="hours-info">
                            <div class="row form-row hours-cont">
                                <div class="col-12 col-md-10">
                                    <div class="row form-row">
                                    <p>Set your opening and closing hours on '.$daysName[$i].'.</p>
                                            <br>
                                       <div class="col-12 col-md-6">
                                            <div class="form-group">
                                            
                                              <label>Start Time</label><br><br>';
                                              if(strtolower(trim($days[$i]))!=strtolower(trim("Closed")))

                                           {
                                              $evaluate_day = array_filter(preg_split("/\ - /", trim($days[$i])));
                                                 $evaluate_day[0] = str_replace(" ", "", str_replace(":00", "", str_replace("AM", "", $evaluate_day[0])));
                                                 $evaluate_day[1] = 12 + (str_replace(" ", "", str_replace(":00", "", str_replace("PM", "", $evaluate_day[1]))));
                                                  echo '<select name="start'.$i.'" class="form-control">';
                                                echo '<option value="Closed">Closed</option>';
                                                for($j=0;$j<24;$j++)
                                                {
                                                    echo '<option '.(($evaluate_day[0]==$j)?"selected":"").' value="'.date("h:i A",strtotime($j.":00")).'">'.date("h:i A",strtotime($j.":00")).'</option>';
                                                }
                                                    
                            echo '</select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>End Time</label><br><br>
                                                <select name="end'.$i.'" class="form-control">';
                                                echo '<option value="Closed">Closed</option>';
                                                for($j=0;$j<24;$j++)
                                                {
                                                    echo '<option '.(($evaluate_day[1]==$j)?"selected":"").' value="'.date("h:i A",strtotime($j.":00")).'">'.date("h:i A",strtotime($j.":00")).'</option>';
                                                }
                                               echo '</select>';
                                            }
                                            else
                                            {
                                                echo '<select name="start'.$i.'" class="form-control">';
                                                echo '<option selected value="Closed">Closed</option>';
                                                for($j=0;$j<24;$j++)
                                                {
                                                    echo '<option value="'.date("h:i A",strtotime($j.":00")).'">'.date("h:i A",strtotime($j.":00")).'</option>';
                                                }
                                                    
                            echo '</select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>End Time</label><br><br>
                                                <select name="end'.$i.'" class="form-control">';
                                                echo '<option selected value="Closed">Closed</option>';
                                                for($j=0;$j<24;$j++)
                                                {
                                                    echo '<option value="'.date("h:i A",strtotime($j.":00")).'">'.date("h:i A",strtotime($j.":00")).'</option>';
                                                }
                                               echo '</select>';
                                            }
                                            echo '</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submit-section text-center">
                            <button type="submit" name="'.md5("timings").'" class="btn btn-primary submit-btn">Save Changes</button>
                        </div>
                   
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Time Slot Modal -->';
                                                                    }
                                                                }
                                                            }
    ?>
 </form>
    <?php include("./includes/scripting.php"); ?>

    </body> </html>