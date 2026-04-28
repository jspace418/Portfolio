<?php
include 'includes/header.php';
include 'db_connect.php';
?>

<h2> Sort Products </h2>

<form method="GET">
    <label> Sort By: </label>
    <select name="sortby" required>
        <option value="description"> Description </option>
        <option value="cost"> Cost </option>
    </select>

    <label> Order: </label>
    <select name="order" required>
        <option value="ASC"> Ascending </option>
        <option value="DESC"> Descending </option>
    </select>

    <input type="submit" value="Sort">
</form>

<?php
if(isset($_GET['sortby']) && isset($_GET['order'])) {
    $sortby = $_GET['sortby'];
    $order = $_GET['order'];

    $query = "SELECT description, cost, quantityonhand FROM product ORDER BY $sortby $order";
    $res = $conn->query($query);

    echo "<h3>Sorted Results</h3>";
    echo "<table>
            <tr>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity On Hand</th>
            </tr>";

    while($row = $res->fetch_assoc()) {
        echo "<tr>
                <td>{$row['description']}</td>
                <td>\${$row['cost']}</td>
                <td>{$row['quantityonhand']}</td>
              </tr>";
    }
    echo "</table>";
}

$conn->close();
?>

<?php
include 'includes/footer.php';
?>
