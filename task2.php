<doctype html>
<html>
<head>
    <title>
        Product management console
    </title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>
<?php 
    include "mySQLi-connection.php";

    $query_string = "SELECT * from products;";
    $result = mysqli_query($connection, $query_string);
    if(!$connection) {
        echo "<p>Initalising MySQLi failed</p>";
    } else {
        echo "<h2>All products in the products database</h2>";
        while($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $name = $row['name'];
            echo "<ul>";
            echo "<li>Id: ".$row['id']."</li>";
            echo "<li>Name: ".$row['name']."</li>";
            echo "<li>Description: ".$row['description']."</li>";
            echo "<li>Price: ".$row['price']."</li>";
            echo "<li>Cost price: ".$row['cost_price']."</li>";
            echo "<li>Stock: ".$row['stock']."</li>";
            echo "<li>EAN: ".$row['ean']."</li>";
            echo "<li><a href='?mode=update&id=$id'>Update: ".$name."</a></li>";
            echo "<li><a href='?mode=delete&id=$id'>Delete: ".$name."</a></li>";
            echo "</ul>";
        }
    }
?>
<h1>Product management console</h1>
    <div>
        <h2>Add a new product or edit a product from the catalogue</h2>
        <form action="task2.php" method="POST">
            <label>Product id<label>
            <input type="text" name="id"><br>
            <label>Enter product's name:<label>
            <input type="text" name="name" required><br>
            <label>Enter product's description: <label>
            <input type="text" name="description" required><br>
            <label>Enter product's price:<label>
            <input type="text" name="price" required><br>
            <label>Enter product's cost price</label>
            <input type="text" name="costPrice" required><br>
            <label>Enter product's stock</label>
            <input type="text" name="stock" required><br>
            <label>Enter product's EAN</label>
            <input type="text" name="EAN" required><br>
            <input type="submit" name="addSubmit" value="Add product">
            <input type="submit" name="updateSubmit" value="Edit product">
            <button type="reset" name="resetForm">Clear form</button>
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
                <li>Name: $productName</li>
                <li>Description: $productDescription</li>
                <li>Price: $productPrice</li>
                <li>Cost price: $productCostPrice</li>
                <li>Stock: $productStock</li>
                <li>EAN: $EAN</li>
            </ul>";
    } 

    if (isset($_POST['updateSubmit'])) {
        $editproductID = $_POST['id'];
        $editProductName = $_POST['name'];
        $editProductDescription = $_POST['description'];
        $editProductPrice = $_POST['price'];
        $editProductCostPrice = $_POST['costPrice'];
        $editproductStock = $_POST['stock'];
        $editproductEAN = $_POST['EAN'];

        $edit_query_string = "UPDATE products 
                            SET name = '$editProductName', description = '$productDescription', price = '$editProductPrice', cost_price = '$productCostPrice', stock = '$editproductStock', ean = '$editproductEAN'
                            WHERE id = '$editproductID';";
        
        $result = mysqli_query($connection, $edit_query_string);

        if ($result) {
            echo '<script>console.log("<?php $result ?>");</script>';
            echo '<script>console.log("user updated");</script>';
        }

        echo "<h3>The product '$editProductName' has been updated in the product catalogue.</h3>
        <h3>The new product detail are:</h3>
        <ul>
            <li>id: $editproductID</li>
            <li>Name: $editProductName</li>
            <li>Description: $editProductDescription</li>
            <li>Price: $editProductPrice</li>
            <li>Cost Price: $editproductCostPrice</li>
            <li>Stock: $editproductStock</li>
            <li>EAN: $editproductEAN</li>
        </ul>";
    }
?>
<?php 
    mysqli_close($connection);
?>
</body>
</html>