
<link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
 <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<?php
include '../databaseconnection.php';

$queryoverzicht = "SELECT * FROM wedstrijd";
// $result = $conn->query($Contactoverzichtquery);
 





if ($conn->connect_errno) {
    echo "Sorry, this website is experiencing problems.";
    exit;
}

if (!$result = $conn->query($queryoverzicht)) {
    echo "Geen resultaat";
    exit;
}

if ($result->num_rows === 0) {?>
<br>
<div class="alert alert-info">
  Geen Resultaten gevonden
</div>
<a class="btn btn-primary" href="?page=wedstrijd">Nieuwe Wedstrijd</a>
<?php
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
            window.location= 'index.php?wedstrijdid='+Id;
        };
    });



function searchfunction() {
    var input, filter, table, tr, td, i, ii;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("perstable");
    tr = table.querySelectorAll("tbody tr");
    for (i = 0; i < tr.length; i++) {
        var tds = tr[i].getElementsByTagName("td");
        var found = false;
        for (ii = 0; ii < tds.length && !found; ii++) {
            if (tds[ii].textContent.toUpperCase().indexOf(filter) > -1) {
                found = true;
                break;
            }
        }
        tr[i].style.display = found?"":"none";
    }
}

//      https://stackoverflow.com/questions/42763643/search-field-on-multiple-indexes-in-a-html-table-using-java-script
//      https://www.w3schools.com/howto/howto_js_filter_table.asp


</script>
<input type="text" id="myInput" onkeyup="searchfunction()" placeholder="Zoek teams.." class="form-control">
        <table class="table table-hover" id="perstable">
           <thead>
                <tr>
                    <th>Thuis team</th>
                    <th>Uit team</th>      
                    <th>Tijd</th>               
                </tr>
           </thead>
           <tbody>
                <?php 
                    while($row = mysqli_fetch_array($result)){ 
                        //var_dump($row);
                ?>
                        <tr class="row2" data-id="<?php echo $row['WedstrijdID'];?>">
                            <td>
                                <?php echo $row['Thuisteam'];?>
                            </td>
                            <td>
                                <?php echo $row['Uitteam'];?>
                            </td>
                            <td>
                                <?php echo $row['Datum'];?>
                            </td>
                        </a>
                        </tr>
                        <?php          
                    }
                ?>
           </tbody>
        </table>
        <a class="btn btn-primary" href="?page=wedstrijd">Nieuwe Wedstrijd</a>
<?php
}

$row = mysqli_fetch_array($result);


 ?>


