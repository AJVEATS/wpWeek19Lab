<doctype html>
<?php 
    include "mySQLi-connection.php";

    $query_string = "SELECT * from users;";
    $result = mysqli_query($connection, $query_string);

    mysqli_close($connection);

    if (isset($_POST['search'])) {
        $searchQuery = $_POST['userSearchQuery'];
        $search_query_string = "SELECT 'full_name' FROM users WHERE full_name LIKE '$searchQuery%';";
        //echo $search_query_string;

        $searchResult = mysqli_query($connection, $search_query_string);
        //echo $searchResult;

        if (mysqli_query($connection, $delete_post_string)) {
            echo '<script>console.log("user located");</script>';
        } else {
            echo '<script>console.log("user not located");</script>';
            echo $search_query_string;
        }

        while ($row = mysqli_fetch_assoc($searchResult)) {
            echo "<ul>";
            echo "<li>".$row['full_name']."</li>";
            echo "</ul>"; 
        }
    }
?>
<html>
<head>
    <title>Task 4: User Search</title>
</head>
<body>
<h1>Task 4: User Search</h1>
<?php 
    while($row = mysqli_fetch_assoc($result)) {

        echo "<ul>";
        echo "<li>".$row['full_name']."</li>";
        echo "</ul>";
    }
?>
<form action="" method="POST">
    <input type="text" name="userSearchQuery" required>
    <input type="submit" name="search" value="search🔍">
</form>
</body>
</html>