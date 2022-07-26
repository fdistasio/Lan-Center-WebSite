<html>
<head>

<title>Prenota</title>
<link rel="StyleSheet" type="text/css" href="stile.css">



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
  <li><a class="active" href="Prenotazione.php">Prenota</a></li>
  <li><a href="AreaRiservata.php">Area Riservata</a></li>
  <li><a href="Relazione.html">Relazione</a></li>
  
</ul>
</div>

<br><br>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<fieldset>

<legend><b>Dati Personali</b></legend>
		<label>
					 Nome: <input type="text" name="nome"/>
		</label>
		<label>
					 Cognome: <input type="text" name="cognome"/>
		</label>
		<label>
					 Data di Nascita: <input type="date" name="datanascita"/>
		</label>
		<label>
					 Email: <input type="email" name="email"/>
		</label>
		<label>
					 Numero di telefono: <input type="text" name="telefono"/>
		</label>
		
		
		
		
</fieldset>
<br>
<fieldset>

<legend><b>Prenotazione</b></legend>
		
		<label>
					 Username: <input type="text" name="username"/>
		</label>
		
		<label>
					Servizio bar:
					<select name="bar" >
					 				 <option name="si" value="si">sì</option>
									 <option name="no" value="no">no</option>					
						</select>
		</label>
		
		<label>
					Postazione:
					<select name="postazione" >
					 				 <option name="1" value="1">1</option>
									 <option name="2" value="2">2</option>			
									 <option name="3" value="3">3</option>
									 <option name="4" value="4">4</option>		
									 <option name="5" value="5">5</option>
									 <option name="6" value="6">6</option>		
									 <option name="7" value="7">7</option>
									 <option name="8" value="8">8</option>		
									 <option name="9" value="9">9</option>
									 <option name="10" value="10">10</option>		
									
						</select>
		</label>
		
		<label>
					 Data: <input type="date" name="dataprenotazione"/>
		</label>
		<label>
					 Ora: <input type="time" name="orario"/>
		</label>
		
		
		<label>
  		 			Richieste aggiuntive:<br/>
  						<textarea name="richieste" rows="4" cols="40"></textarea> 
  		 </label>
		
		<label><span id="invia1"><input type="submit" name="submit" value="Invia"/> </span> </label>
		<label><span id="cancella1"><input type="reset" name="cancella" value="Cancella"/>	</span> </label>
		
		<br>
		
</fieldset>


</form>


<?php

if(isset($_POST['submit'])) 
{ 
//assegnazione dei contenuti del form alle variabili

$nome_giocatore=$_POST['nome'];
$cognome_giocatore=$_POST['cognome'];
$data_di_nascita=$_POST['datanascita'];
$email=$_POST['email'];
$telefono=$_POST['telefono'];

$username=$_POST['username'];
$postazione=$_POST['postazione'];
$bar=$_POST['bar'];
$data_prenotazione=$_POST['dataprenotazione'];
$orario=$_POST['orario'];
$alleore=$_POST['alleore'];
$richieste=$_POST['richieste'];

$sql0="SELECT * FROM POSTAZIONE WHERE DATA_PRENOTAZIONE='$data_prenotazione' AND ORARIO='$orario' AND ID_POSTAZIONE='$postazione'";
	
	$result0=mysqli_query($conn,$sql0);
	
	$n_corrispondenze=mysqli_num_rows($result0);
	
	
	if($n_corrispondenze==1){
		
			 echo "<div align='center'>Data non disponibile</div>";
			
	}else {
		 
		



$sql1="INSERT INTO GIOCATORE(NOME_GIOCATORE,USERNAME,COGNOME,DATA_DI_NASCITA,EMAIL,NUMERO_DI_TELEFONO,USERNAME_ADMIN) VALUES ('$nome_giocatore','$username','$cognome_giocatore','$data_di_nascita','$email','$telefono','paolo')";


mysqli_query($conn, $sql1);
$id = mysqli_insert_id($conn); //restituisce l'ultimo id andatosi a creare tramite un AUTO_INCREMENT e lo assegna come foreign key alla tabella postazione
$sql2="UPDATE POSTAZIONE SET SERVIZIO_BAR='$bar',RICHIESTE_AGGIUNTIVE='$richieste',DATA_PRENOTAZIONE='$data_prenotazione',ORARIO='$orario',ID_GIOCATORE='$id' WHERE ID_POSTAZIONE='$postazione'";

if (mysqli_query($conn, $sql2)) {
  echo "<div align='center'>Prenotazione effettuata!</div>";
} else {
  echo "<div align='center'> Error: </div>" . $sql . "<br>" ."<div align='center'>". mysqli_error($conn)."</div>";
}}
mysqli_close($conn);
}

?>

</body>

</html>