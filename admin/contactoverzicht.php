<?php 
    if(!isset($_SESSION['rollid'],$_SESSION['user']) && empty($_SESSION['rollid']) && empty($_SESSION['user'])) {
        exit;
    }
?>
<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
 <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<?php
include '../databaseconnection.php';

$Contactoverzichtquery = "SELECT * FROM Contactformulier ORDER BY Timestamp DESC";
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
    ?>
    <br>
    <div class="alert alert-info">
      Geen Resultaten gevonden
  </div>
  <?php
}
if($result->num_rows > 0){ 
?>      
  <script type="text/javascript">
   $( document ).ready(function() {

        $('tr.row1').click(linkToOverview);

        function linkToOverview () {
            var Id = $(this).closest('tr').attr('data-id');
            window.location= '?contactid='+Id;
        };
    });
</script>
        
<?php


if(isset($_GET["contactid"])){
    $id = mysqli_real_escape_string($conn , $_GET["contactid"]);
    $query = "SELECT * FROM Contactformulier WHERE FormID = '$id'";
    $result = $conn->query($query);
    $row = mysqli_fetch_array($result);
    //var_dump($row);
    ?>
    <div class="container">
        <h2>Naam: </h2>
                <p><?php echo($row["Naam"]) ?></p>

        <h2>Email:</h2>
                <p><?php echo $row["Email"]; ?></p>
                
        <h2> Telefoon: </h2>
        <p>
        <?php
                if(!$row["Telefoonnummer"] == ""){
                    echo $row["Telefoonnummer"];
                 } else {
                    echo ("Niet Bijgevoegd");
                }
            ?>
        </p>
                    
            <h2>bericht:</h2>
                <p><?php echo($row["Bericht"]) ?></p>
    </div>
<?php
} else { 
    ?>
    <table class="table table-hover">
           <thead>
                <tr>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Tijd</th>
                </tr>
           </thead>
           <tbody>
                <?php 
                    while($row = mysqli_fetch_array($result)){ 
                        $date = substr($row["Timestamp"],0,16);
                ?>
                        <tr class="row1" data-id="<?php echo $row['FormID'];?>">
                            <td>
                                <?php echo $row['Naam'];?>
                            </td>
                            <td>
                                <?php echo $row['Email'];?>
                            </td>
                            <td>
                                <?php echo $date;?>
                            </td>
                        </tr>
                        <?php          
                    }
                ?>
           </tbody>
        </table>
        <?php
}
}
$row = mysqli_fetch_array($result);


 ?>


