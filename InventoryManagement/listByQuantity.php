<?php
include 'includes/header.php';
include 'db_connect.php';
?>

<h2> List Customers with Purchases Above a Quantity </h2>

<form method="POST">
    <label> Product: </label>
    <select name="prodID" required>
        <option value=""> Select </option>
        <?php
        $res = $conn->query("SELECT prodID, description FROM product");
        while($row = $res->fetch_assoc()) {
            echo "<option value='{$row['prodID']}'> {$row['description']} </option>";
        }
        ?>
    </select>
    
    <label> Minimum Quantity: </label>
    <input type="number" name="minQty" min="1" required>
    <input type="submit" name="view" value="View">
</form>

<?php
if(isset($_POST['view'])) {
    $pid = $_POST['prodID'];
    $min = intval($_POST['minQty']);
    $query = "
      SELECT c.firstname, c.lastname, p.description, pr.quantity 
      FROM purchases pr
      JOIN customer c ON pr.cusID = c.cusID
      JOIN product p ON pr.prodID = p.prodID
      WHERE pr.prodID='$pid' AND pr.quantity > $min";
    
    $res = $conn->query($query);
    if($res->num_rows > 0) {
        echo "<table><tr><th> Name </th><th> Product </th><th> Quantity </th></tr>";
        
        while($row = $res->fetch_assoc()) {
            echo "<tr><td> {$row['firstname']} {$row['lastname']} </td> <td> {$row['description']} </td> <td> {$row['quantity']} </td> </tr>";
        }
        echo "</table>";
    }
    else {
        echo "<p class='error'> No customers found. </p>";
    }
}

$conn->close();
?>

<?php
include 'includes/footer.php';
?>
