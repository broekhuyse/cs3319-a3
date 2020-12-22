<!-- Function to display UWO courses that have equivalents. Results exist inside a dropdown menu. -->
<?php
  $query = "SELECT course.courseCode, university.officialName, university.universityID AS uid FROM course INNER JOIN university ON course.universityID = university.universityID";
  $result = mysqli_query($connection,$query);
  if (!$result) {
    die("Database query failed.");
  }
  while ($row = mysqli_fetch_assoc($result)) {
     echo "<option value=\" " . $row["courseCode"] . "," . $row["uid"] . "\">" . $row["courseCode"] . " - " . $row["officialName"] . "</option>";
    }
  mysqli_free_result($result);
?>