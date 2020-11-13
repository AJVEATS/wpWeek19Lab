<doctype html>
<html>
<head>

</head>
<body>
<h1>Getting all users from the database</h1>
<?php 
    include "mySQLi-connection.php";

    $query_string = "SELECT * from users;";
    $result = mysqli_query($connection, $query_string);

    while($row = mysqli_fetch_assoc($result)) {

        echo "<ul>";
        echo "<li>".$row['full_name']."</li>";
        echo "</ul>";
    }

    mysqli_close($connection);
?>
</body>
</html>