<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "webappointmentsystem";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
   die("
   <body>
   <script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
   <script src='sweetalert2.all.min.js'></script>
   <script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>
      <script type='text/javascript'>
      Swal.fire({
       title: 'Oops..!',
       text: 'System is under maintenance. Check back later!',
       icon: 'warning',
       showCancelButton: false,
       confirmButtonColor: '#3085d6',
       confirmButtonText: 'Okay'
     }).then(DocAppoint =>{
        Swal.fire('You are being redirected...');
        setTimeout(()=>{
            window.location.href='https://techdevelopersweb.com';
        },3000);
     } )</script></body>");
     exit(0);
}

