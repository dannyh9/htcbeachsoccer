
<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
 <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<?php
include '../databaseconnection.php';

$nieuwsartikelquery = "SELECT ArtikelID, Titel , Inhoud FROM Nieuwsartikel";
// $result = $conn->query($Contactoverzichtquery);
 





if ($conn->connect_errno) {
    echo "Sorry, this website is experiencing problems.";
    exit;
}

if (!$result = $conn->query($nieuwsartikelquery)) {
    echo "Geen resultaat";
    exit;
}

if ($result->num_rows === 0) {
    echo "Geen Resultaten gevonden";
    exit;
}
if($result->num_rows > 0){ 
	//meer dan 0 resultaat dus 1 of meer
?>      
  <script type="text/javascript">
   $( document ).ready(function() {

        $('tr.row2').click(linkToOverview);

        function linkToOverview () {
            var Id = $(this).closest('tr').attr('data-id');
            window.location= 'nieuwsartikel.php?id='+Id;
        };
    });
</script>
        <table class="table table-hover">
           <thead>
                <tr>
                    <th>Titel</th>
                    <th>Inhoud</th>
                </tr>
           </thead>
           <tbody>
                <?php 
                    while($row = mysqli_fetch_array($result)){ 
                        //var_dump($row);
                ?>
                        <tr class="row2" data-id="<?php echo $row['ArtikelID'];?>">
                            <td>
                                <?php echo $row['Titel'];?>
                            </td>
                            <td>
                                <?php echo $row['Inhoud'];?>
                            </td>

                        </a>
                        </tr>
                        <?php          
                    }
                ?>
           </tbody>
        </table>
        <a class="btn btn-primary" href="nieuwsartikel.php">nieuw nieuwsartikel</a>
<?php
}

$row = mysqli_fetch_array($result);

var_dump($row);

 ?>

