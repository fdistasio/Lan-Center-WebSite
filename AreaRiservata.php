<html>
<head>

<title>Area Riservata</title>
<link rel="StyleSheet" type="text/css" href="stile.css?v=1">


</head>

<body background="sfondohome.png">
<?php
//connessione db
$db_name="sala_lan";
$user="root";
$passw="prova";
$host="localhost";
$conn= mysqli_connect($host,$user,$passw,$db_name); 
if (!$conn) {
  die("Errore di connessione: " . mysqli_connect_error());
}

?>

<div class="topbar"> 
<ul>
  <li><a href="Home.php">Home Page</a></li>
  <li><a href="Prenotazione.php">Prenota</a></li>
  <li><a class="active" href="AreaRiservata.php">Area Riservata</a></li>
  <li><a href="Relazione.html">Relazione</a></li>
  
</ul>
</div>
<br><br>
<form  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<fieldset>

<legend><b>Accedi</b></legend>
		<label>
					 Username: <input type="text" name="useradmin"/>
		</label>
		<label>
					 Password: <input type="password" name="password"/>
		</label>
		<label><span id="invia2"><input type="submit" name="submit" value="Accedi"/> </span> </label>
		<label><span id="cancella2"><input type="reset" name="cancella" value="Cancella"/>	</span> </label>
		<br>
		
		
</fieldset>
<?php
//accesso

//user: paolo ; password: cannone
if(isset($_POST['submit'])){

	$username=$_POST['useradmin'];
	
	$password=$_POST['password'];

	$username=stripslashes($username); //tutela sql injection (rimuove i \ da una stringa)
	
	$password=stripslashes($password); //tutela sql injection (rimuove i \ da una stringa)
	

	
	$passwmd5=md5($password); //conversione della password in md5
	
	
	$sql="SELECT * FROM AMMINISTRATORE WHERE USERNAME_ADMIN='$username' AND PASSWORD='$passwmd5'";
	
	$result=mysqli_query($conn,$sql);
	
	$n_corrispondenze=mysqli_num_rows($result);
	
	if($n_corrispondenze==1){
		//inizializzazione della sessione
		session_start();
		$_SESSION['username']=$username;
		$_SESSION['password']=$passwmd5;
		header("Location: AreaAdmin.php");
	}else {
		 echo "<div align='center'> Login non riuscito. Username o Password Errati.</div>";
		}
}



?>
</body>

</html>