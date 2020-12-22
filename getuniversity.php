<!-- Supplies university names inside a dropdown. Value is their ID, used later for $_POST -->
<?php
  $query = "SELECT * FROM university ORDER BY province ASC";
  $result = mysqli_query($connection,$query);
  if (!$result) {
    die("Database query failed.");
  }
  while ($row = mysqli_fetch_assoc($result)) {
     echo "<option value=\" " . $row["universityID"] . "\">" . $row["officialName"] . "</option>";
    }
  mysqli_free_result($result);
?>