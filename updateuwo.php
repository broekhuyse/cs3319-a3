<?php
include 'connecttodb.php';
if(isset($_POST["uwoCourses"])) {
    $courseCode = trim($_POST["uwoCourses"]);
    $query = "";
    if(!empty($_POST["courseName"])) {
        $newName = $_POST["courseName"];
        $query = "UPDATE uwo SET courseName = '$newName' WHERE courseNum = '$courseCode'";
    }
    elseif(!empty($_POST["courseSuffix"])) {
        $newSuffix = $_POST["courseSuffix"];
        $query = "UPDATE uwo SET courseSuffix = '$newSuffix' WHERE courseNum = '$courseCode'";
    }
    elseif(isset($_POST["courseWeight"])) {
        $newWeight = $_POST["courseWeight"];
        $query = "UPDATE uwo SET courseWeight = $newWeight WHERE courseNum = '$courseCode'";
    }
    if (!mysqli_query($connection,$query)) {
        die("Database query failed.");
        echo $query;
    }
    else {
        mysqli_query($connection,$query);
    }
}
?>