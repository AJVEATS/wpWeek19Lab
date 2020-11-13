<doctype html>
<html>
<head>

</head>
<body>
<?php 
    include "mySQLi-connection.php";

    $query_string = "SELECT * from products;";
    $result = mysqli_query($connection, $query_string);
    if(!$connection) {
        echo "<p>Initalising MySQLi failed</p>";
    } else {
        
        while($row = mysqli_fetch_assoc($result)) {
            echo "<ul>";
            echo "<li>".$row['id']."</li>";
            echo "<li>".$row['name']."</li>";
            echo "<li>".$row['description']."</li>";
            echo "<li>".$row['price']."</li>";
            echo "<li>".$row['cost_price']."</li>";
            echo "<li>".$row['stock']."</li>";
            echo "<li>".$row['ean']."</li>";
            echo "</ul>";
        }
    }
?>
<h1>Product management console</h1>
    <div>
        <h2>Add a new product or edit a product from the catalogue</h2>
        <form action="task2.php" method="POST">
            <label>Enter product's name:<label>
            <input type="text" name="name"><br>
            <label>Enter product's description:<label>
            <input type="text" name="description"><br>
            <label>Enter product's price:<label>
            <input type="text" name="price"><br>
            <label>Enter product's cost price</label>
            <input type="text" name="costPrice"><br>
            <label>Enter product's stock</label>
            <input type="text" name="stock"><br>
            <label>Enter product's EAN</label>
            <input type="text" name="EAN"><br>
            <input type="submit" name="addSubmit" value="Add product">
            <input type="submit" name="updateSubmit" value="Edit product">
            <button type="reset">Clear form</button>
       </form>
    </div>

<?php
    if (isset($_POST['addSubmit'])) {
        $productName = $_POST['name'];
        $productDescription = $_POST['description'];
        $productPrice = $_POST['price'];
        $productCostPrice = $_POST['costPrice'];
        $productStock = $_POST['stock'];
        $productEAN = $_POST['EAN'];

        $add_query_string = "INSERT INTO products(name, description, price, cost_price, stock, ean) VALUES ('$productName', '$productDescription', '$productPrice', '$productCostPrice', '$productStock', '$productEAN');";

        if (mysqli_query($connection, $add_query_string)) {
            echo '<script>console.log("user added");</script>';
        }

        echo "<h3>The product '$productName' has been added to the product catalogue.</h3>
            <h3>The product are:</h3>
            <ul>
                <li>ID: $nextId</li>
                <li>Name: $productName</li>
                <li>Description: $productDescription</li>
                <li>Price: $productPrice</li>
                <li>Cost price: $productCostPrice</li>
                <li>Stock: $productStock</li>
                <li>EAN: $EAN</li>
            </ul>";
    } 

    if (isset($_POST['updateSubmit'])) {
        $editProductName = $_POST['productName'];
        $editProductDescription = $_POST['productDescription'];
        $editProductPrice = $_POST['productPrice'];
        $editProductCostPrice = $_POST['productCostPrice'];

        echo "<h3>The product '$editProductName' has been updated in the product catalogue.</h3>
        <h3>The new product detail are:</h3>
        <ul>
            <li>Name: $editProductName</li>
            <li>Description: $editProductDescription</li>
            <li>Price: $editProductPrice</li>
            <li>Cost Price: $editproductCostPrice</li>
        </ul>";
    }
?>
<?php 
    mysqli_close($connection);
?>
</body>
</html>