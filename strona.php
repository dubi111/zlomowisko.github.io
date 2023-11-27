<!DOCTYPE html>
<html>
<meta charset="utf-8">
<link href="styl.css" rel="stylesheet">
<head>
<title>Zlomek</title>
</head>
<body>

<div class="naglowek">
<img src="zlom.jpg"  alt="zlomiarze">
<h2>OGŁOSZENIA PRIORYTETOWE (tanio!)</h2>
</div>

<div class="podstrony">
<a href="strona.php" class="dodawanie" style="margin-right: 1000px;">Dodawanie Ogłoszenia</a>
<a href="ogloszenia.php" class="oferty" >Oferty</a>

</div>





<div class="glowna">
 <form method="POST" action="#">
<label for="oferta">Numer oferty:</label>
<input type="text" name="oferta" required>
 <br>
<label for="marka">Marka:</label>
<input type="text" name="marka" required>
<br>
<label for="model">Model:</label>
<input type="text" name="model" required>
<br>
<label for="rok">Rocznik:</label> 
<select name="rok" required>
<?php
$currentYear = date("Y");
  for ($i = $currentYear; $i >= $currentYear - 20; $i--) {
echo "<option value=\"$i\">$i</option>";
}
?>
 </select><br>
<label for="stan">Stan:</label>
<input type="radio" name="stan" value="uszkodzony" required> Uszkodzony
<input type="radio" name="stan" value="nieuszkodzony"> Nieuszkodzony
<br>
<label for="obraz">Link do zdjęcia:</label>
<input type="text"  name="obraz" required >
<br>
<input type="submit" value="Dodaj ogłoszenie">
    </form>
<?php
if (isset($_SESSION['ogloszenie_dodane']) && $_SESSION['ogloszenie_dodane']) {
    echo "Ogłoszenie dodane pomyślnie";
    unset($_SESSION['ogloszenie_dodane']); 
}
?>
	<br>
	<br>
	<br>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zlomowisko";

$conn = new mysqli($servername, $username, $password, $dbname);

$oferta = isset($_POST['oferta']) ? $_POST['oferta'] : '';
$marka = isset($_POST['marka']) ? $_POST['marka'] : '';
$model = isset($_POST['model']) ? $_POST['model'] : '';
$rok = isset($_POST['rok']) ? $_POST['rok'] : '';
$stan = isset($_POST['stan']) ? $_POST['stan'] : '';
$obraz = isset($_POST['obraz']) ? $_POST['obraz'] : '';
if(isset($_POST["oferta"]) and isset($_POST["marka"])and ($_POST["model"])and isset($_POST["rok"]) and isset($_POST["stan"]) and isset($_POST["obraz"])){
$sql = "INSERT INTO oferty (ID_oferty,marka, model, rok, stan, obraz) VALUES ('$oferta','$marka', '$model', '$rok', '$stan', '$obraz')";
 if ($conn->query($sql) === TRUE) {
        $_SESSION['ogloszenie_dodane'] = true; 
  header("Location: ogloszenia.php"); 
        exit;
    } else {
        echo "Błąd podczas dodawania ogłoszenia do bazy danych: " . $conn->error;
    }
}
$conn->close();
?>
<br>
<div class="inne">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zlomowisko";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

  $sql = "SELECT * FROM oferty";
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
echo "<div class='inne'>";
echo "<img width='400' src='". $row['obraz']. "' alt='" . $row['marka'] . " " . $row['model'] . "'>";
echo "<p><strong>Marka:</strong> " . $row['marka'] . "</p>";
echo "<p><strong>Model:</strong> " . $row['model'] . "</p>";
echo "<p><strong>Rocznik:</strong> " . $row['rok'] . "</p>";
echo "<p><strong>Stan:</strong> " . $row['stan'] . "</p>";
echo "</div>";
                }
} else {
  echo "Brak ofert.";
}

 $conn->close();
?>
</div>

<footer class="stopka">U siebie rób jak u siebie<footer>
</body>
</html>