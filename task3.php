<doctype html>
<html>
<head>
    <title>Task 3: Sorting</title>
</head>
<body>
<h1>Task 3: Sorting</h1>
<?php 
    include "mySQLi-connection.php";

    $query_string = "SELECT * FROM (SELECT `name`, `origin`, `stock` FROM `fruits` ORDER BY `id` ASC LIMIT 10) t1 ORDER BY 'id';";
    $result = mysqli_query($connection, $query_string);

    while($row = mysqli_fetch_assoc($result)) {

        echo "<ul>";
        echo "<li>".$row['name']."</li>";
        echo "<li>".$row['origin']."</li>";
        echo "<li>".$row['stock']."</li>";
        echo "</ul>";
    }

    mysqli_close($connection);
?>
</body>
</html>