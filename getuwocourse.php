<!-- Gets UWO courses and displays in dropdown. courseNum is the value, used in $_POST -->
<?php
  include 'connecttodb.php';
  $query = "SELECT courseNum FROM uwo";
  $result = mysqli_query($connection,$query);
  if (!$result) {
    die("Database query failed.");
  }
  while ($row = mysqli_fetch_assoc($result)) {
     echo "<option value=\" " . $row["courseNum"] . "\">" . $row["courseNum"] . "</option>";
    }
  mysqli_free_result($result);
?>