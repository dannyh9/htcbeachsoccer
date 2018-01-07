<?php 
    if(!isset($_SESSION['rollid'],$_SESSION['user']) && empty($_SESSION['rollid']) && empty($_SESSION['user'])) {
        exit;
    }
    if($_SESSION['rollid'] != 1) {
        echo "U heeft hiervoor geen rechten";
  exit;
}
?>
<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
 <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<?php
include '../databaseconnection.php';

$Contactoverzichtquery = "SELECT * FROM Contactformulier ORDER BY Timestamp DESC";

if ($conn->connect_errno) {
    echo "Sorry, this website is experiencing problems.";
    exit;

}

// Perform an SQL query
if (!$result = $conn->query($Contactoverzichtquery)) {
    // Oh no! The query failed. 
    echo "Sorry, the website is experiencing problems.";
    exit;
}

// succeeded,
if ($result->num_rows === 0) {
    // Oh, no rows! 
    ?>
    <br>
    <div class="alert alert-info">
      Geen Resultaten gevonden
  </div>
  <?php
}
if($result->num_rows > 0){ 
    //if it has results
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


