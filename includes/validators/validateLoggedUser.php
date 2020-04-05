<?php
//VALIDATE USER IS LOGGED IN OR NOT
if (isset($_SESSION[md5(session_id())])) {
	if (($_SESSION[md5(session_id())] === md5(session_id() . " - " . session_status())) and
		isset($_SESSION["first_name"]) and
		isset($_SESSION["last_name"]) and
		isset($_SESSION["email"]) and
		isset($_SESSION["mobile"]) and
		isset($_SESSION["gender"]) and
		isset($_SESSION["logged_time"]) and
		isset($_SESSION["dob"])
	) {
		if(strpos($_SERVER['REQUEST_URI'], "login") !== false)
		{
			header("Location: ./");
		}
	}
	else
	{
		if((strpos($_SERVER['REQUEST_URI'], "DoctorRegistration") === false) and (strpos($_SERVER['REQUEST_URI'], "register") === false) and (strpos($_SERVER['REQUEST_URI'], "login") === false) and (strpos($_SERVER['REQUEST_URI'], "search") === false))
		{
			echo " <body>
						<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
						<script src='sweetalert2.all.min.js'></script>
						<script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>
						   <script type='text/javascript'>
						   Swal.fire({
							title: 'Login To Continue...',
							text: 'You need to login to continue!',
							icon: 'warning',
							showCancelButton: false,
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'Okay'
						  }).then(DocAppoint =>{
							 setTimeout(()=>{
								window.location.href='./login.php';
							 },10);
						  } )</script></body>";	
		}
	} 
}
else
{
	if((strpos($_SERVER['REQUEST_URI'], "DoctorRegistration") === false) and (strpos($_SERVER['REQUEST_URI'], "register") === false) and (strpos($_SERVER['REQUEST_URI'], "login") === false) and (strpos($_SERVER['REQUEST_URI'], "search") === false))
		{
			echo " <body>
						<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
						<script src='sweetalert2.all.min.js'></script>
						<script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>
						   <script type='text/javascript'>
						   Swal.fire({
							title: 'Login To Continue...',
							text: 'You need to login to continue!',
							icon: 'warning',
							showCancelButton: false,
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'Okay'
						  }).then(DocAppoint =>{
							 setTimeout(()=>{
								window.location.href='./login.php';
							 },10);
						  } )</script></body>";	
		}
}