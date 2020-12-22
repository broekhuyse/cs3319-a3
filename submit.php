<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&display=swap" rel="stylesheet">
<link href="style.css" rel="stylesheet">
<script src="uwo.js"></script>
<!-- Functionality for submits, since each form is 'submitted' even though only one may have been altered. $_POST cannot handle it. -->
<?php
include 'connecttodb.php';
/* Checks if the university courses form was submitted, and displays appropriate data */
if(isset($_POST['uniID'])) {
    $sortValue = $_POST['uniID'];
    $query = "SELECT * FROM course WHERE universityID = $sortValue";
    $uniQuery = "SELECT * FROM university WHERE universityID = $sortValue";
    $result = mysqli_query($connection,$query);
    $uniResult = mysqli_query($connection,$uniQuery);
    $uniRow = mysqli_fetch_assoc($uniResult);
    if (!$result || !$uniResult) {
        die("databases query failed.");
    }
    echo "<h3>University Information:</h3>" . $uniRow["officialName"] . " \"" . $uniRow["nickname"] . "\"" . " - " . $uniRow["city"] . ", " . $uniRow["province"];
    echo "<ul style=\"list-style-type:none\">";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . $row["courseCode"] . ": " . $row["courseName"] . ", Year: " . $row["courseYear"] . " [" . $row["courseWeight"] . "]" . "</li>";
    }
    echo "</ul>";
    mysqli_free_result($result);
}
/* Checks if the UWO course form was selected, and sorts courses accordingly */
if(isset($_POST['uwosort'])) {
    $sortValue = $_POST['uwosort'];
    if ($sortValue == 0) {
      $query = "SELECT * FROM uwo";
    } elseif ($sortValue == 1) {
      $query = "SELECT * FROM uwo ORDER BY courseNum ASC";
    } elseif ($sortValue == 2) {
        $query = "SELECT * FROM uwo ORDER BY courseNum DESC";
    } elseif ($sortValue == 3) {
        $query = "SELECT * FROM uwo ORDER BY courseName ASC";
    } else {
        $query = "SELECT * FROM uwo ORDER BY courseName DESC";
    }
    $result = mysqli_query($connection,$query);
    if (!$result) {
      die("databases query failed.");
    }
    echo "<ul style=\"list-style-type:none\">";
    while ($row = mysqli_fetch_assoc($result)) {
       echo "<li>" . $row["courseNum"] . " " . $row["courseName"] . " " . $row["courseSuffix"] . " [" . $row["courseWeight"] . "]" . "</li>";
    }
    echo "</ul>";
    mysqli_free_result($result);
}
/* Checks which province was selected, and displays all universities and their nicknames that reside in said province */
if(isset($_POST['uniProvince'])) {
    $sortValue = $_POST['uniProvince'];
    $query = "SELECT * FROM university WHERE province = '$sortValue'";
    $result = mysqli_query($connection,$query);
    if (!$result) {
        die("Database query failed.");
    }
    echo "<h3>Universities in " . $sortValue . ":</h3>";
    echo "<ul style=\"list-style-type:none\">";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . $row["officialName"] . ", \"" . $row["nickname"] . "\"</li>";
    }
    echo "</ul>";
    mysqli_free_result($result);
}
/* Finds what courses are equivalent to selected UWO course and displays its information, the other course's information, and university name. */
if(isset($_POST['uwoEquiv'])) {
    $sortValue = trim($_POST['uwoEquiv']);
    $temp = "SELECT * FROM uwo WHERE courseNum = '$sortValue'";
    $query = "SELECT uwo.courseNum, uwo.courseName AS uwoName, uwo.courseWeight AS uwoWeight, course.courseCode AS otherCode, course.courseName AS otherName, course.courseWeight AS otherWeight, university.officialName, equivalentCourses.dateEnacted FROM uwo
    INNER JOIN equivalentCourses ON equivalentCourses.uwoCourse = uwo.courseNum
    INNER JOIN course ON equivalentCourses.otherCourse = course.courseCode
    INNER JOIN university ON university.universityID = equivalentCourses.universityID
    AND university.universityID = course.universityID
    WHERE uwo.courseNum = '$sortValue'";
    $tempResult = mysqli_query($connection,$temp);
    $result = mysqli_query($connection,$query);
    $row = mysqli_fetch_assoc($tempResult);
    if (!$result) {
        die("Database query failed.");
    }
    echo "<h3>Courses Equivalent to UWO Course ". $sortValue . ":</h3><h4>" . $row["courseNum"] . ": " . $row["courseName"] . ", [" . $row["courseWeight"] .  "]</h4><ul style=\"list-style-type:none\">";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . $row["otherCode"] . ", \"" . $row["otherName"] . "\" [" . $row["otherWeight"] . "] - " . $row["officialName"] . ". Made equivalent on " . $row["dateEnacted"] . ".</li>";
    }
    echo "</ul>";
    mysqli_free_result($result);
}
/* Checks courses made equivalent on/before date of user's choice */
if(isset($_POST['dateCheck'])) {
    $sortValue = $_POST['dateCheck'];
    $query = "SELECT uwo.courseNum, uwo.courseName AS uwoName, uwo.courseWeight AS uwoWeight, course.courseCode AS otherCode, course.courseName AS otherName, course.courseWeight AS otherWeight, university.officialName, equivalentCourses.dateEnacted FROM uwo
    INNER JOIN equivalentCourses ON equivalentCourses.uwoCourse = uwo.courseNum
    INNER JOIN course ON equivalentCourses.otherCourse = course.courseCode
    INNER JOIN university ON university.universityID = equivalentCourses.universityID
    AND university.universityID = course.universityID
    WHERE equivalentCourses.dateEnacted <= '$sortValue'";
    $result = mysqli_query($connection,$query);
    if (!$result) {
        die("Database query failed.");
    }
    echo "<h3>Courses Deemed Equivalent On/Before " . $sortValue . ":</h3>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<ul style=\"list-style-type:none\">";
        echo "<li>UWO Course: " . $row["courseNum"] . ", \"" . $row["uwoName"] . "\" [" . $row["uwoWeight"] . "]</li>";
        echo "<li>Equivalent Course: " . $row["otherCode"] . ", \"" . $row["otherName"] . "\" [" . $row["otherWeight"] . "] - " . $row["officialName"] . "</li>";
        echo "<li>Made equivalent on: " . $row["dateEnacted"] . ".</ul>";
    }
    mysqli_free_result($result);
}
/* Creating a new equivalency (or updating date of existing) */
if(isset($_POST['outsideCourse'])) {
    $otherCourse = $_POST['outsideCourse']; 
    $courseInfo = explode(",", $otherCourse); /* Splitting the <option> value into course and universityID */
    $courseInfo[0] = trim($courseInfo[0]);
    $uwoCourse = trim($_POST['uwoCourse']);
    $uid = intval($courseInfo[1]); /* Turn string into integer for SQL query */

    $checkExisting = "SELECT * FROM equivalentCourses WHERE otherCourse = '$courseInfo[0]' AND uwoCourse = '$uwoCourse'";
    $check = mysqli_query($connection,$checkExisting);
    $count = mysqli_num_rows($check);

    $date = date("Y-m-d");

    if ($count == 0) {
        $query = "INSERT INTO equivalentCourses (universityID, uwoCourse, otherCourse, dateEnacted, approvalName) VALUES ($uid, '$uwoCourse', '$courseInfo[0]', '$date', 'Test')";
        echo $query;
    } else {
        $query = "UPDATE equivalentCourses SET dateEnacted = '$date' WHERE equivalentCourses.otherCourse = '$courseInfo[0]' AND equivalentCourses.uwoCourse = '$uwoCourse'";
        echo $query;
    }
    $result = mysqli_query($connection,$query);
    if (!$result) {
        die("Database query failed.");
    }
}
/* Associating an image with a university */
if(isset($_POST['uniimage'])) {
    $uni = trim($_POST['uniimage']); 
    $checkExisting = "SELECT uniimage FROM university WHERE universityID = '$uni'"; /* Check if university already has an image associated with it */
    $check = mysqli_query($connection,$checkExisting);
    $row = mysqli_fetch_assoc($check);

    if (empty($row['uniimage'])) { /* If there is no image link, supply a form to enter one */
        echo "<form method=\"POST\" action=\"uniimage.php\">
                <label for=\"imageurl\">Image URL:</label><br>
                <input type=\"hidden\" id=\"uid\" name=\"uid\" value=\"" . $uni . "\">
                <input type=\"text\" id=\"imageurl\" name=\"imageurl\" oninput=\"imageCheck()\"><br><br>
                <button type=\"submit\" id=\"addImage\" disabled>Create</button>
              </form>";
    } else { 
        echo "<img src=\"" . $row['uniimage'] . "\" style=\"max-width:300px\"/>";
    }
}
mysqli_close($connection); /* Closes mySQL connection upon finishing query */
?>
<div>
<a href="index.php">Return</a>
</div>