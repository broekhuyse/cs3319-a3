<!-- Creates a new UWO course, doesn't let user if course code already exists -->
<?php
    if (isset($_POST["newCourseCode"])) {
        $newCode = trim($_POST["newCourseCode"]);
        $newName = trim($_POST["newCourseName"]);
        $newSuffix = trim($_POST["newCourseSuffix"]);
        $newWeight = trim($_POST["newCourseWeight"]);
        $test = "SELECT * FROM uwo WHERE courseNum = '$newCode'";
        $check = mysqli_query($connection,$test);
        $count = mysqli_num_rows($check);
        if ($count > 0) {
            echo "<p style=\"color:red\">ERROR: This Western course code already exists.</p>";
        } else {
            $query = "INSERT INTO uwo(courseNum, courseName, courseSuffix, courseWeight) VALUES('$newCode', '$newName', '$newSuffix', $newWeight)";
            if (!mysqli_query($connection,$query)) {
                die("Database query failed.");
            } else {
                mysqli_query($connection,$query);
            }
        }
    } 
?>