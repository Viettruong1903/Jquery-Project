<?php
//include db
include("mysql_connect.php");
// Get the genre from the AJAX request
$genre = isset($_POST['displayvalue']) ? $_POST['displayvalue'] : '';

// Prepare the SQL statement
$sql = "SELECT title, description FROM music_type WHERE title LIKE ?";
$stmt = $con->prepare($sql);
$searchTerm = '%' . $genre . '%'; // Using wildcard search
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

// Check if we have results
if ($result->num_rows > 0) {
  // Output data for each row
  while ($row = $result->fetch_assoc()) {
    echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
    echo "<p>" . htmlspecialchars($row['description']) . "</p>";
  }
} else {
  echo "<p>No results found for genre: " . htmlspecialchars($genre) . "</p>";
}

// Close connection
$stmt->close();
$con->close();
?>