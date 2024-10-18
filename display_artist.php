<?php
//include database
include("mysql_connect.php");

//Retrieve the data
$sql = "SELECT * FROM music_artist";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

if ($result->num_rows > 0) {
  while ($row = mysqli_fetch_array($result)) {
    echo "<div>";
    echo "<img src=' " . htmlspecialchars($row["image_path"]) . " alt='Artist Image' '/>";
    echo "<h3>" . htmlspecialchars($row["username"]) . "</h3>";
    echo "<p>" . htmlspecialchars($row["age"]) . "</p>";
    echo "<p>" . htmlspecialchars($row["song_write"]) . "</p>";
    echo "</div>";
  }
} else {
  echo "no artists found";
}
?>