<?php
  $query = "SELECT * FROM uwo";
if(isset($_POST["uwosort"])) {
  $sortValue = $_POST["uwosort"];
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
?>