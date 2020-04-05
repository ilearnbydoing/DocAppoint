<?php
session_start();
if (isset($_POST['stripeToken']) and isset($_SESSION[md5("selected_dr_id")]) and isset($_SESSION["user_id"]) and isset($_SESSION["requestPayment"])) {
	if ($_SESSION["requestPayment"] == true) {
		$_SESSION["amount"] = 500;
		require_once('vendor/autoload.php');
		require_once('config/db.php');
		require_once('lib/pdo_db.php');
		require_once('modules/transaction.php');
		\Stripe\Stripe::setApiKey('sk_test_Z2Q9z1BSxFiWIepcOz95jprU00txCrjjJp'); //your api key here
		$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
		$token = $_POST['stripeToken'];
		$customer = \Stripe\Customer::create(array(
			"email" => $_SESSION["email"],
			"source" => $token,
		));

		$charge = \Stripe\Charge::create(array(
			"amount" => $_SESSION["amount"],
			"currency" => "cad",
			"customer" => $customer->id
		));

		$transactionData = [
			'id' => $charge->id,
			'userid' => $charge->customer,
			'product' => $charge->description,
			'amount' => $charge->amount,
			'currency' => $charge->currency,
			'status' => $charge->status,
		];

		$transaction = new Transaction();
		$transaction->addTransaction($transactionData);
		//unset sessions
		unset($_SESSION[md5(session_id() . "" . "nextDate")]);
		unset($_SESSION[md5(session_id() . "" . "previousDate")]);
		unset($_SESSION["counter"]);
		$_SESSION["appointmentBooked"] = true;
		$_SESSION["restrictPageLoad"] = true;
		$_SESSION["transactionID"] = $charge->id;
		header('location: ../bookingSuccessful.php');
	} else {
		echo " <body>
						<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
						<script src='sweetalert2.all.min.js'></script>
						<script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>
						   <script type='text/javascript'>
						   Swal.fire({
							title: 'Invalid Page Requested.',
							icon: 'warning',
							showCancelButton: false,
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'Okay'
						  }).then(DocAppoint =>{
							 setTimeout(()=>{
								window.location.href='../checkout.php';
							 },10);
						  } )</script></body>";
	}
} else {
	echo " <body>
						<script src='https://cdn.jsdelivr.net/npm/sweetalert2@9'></script>
						<script src='sweetalert2.all.min.js'></script>
						<script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>
						   <script type='text/javascript'>
						   Swal.fire({
							title: 'Invalid Page Requested.',
							icon: 'warning',
							showCancelButton: false,
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'Okay'
						  }).then(DocAppoint =>{
							 setTimeout(()=>{
								window.location.href='../checkout.php';
							 },10);
						  } )</script></body>";
}
