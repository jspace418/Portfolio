<?php
include 'includes/header.php';
include 'db_connect.php';
?>

<h2> Products Never Purchased </h2>

<?php
$query = "
  SELECT description, quantityonhand 
  FROM product 
  WHERE prodID NOT IN (SELECT DISTINCT prodID FROM purchases)";

$res = $conn->query($query);

if($res->num_rows > 0) {
    echo "<table> <tr> <th> Description </th> <th> Quantity On Hand </th> </tr>";
    
    while($row = $res->fetch_assoc()) {
        echo "<tr> <td> {$row['description']} </td> <td> {$row['quantityonhand']} </td> </tr>";
    }
    echo "</table>";
}
else {
    echo "<p class='error'> All products have been purchased at least once. </p>";
}

$conn->close();
?>

<?php
include 'includes/footer.php';
?>
