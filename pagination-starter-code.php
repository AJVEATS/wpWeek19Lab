<?php

$totalItemsRequired = 8;  /* Set total rows/items to show (aka the page size). This will be used 
 * to work out how many pages of results we'll have and it'll also be used later with the MySQL 
 * LIMIT clause to only retrieve the set amount of rows we require. */

/* First use a query to get the total number of rows in the table. There is no limit used 
 * here as we need to find all rows to count them. This does mean we query the table twice 
 * but there is no easy way around this. */
$query = "SELECT * FROM fruits";
$result = mysqli_query($connection, $query);

if ($result == false) { // If database query failed
    echo "<p>Selecting all fruits failed.</p>";
} else { // If database query was successful
    $totalRecords = mysqli_num_rows($result); // Get the total amount of records in the database

    $totalPages = ceil($totalRecords / $totalItemsRequired); // Work out how many pages we need
                    
    // Output pagination links
    echo "<p>Page: ";
    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<a href='?page=" . $i . "'>" . $i . "</a> ";
    }
    echo "</p>";

    // See if we have a page number as a GET variable
    if (isset($_GET['page'])) {
        $currentPageNum = $_GET['page'];

        /* Work out the offset for specifying where to start/offset retrieving rows/results from */
        $offset = ($currentPageNum - 1) * $totalItemsRequired;

        /* Select the required rows using the LIMIT clause, both an offset and total amount of 
         * items to retrieve are specified. We have worked out the offset (where to start/offset 
         * retrieving rows/results from) based on the page we are on and we have specified the 
         * amount of rows we wish to retrieve (the limit/number of the results to return). */
        $query = "SELECT * FROM fruits "
                . "LIMIT " . $offset . ", " . $totalItemsRequired;
        $result = mysqli_query($connection, $query);

        if ($result == false) { // If database query failed
            echo "<p>Selecting subset (page) of fruits failed.</p>";
        } else { // If database query was successful
            // Output the results (this page of items)
            echo "<ul>";
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo "<li>" . $row["name"] . ", " . $row["origin"] . ", " . $row["stock"] . "</li>";
            }
            echo "</ul>";
        }
    } else { // If we do not have a page number specified in a GET variable then we need to 
        // fallback to a default position (show the first page in this case)
        
        // TO DO: By default, when no page is specified the first 8 records should be displayed.
        // Therefore, you need to add code to do this.	
    }
}
?>