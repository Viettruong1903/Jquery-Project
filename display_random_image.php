<?php
// Connect to the database
require("mysql_connect.php");

// Specify the local folder to store images
$localFolder = 'ajax_students/ajax_site/pics/'; // Replace with your desired folder path

// Create the local folder if it doesn't exist
if (!file_exists($localFolder)) {
  mkdir($localFolder, 0777, true);
}

// Retrieve data from the mugallery table
$result = mysqli_query($con, "SELECT image_path, title FROM mugallery ORDER BY RAND() LIMIT 4") or die(mysqli_error($con));

// Check if any rows are returned
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<span class=\"displayInfo\">" . htmlspecialchars($row['title']) . "</span><br />\n";

    // Use image_path instead of image
    $imagePath = $localFolder . htmlspecialchars($row['image_path']); // Assuming the images are stored in the 'pics' folder

    // Copy the image to the local folder
    if (file_exists($imagePath)) {
      if (copy($imagePath, $localFolder . basename($imagePath))) {
        // Ensure the path is correct after copying
        $localImagePath = $localFolder . basename($imagePath);
        echo '<img src="' . htmlspecialchars($localImagePath) . '" alt="' . htmlspecialchars($row['title']) . '" style="width:200px;height:auto;margin:10px;">';
      } else {
        echo '<p class="status error">Failed to copy: ' . htmlspecialchars($row['title']) . '</p>';
      }
    } else {
      echo '<p class="status error">Image not found: ' . htmlspecialchars($row['title']) . '</p>';
    }
  }
} else {
  echo '<p class="status error">Image(s) not found...</p>';
}

// Close the database connection
mysqli_close($con);
?>