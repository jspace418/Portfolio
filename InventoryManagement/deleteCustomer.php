<?php 
include 'includes/header.php';
include 'db_connect.php'; 
?>

<h2> Delete Customer </h2>

<form method="POST">
  <label> Select Customer: </label>
  <select name="cusID" required>
    <option value=""> Select </option>
    <?php
      $res = $conn->query("SELECT cusID, firstname, lastname FROM customer");
      while($row = $res->fetch_assoc()) {
        echo "<option value='{$row['cusID']}'> {$row['firstname']} {$row['lastname']} ({$row['cusID']}) </option>";
      }
    ?>
  </select>
  <input type="submit" name="delete" value="Delete">
</form>

<?php
// Same stuff as insertCustomer.php, but it's deleting
// See insertCustomer.php for details
if(isset($_POST['delete'])) {
    $cid = $_POST['cusID'];
    $check = $conn->query("SELECT * FROM purchases WHERE cusID='$cid'");
    
    if($check->num_rows > 0) {
        echo "<p class='error'> Error: Cannot delete customer with existing purchases. </p>";
    }
    else {
        $conn->query("DELETE FROM customer WHERE cusID='$cid'");
        echo "<p class='success'> Customer deleted successfully. </p>";
    }
}
$conn->close();
?>

<?php
include 'includes/footer.php';
?>
