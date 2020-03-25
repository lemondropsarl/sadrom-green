<?php

defined('BASEPATH') OR exit('No direct script access allowed');?>

<html>

<head>
	<title>Sadrom - Management System</title>


	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>SB Admin 2 - Login</title>

	<!-- Custom fonts for this template-->
	<link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet"
		type="text/css">
	<link
		href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
		rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?php echo base_url('assets/css/sb-admin-2.min.css');?>" rel="stylesheet">

</head>
<?php 
	
		function display_information($message) {
			global $display_message;
			global $flag;
			$display_message = $display_message . $message . "<br/>";   
			if($message=="You have latest version of application installed."){
				$flag=true;
			}
				
		}
		function application_url(){
            /* Get Page Url */
            $pageURL = 'http';
            if ( isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on" ) {
                $pageURL .= "s";
            }
            $pageURL .= "://";
            if ($_SERVER["SERVER_PORT"] != "80") {
                $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
            } else {
                $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
            }        
            $pageURL = explode("/", $pageURL);        
            $base_path = '';
            for($i=0; $i < (sizeof($pageURL)-1); $i++){
                $base_path .= $pageURL[$i] . "/";
            }
            return $base_path;
		
		}
		function get_server() {
			// Edit config/database.php file 
			$database_file = "application/config/database.php";
			$line_array = file($database_file);

			for ($i = 0; $i < count($line_array); $i++) {
				if (strstr($line_array[$i], "'hostname' =>")) {
					$server = str_replace("'hostname' =>", "", $line_array[$i]);
					$server = str_replace("'", "", $server);
					$server = str_replace(",", "", $server);
					$server = trim($server);
					return $server;
				}
			}
		}
		function get_username() {
			// Edit config/database.php file 
			$database_file = "application/config/database.php";
			$line_array = file($database_file);

			for ($i = 0; $i < count($line_array); $i++) {
				if (strstr($line_array[$i], "'username' => ")) {
					$username = str_replace("'username' => ", "", $line_array[$i]);
					$username = str_replace("'", "", $username);
					$username = str_replace(",", "", $username);
					$username = trim($username);
					return $username;
				}
			}
		}
		function get_password() {
			// Edit config/database.php file 
			$database_file = "application/config/database.php";
			$line_array = file($database_file);

			for ($i = 0; $i < count($line_array); $i++) {
				if (strstr($line_array[$i], "'password' => ")) {
					$password = str_replace("'password' => ", "", $line_array[$i]);
					$password = str_replace("'", "", $password);
					$password = str_replace(",", "", $password);
					$password = trim($password);
					return $password;
				}
			}
		}
		
		
		function display_error($message) {
            echo "<div class=\"alert alert-danger\" >$message</div>";
        }
		function is_installed() {
			$database_file = "application/config/database.php";
			if(!file_exists($database_file)){
				return FALSE;
			}else{
				return TRUE;
			}
		}
		function does_database_exist($server, $username, $password,$dbname){
			$mysql = mysqli_connect($server, $username, $password,$dbname);
			if (!$mysql) {
				return 0;
			}else{
				return 1;
			}
		}
		function are_tables_created($dbprefix,$con){
			$sql = "SHOW TABLES LIKE version";
            $result = mysqli_query($con,$sql);
			if((mysqli_num_rows($result))==0){
				return FALSE;	
			}else{		
				return TRUE;
			}
		}
		
		function display_form($message){
			if($message != ""){
				display_error($message);
			}
			?>

<div class=" p-3">
	<div class=" text-gray-500">
		<h5>ETAPE 1 : INSTALLATION BASE DE DONNEE</h5>
	</div>
	<div class="text">
		<h6>Veuillez Completer les informations ci-dessous</h6>
	</div>
	<?php echo form_open('starter/install');?>
	<input type="hidden" name="step" value="1" />
	<div class="form-group">
		<span class=" input-group-addon">Host Name</span>
		<input type="text" class="form-control" name="server" placeholder="localhost" required />
	<span class="small">Trouver de la part de votre web host, si <strong>localhost</strong>
		ne fonctionne pas.</span>
	</div>
	<div class="form-group">
		<span class="input-group-addon">Nom base de donnée</span>
		<input type="text" class="form-control" name="dbname" placeholder="example: sadrom" required />
	</div>

	<div class="form-group">
		<span class="input-group-addon">Nom utilisateeur MySQL</span>
		<input type="text" class="form-control" name="username" placeholder="MySQL Username" required />
	</div>
	<div class="form-group">
		<span class="input-group-addon">Mot de passe MySQL</span>
		<input type="text" class="form-control" name="password" placeholder="MySQL Password" />
	</div>
	<button type="submit" name="submit" class="btn btn-success" />Installation</button>
	<?php echo form_close();?>


</div>


<?php
		}	
		function display_system_admin_form($message){
			if($message != ""){
				display_error($message);
			}
			?>
<div class="p-3">
	<div class=" text-gray-500">
		<h5>ETAPE 2 : CREATION DE L'ADMINISTRATEUR</h5>
	</div>
	<div class="text">
		<h6>Veuillez Completer les informations ci-dessous</h6>
	</div>
	<?php echo form_open('starter/install');?>
				<input type="hidden" name="step" value="2" />

				<div class="form-group">
					<span class="input-group-addon">Prenom</span>
					<input type="text" class="form-control" name="fname" placeholder="example : LEmondrop" required />
				</div>
				<div class="form-group">
					<span class="input-group-addon">Nom</span>
					<input type="text" class="form-control" name="lname" placeholder="example : Lemondrop" required />
				</div>
				<div class="form-group">
					<span class="input-group-addon">Email</span>
					<input type="text" class="form-control" name="email" placeholder="example : admin@example.com" required />
				</div>
				<div class="form-group">
					<span class="input-group-addon">Société</span>
					<input type="text" class="form-control" name="company" placeholder="example : LEmondrop" required />
				</div>
				<div class="form-group">
					<span class="input-group-addon">Numero Telephone</span>
					<input type="text" class="form-control" name="phone" placeholder="example : admin" required />
				</div>
				<div class="form-group">
					<span class="input-group-addon">Nom d'utilisateur</span>
					<input type="text" class="form-control" name="username" placeholder="example : admin" required />
				</div>
				<div class="form-group ">
					<span class="input-group-addon">Mot de passe</span>
					<input type="password" class="form-control" name="password" placeholder="Mot de passe" />
				</div>
				<div class="form-group">
					<span class="input-group-addon">Confirmer Password</span>
					<input type="password" class="form-control" name="confirm_password"
						placeholder="Confirm Password" />
				</div>
				<button type="submit" name="submit" class="btn btn-success" />Creation</button>
				<?php form_close();?>

		</div>

<?php
		}
		function display_finish_form(){
			?>
			<div class="p-5">
				<div class=" text-success text-center">
					<h5>INSTALLATION EFFECTUEE AVEC SUCCESS</h5>
				</div>

				<div class="form-horizontal">
					<a class="btn btn-success square-btn-adjust" title="Goto Application"
						href="<?php echo base_url('dashboard');?>">Acceder à l'application</a>
				</div>
			</div>
	<?php	}
	?>

<body class="bg-gradient-dark">
	<div class="container">
		<div class="row  justify-content-center">
			<div class="col-xl-10 col-lg-12 col-md-12">
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<div class="row">
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h2>INSTALLTION SADROM GREEN</h2>
									</div>
								</div>
							</div>
							<div class="col-md-8">

									<?php
									if ($req == 1) {
									// Check if application is installled or not      
										if (!is_installed()) {
							
							
										/************************************************************
										** Step 1 - Ask for MySQL Credentials
										*************************************************************/
							
										$message="";
							
										display_form($message);
										}
									}elseif ($req == 2) {
							
										/************************************************************
										** Step 2 - With given Credentials
										**          Install the application for the first time
										*************************************************************/
										//$this->load->library('migration');
										//$this->load->dbforge();
						
										display_system_admin_form("");
						
										?>
							</div>
							<?php   }elseif ($req == 3) {
										/************************************************************
										** Step 3 - Ask for System administrator Username and Password
										*************************************************************/
										?>
							<div class="col-lg-6">
									<?php	
									display_finish_form();
								} ?>
							</div>
								
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js');?>"></script>
	<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js');?>"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?php echo base_url('assets/js/sb-admin-2.min.js');?>"></script>
</body>

</html>
