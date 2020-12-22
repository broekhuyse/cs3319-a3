<!-- Displays on index.php all universities that do not have courses in the database -->
<?php
    $query = "SELECT * FROM university LEFT JOIN course ON course.universityID = university.universityID WHERE course.universityID IS NULL";
    $result = mysqli_query($connection,$query);
    if (!$result) {
        die("Database query failed.");
    }
    echo "<ul style=\"list-style-type:none\">";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . $row["officialName"] . ", \"" . $row["nickname"] . "\"</li>";
    }
    echo "</ul>";
    mysqli_free_result($result);
?>