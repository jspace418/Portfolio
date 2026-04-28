<?php 
include 'includes/header.php'; 
include 'db_connect.php';
?>

<h2> Insert New Customer </h2>

<form method="POST">
    <label> First Name: </label> <input type="text" name="firstname" required> <br>
    <label> Last Name: </label> <input type="text" name="lastname" required> <br>
    <label> City: </label> <input type="text" name="city" required> <br>
    <label> Phone Number: </label> <input type="text" name="phonenumber" maxlength="10" required> <br>
    <label> Agent: </label>
    <select name="agentID" required>
        <option value=""> Select </option>
        <?php
        $res = $conn->query("SELECT agentID, firstname, lastname FROM agent");
        while($row = $res->fetch_assoc()) {
            echo "<option value='{$row['agentID']}'> {$row['firstname']} {$row['lastname']} </option>";
        }
        ?>
    </select> <br>
    <input type="submit" name="submit" value="Add Customer">
</form>

<?php
// When Submit button is clicked
if(isset($_POST['submit'])) {
    // Entered variables
    $first = $_POST['firstname'];
    $last = $_POST['lastname'];
    $city = $_POST['city'];
    $phone = $_POST['phonenumber'];
    $agent = $_POST['agentID'];

    // SQL - set customer ID automatically
    $res = $conn->query("SELECT MAX(cusID) AS maxID FROM customer");
    $row = $res->fetch_assoc();
    $newID = $row['maxID'] ? chr(ord($row['maxID'][0])) . (intval(substr($row['maxID'],1)) + 1) : 'A1';

    // Prepare SQL - insert into customer table
    $stmt = $conn->prepare("INSERT INTO customer (cusID, firstname, lastname, city, phonenumber, agentID) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $newID, $first, $last, $city, $phone, $agent);
    
    if($stmt->execute()) {
        echo "<p class='success'> Customer added successfully with ID: $newID </p>";
    }
    else {
        echo "<p class='error'> Error: " . $conn->error . "</p>";
    }
}
$conn->close();
?>

<?php 
include 'includes/footer.php';
?>
