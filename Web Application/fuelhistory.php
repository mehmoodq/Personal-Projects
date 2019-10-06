<?php
    session_start();
    include 'Db.php';
    $current_user = $_SESSION['userId'];
?>

<html lang="en">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<?php
require 'header.php';
?>

<style>
html, body {
height: 100%;
}
</style>

<body>

<div class="container h-100 d-flex d-flex justify-content-center">
<div class="jumbotron my-auto">
<h1 class="display-4">Fuel Quote History</h1>
<table class="table">
<thead>
<tr>
<th scope="col">Number</th>
<th scope="col">Gallons Requested</th>
<th scope="col">Delivery Address</th>
<th scope="col">Delivery Date</th>
<th scope="col">Suggested Price</th>
<th scope="col">Total</th>
</tr>
</thead>
<tbody>
<?php
    
    $query = mysqli_query($conn, "SELECT * FROM fuelQuote WHERE userId = '$current_user'")or die(mysqli_error($conn));
    
    $arrVal = array();
    
    $x=0;
    $i=1;
    while ($rowList = mysqli_fetch_array($query)) {
        

        $quote = array(
                      'num' => $i,
                      'gallons'=> $rowList['gallons'],
                      'address'=> $rowList['address'],
                      'deliverydate'=> $rowList['deliverydate'],
                      'suggestedprice'=> $rowList['suggestedprice'],
                      'totalamountdue'=> $rowList['totalamountdue']
                      );
        

        

        array_push($arrVal, $quote);

        $i++;
        $x++;
    }
    foreach($arrVal as &$value){
        ?>
    <tr>
        <?php
        foreach($value as &$index){
        ?>
           <td><?php echo json_encode($index);?></td>
          <?php
        }
        ?>
    </tr>
    <?php
    }
    mysqli_close($conn);
?>    
</tbody>
</table>
</div>
</div>


</body>
</html>