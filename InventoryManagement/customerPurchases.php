<?php
include 'includes/header.php';
include 'db_connect.php';
?>

<h2> Customers Purchase Details </h2>

<!-- Dropdown list of Customers -->
<form method='GET'>
    <label> Select Customers: </label>
    <select name='cusID' required>
        <option value=''> Select </option>

<?php
$res = $conn->query("SELECT cusID, firstname, lastname FROM customer ORDER BY lastname ASC");

while($row = $res->fetch_assoc()) {
    $selected = (isset($_GET['cusID']) && $_GET['cusID'] == $row['cusID']) ? "selected" : "";
    echo "<option value='{$row['cusID']}' $selected>{$row['lastname']}, {$row['firstname']} ({$row['cusID']})</option>";
}

echo "</select>";
echo "<input type='submit' value='View Purchases'>";
echo "</form>";
?>

<!-- Show Purchases -->
<?php
if(isset($_GET['cusID'])) {
    $cid = $_GET['cusID'];

    // Get customer full name
    $cust = $conn->query("SELECT firstname, lastname FROM customer WHERE cusID='$cid'")->fetch_assoc();
    echo "<h3>Purchases for {$cust['firstname']} {$cust['lastname']}</h3>";

    $query = "
        SELECT p.description, p.cost, pr.quantity, (p.cost * pr.quantity) AS total
        FROM purchases pr
        JOIN product p ON pr.prodID = p.prodID
        WHERE pr.cusID = '$cid'
    ";

    $result = $conn->query($query);

    if($result->num_rows == 0) {
        echo "<p class='error'>This customer has no purchases.</p>";
    }
    else {
        echo "<table>
                <tr>
                    <th>Description</th>
                    <th>Cost per Item</th>
                    <th>Quantity</th>
                    <th>Total Spent</th>
                </tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['description']}</td>
                    <td>\${$row['cost']}</td>
                    <td>{$row['quantity']}</td>
                    <td>\$" . number_format($row['total'], 2) . "</td>
                  </tr>";
        }
        echo "</table>";
    }
}

$conn->close();
?>

<?php
include 'includes/footer.php';
?>
