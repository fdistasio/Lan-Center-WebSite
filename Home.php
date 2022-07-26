<html>
<head>

<title>Sala LAN</title>
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
  <li><a class="active" href="Home.php">Home Page</a></li>
  <li><a href="Prenotazione.php">Prenota</a></li>
  <li><a href="AreaRiservata.php">Area Riservata</a></li>
  <li><a href="Relazione.html">Relazione</a></li>
  
</ul>
</div>


<div class="home" align="center">

<h1 class="titolo" align="center">Esport LAN Center</h1><br>
<h3>Sala LAN / LAN Party</h3><br>

La struttura offre 10 postazioni, dotate di pc molto potenti, con cui puoi giocare o usufruirne in qualsiasi modo.<br> 
I videogiochi variano a seconda dei vari computer. Consulta quindi la tabella che segue e <b><a href="Prenotazione.php">prenota</a></b> in base alle tue esigenze.


</div><br>
<table border="1" align="center">
<th>Postazione</th>
<th>Videogiochi</th>
<?php
$sql="SELECT COMPRENDE.ID_POSTAZIONE,group_concat(VIDEOGIOCO.NOME_VIDEOGIOCO  order by VIDEOGIOCO.NOME_VIDEOGIOCO) AS LISTA_GIOCHI
FROM VIDEOGIOCO 
INNER JOIN COMPRENDE ON VIDEOGIOCO.NOME_VIDEOGIOCO=COMPRENDE.NOME_VIDEOGIOCO 
GROUP BY COMPRENDE.ID_POSTAZIONE;
";

$result=mysqli_query($conn,$sql);

if (mysqli_num_rows($result)>0) {
	
while($row=mysqli_fetch_assoc($result)){
echo "<tr>";
echo"<td>".$row["ID_POSTAZIONE"]."</td>";
echo"<td>".$row["LISTA_GIOCHI"]."</td>";
echo"<td>".$row["COGNOME"]."</td>";
echo "</tr>";
}
}



?>

</table><br>
<div class="home" align="center">Puoi inoltre usufruire del nostro servizio bar, se sei interessato specificalo nella <b><a href="Prenotazione.php">prenotazione</a></b>.</div><br>

</body>

</html>