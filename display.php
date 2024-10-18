<?php
// Note that there is NO design in this page (other than embedded tags that will be styled at the master page). No doctype, <head>, <style>, etc.


require("mysql_connect.php");

// DEFAULT QUERY: RETRIEVE EVERYTHING
$result = mysqli_query($con, "SELECT * FROM cd_catalog_class ORDER BY RAND() LIMIT 4") or die(mysqli_error($con));


// FILTERING YOUR DB: On your own....If $_GET vars are present, please use them to filter your DB results (genre, year, decade, label). You can just redefine the previous query.
if (isset($_REQUEST["displayby"])) {
	$displayby = $_REQUEST['displayby'];
} else {
	$displayby = '';
}

if (isset($_REQUEST["displayvalue"])) {
	$displayvalue = $_REQUEST['displayvalue'];
} else {
	$displayvalue = '';
}

//display.php?displayby=genre&displayvalue=jazz
// echo "<h1>$displayby ; $displayvalue</h1>";

if (($displayby != "") && ($displayvalue != "")) {
	$result = mysqli_query($con, "SELECT * FROM cd_catalog_class WHERE $displayby LIKE '$displayvalue' ORDER BY RAND() LIMIT 4") or die(mysqli_error($con));
}

while ($row = mysqli_fetch_array($result)) {
	/// This should out put artist names: On your own....create thumbnail views with images, album names, etc.
	$artist = ($row['artist']);
	$title = ($row['title']);
	$image = ($row['artwork']);

	echo "<div class=\"thisCD\">\n";
	//on your own, grap the artwork (album cover image) and show us the <img>
	echo " <span class=\"displayInfo\">" . $artist . "</span><br />\n";
	echo " <span class=\"displayInfo\">" . $title . "</span><br />\n";
	echo " <img src=\"artwork/thumbs100/$image\" alt=\'$title'><br />\n";



	echo "\n</div>\n";
}

?>