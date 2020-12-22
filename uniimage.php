<link href="style.css" rel="stylesheet">
<?php
include 'connecttodb.php';
/* Associating an image with a university */
if(isset($_POST['imageurl'])) {
    $image = trim($_POST['imageurl']);
    $uid = trim($_POST['uid']);
    $result = mysqli_query($connection,"UPDATE university SET uniimage = '$image' WHERE universityID = $uid");
    if (!$result) {
        die("Database query failed.");
    } 
    $query = "SELECT officialName, uniimage FROM university WHERE universityID = $uid";
    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($result);
    echo "<h3>Image Inserted for " . $row["officialName"] . ": </h3><img src=\"" . $image . "\" style=\"max-width:300px\"/>";
}
?>
<a href="index.php">Return</a>