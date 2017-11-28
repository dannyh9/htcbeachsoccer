
<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<?php
include '../databaseconnection.php';

$Contactoverzichtquery = "SELECT FormID, Naam, Email, Timestamp FROM Contactformulier";
// $result = $conn->query($Contactoverzichtquery);
 





if ($conn->connect_errno) {
    // The connection failed. What do you want to do? 
    // You could contact yourself (email?), log the error, show a nice page, etc.
    // You do not want to reveal sensitive information

    // Let's try this:
    echo "Sorry, this website is experiencing problems.";

    // Something you should not do on a public site, but this example will show you
    // anyways, is print out MySQL error related information -- you might log this
    echo "Error: Failed to make a MySQL connection, here is why: \n";
    echo "Errno: " . $conn->connect_errno . "\n";
    echo "Error: " . $conn->connect_error . "\n";
    
    // You might want to show them something nice, but we will simply exit
    exit;
}

// Perform an SQL query
if (!$result = $conn->query($Contactoverzichtquery)) {
    // Oh no! The query failed. 
    echo "Sorry, the website is experiencing problems.";

    // Again, do not do this on a public site, but we'll show you how
    // to get the error information
    echo "Error: Our query failed to execute and here is why: \n";
    echo "Query: " . $Contactoverzichtquery . "\n";
    echo "Errno: " . $conn->errno . "\n";
    echo "Error: " . $conn->error . "\n";
    exit;
}


// Phew, we made it. We know our MySQL connection and query 
// succeeded, but do we have a result?
if ($result->num_rows === 0) {
    // Oh, no rows! Sometimes that's expected and okay, sometimes
    // it is not. You decide. In this case, maybe actor_id was too
    // large? 
    echo "Geen Resultaten gevonden";
    exit;
}
if($result->num_rows > 0){ 
        echo "meer dan 0 resultaat";
?>
        <table class="table table-hover">
           <thead>
              <th>Naam</th>
              <th>Email</th>
              <th>Tijd</th>
           </thead>
           <tbody>
                <?php 
                    while($row = mysqli_fetch_array($result)){ 
                        //var_dump($row);
                        $date = substr($row["Timestamp"],0,16);
                ?>
                        <tr data-id="<?php echo $row['FormID'];?>">
                            <a href="test.php">
                            <td>
                                <?php echo $row['Naam'];?>
                            </td>
                            <td>
                                <?php echo $row['Email'];?>
                            </td>
                            <td>
                                <?php echo $date;?>
                            </td>
                        </a>
                        </tr>
                        <?php          
                    }
                ?>
           </tbody>
        </table>
<?php
}

$row = mysqli_fetch_array($result);

var_dump($row);

 ?>


