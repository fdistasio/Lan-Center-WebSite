<html>
<head>

<title>Sala LAN</title>
<link rel="StyleSheet" type="text/css" href="stile.css?v=1">



</head>

<body background="sfondohome.png">

<?php
//connessione db

$host="localhost";
$db_name="sala_lan";
$username="root";
$passw="prova";

$conn=mysqli_connect($host,$username,$passw,$db_name);
if(!$conn){
	die ("Errore di connessione".mysqli_connect_error());
}
?>

<div class="topbar"> 
<ul>
  <li><a href="Home.php">Home Page</a></li>
  <li><a href="Prenotazione.php">Prenota</a></li>
  <li><a href="AreaRiservata.php">Area Riservata</a></li>
  <li><a href="Relazione.html">Relazione</a></li>
  
</ul>
</div>

<br>
<div id="stat" align="center">Informazioni dei giocatori della Sala Lan.</div><br>


<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
<fieldset>
<legend><b>Informazioni</b></legend>


<label>
Username del Giocatore: <input type="text" name="usernamegiocatore"/>
</label>

<label><span id="invia3"><input type="submit" name="submit" value="Cerca"/> </span> </label>
<label><span id="cancella3"><input type="reset" name="cancella" value="Cancella"/>	</span> </label>
<br>
</fieldset>
</form>
<table border="1" align="center">

<th>Username</th>
<th>Nome</th>
<th>Cognome</th>
<th>Data di nascita</th>
<th>Email</th>
<th>Numero di telefono</th>
<th>Data Prenotazione</th>
<th>Orario Prenotazione</th>
<th>Importo</th>
<th>Servizio bar</th>
<th>Richieste aggiuntive</th>
<?php


if(isset($_POST['submit'])){
	//query di richiesta della ricerca tramite username
	$user=$_POST['usernamegiocatore'];
	$sql="SELECT NOME_GIOCATORE,COGNOME,DATA_DI_NASCITA,EMAIL,NUMERO_DI_TELEFONO,USERNAME,DATA_PRENOTAZIONE,ORARIO,PREZZO,SERVIZIO_BAR,RICHIESTE_AGGIUNTIVE 
		  FROM GIOCATORE INNER JOIN POSTAZIONE ON POSTAZIONE.ID_GIOCATORE=GIOCATORE.ID_GIOCATORE WHERE USERNAME='$user'";
	$result=mysqli_query($conn,$sql);
	
	
	
if (mysqli_num_rows($result)>0) {
while($row=mysqli_fetch_assoc($result)){
echo "<tr>";
echo"<td>".$row["USERNAME"]."</td>";
echo"<td>".$row["NOME_GIOCATORE"]."</td>";
echo"<td>".$row["COGNOME"]."</td>";
echo"<td>".$row["DATA_DI_NASCITA"]."</td>";
echo"<td>".$row["EMAIL"]."</td>";
echo"<td>".$row["NUMERO_DI_TELEFONO"]."</td>";
echo"<td>".$row["DATA_PRENOTAZIONE"]."</td>";
echo"<td>".$row["ORARIO"]."</td>";
echo"<td>".$row["PREZZO"]."</td>";
echo"<td>".$row["SERVIZIO_BAR"]."</td>";
echo"<td>".$row["RICHIESTE_AGGIUNTIVE"]."</td>";
echo "</tr>";
}}

}else{
	
	
//visualizzazione di default di tutti gli utenti nel database
$sql0="SELECT NOME_GIOCATORE,COGNOME,DATA_DI_NASCITA,EMAIL,NUMERO_DI_TELEFONO,USERNAME,DATA_PRENOTAZIONE,ORARIO,PREZZO,SERVIZIO_BAR,RICHIESTE_AGGIUNTIVE 
FROM GIOCATORE INNER JOIN POSTAZIONE ON POSTAZIONE.ID_GIOCATORE=GIOCATORE.ID_GIOCATORE";

$result0=mysqli_query($conn,$sql0);

if (mysqli_num_rows($result0)>0) {
	
while($row=mysqli_fetch_assoc($result0)){
echo "<tr>";
echo"<td>".$row["USERNAME"]."</td>";
echo"<td>".$row["NOME_GIOCATORE"]."</td>";
echo"<td>".$row["COGNOME"]."</td>";
echo"<td>".$row["DATA_DI_NASCITA"]."</td>";
echo"<td>".$row["EMAIL"]."</td>";
echo"<td>".$row["NUMERO_DI_TELEFONO"]."</td>";
echo"<td>".$row["DATA_PRENOTAZIONE"]."</td>";
echo"<td>".$row["ORARIO"]."</td>";
echo"<td>".$row["PREZZO"]."</td>";
echo"<td>".$row["SERVIZIO_BAR"]."</td>";
echo"<td>".$row["RICHIESTE_AGGIUNTIVE"]."</td>";
echo "</tr>";
}
}
}


mysqli_close($conn);

?>
</table>



</body>

</html>