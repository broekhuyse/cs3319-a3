<?php
  $query = "SELECT courseCode FROM course";
  $result = mysqli_query($connection,$query);
  if (!$result) {
    die("Database query failed.");
  }
  while ($row = mysqli_fetch_assoc($result)) {
     echo "<option value=\" " . $row["courseCode"] . "\">" . $row["courseCode"] . "</option>";
    }
  mysqli_free_result($result);
?>