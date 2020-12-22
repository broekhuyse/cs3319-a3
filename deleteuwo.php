<!-- Deletes a UWO course -->
<?php
    include 'connecttodb.php';
    if (isset($_POST["uwoCoursesDelete"])) {
        $course = trim($_POST["uwoCoursesDelete"]);
        $query = "DELETE FROM uwo WHERE courseNum = '$course'";
        if (!mysqli_query($connection,$query)) {
            die("Database query failed.");
            echo $query;
        } else {
            mysqli_query($connection,$query);
            $course = '';
        }
    }
?>