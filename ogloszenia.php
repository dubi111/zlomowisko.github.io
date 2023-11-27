<!DOCTYPE html>
<html>
<meta charset="utf-8">
<link href="styl.css" rel="stylesheet">

<head>
<title>Oferty</title>
</head>
<body>

<div class="naglowek2">
<img src="zlom.jpg"  alt="zlomiarze">
<h2>OGŁOSZENIA PRIORYTETOWE (tanio!)</h2>
</div>

<div class="podstrony2">
<a href="strona.php" class="dodawanie" style="margin-right:1000px;">Dodawanie Ogłoszenia</a>
<a href="ogloszenia.php" class="oferty">Oferty</a>

</div>






<div class="auto">
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
echo "<div class='auto'>";
echo "<img width=\"400\" src='". $row['obraz'] . "' alt='" . $row['marka'] . " " . $row['model'] . "'>";
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