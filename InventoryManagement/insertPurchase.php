<?php
include 'includes/header.php';
include 'db_connect.php';
?>

<h2> Insert / Update Purchase </h2>

<form method="POST">
    <!-- Customer info -->
    <label> Customer: </label>
    <select name="cusID" required>
    <option value=""> Select </option>
    <?php
      $res = $conn->query("SELECT cusID, firstname, lastname FROM customer");
      while($row = $res->fetch_assoc()) {
        echo "<option value='{$row['cusID']}'> {$row['firstname']} {$row['lastname']} </option>";
      }
    ?>
    </select><br>
    
    <!-- Product info -->
    <label> Product: </label>
    <select name="prodID" required>
        <option value=""> Select </option>
        <?php
        $res = $conn->query("SELECT prodID, description FROM product");
        while($row = $res->fetch_assoc()) {
            echo "<option value='{$row['prodID']}'> {$row['description']} </option>";
        }
        ?>
    </select><br>
    
    <!-- Quantity info -->
    <label> Quantity: </label> <input type="number" name="quantity" min="1" required> <br>
    <input type="submit" name="submit" value="Submit">
</form>

<?php
if(isset($_POST['submit'])) {
    $cid = $_POST['cusID'];
    $pid = $_POST['prodID'];
    $qty = intval($_POST['quantity']);

    // Check if the given purchase exists
    $exists = $conn->query("SELECT * FROM purchases WHERE cusID='$cid' AND prodID='$pid'");

    // If a purchase exists, update
    // If it does not exist, insert
    if($exists->num_rows > 0) {
        $conn->query("UPDATE purchases SET quantity = quantity + $qty WHERE cusID='$cid' AND prodID='$pid'");

        echo "<p class='success'> Quantity updated successfully. </p>";
    }
    else {
        $stmt = $conn->prepare("INSERT INTO purchases (cusID, prodID, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $cid, $pid, $qty);
        
        if($stmt->execute()) echo "<p class='success'> Purchase added successfully. </p>";
        else echo "<p class='error'>Error: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

<?php
include 'includes/footer.php';
?>
