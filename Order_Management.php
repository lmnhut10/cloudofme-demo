<?php
    if(isset($_SESSION['admin']) && $_SESSION['admin']==1)
    {
?> 
        <!-- Bootstrap --> 
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script>
            function deleteConfirm() {
                if(confirm("Are you sure to delete?")) {
                    return true;
                }
                else {
                    return false;
                }
            }
        </script> 
        <?php
            include_once("connection.php");
            if(isset($_GET["function"])=="del") {
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                    pg_query( "DELETE FROM order WHERE orderid='$id'");
                } 
            }
        ?>
            <form name="frm" method="post" action="">
            <h1>Order</h1>
            <p>
            <img src="images/add.png" alt="Add new" width="16" height="16" border="0" />
            <a href="?page=add_order"> Add</a>
            </p>
            <table id="tableorder" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Order ID</strong></th>
                    <th><strong>User Name</strong></th>
                    <th><strong>Payment</strong></th>
                    <th><strong>Delivery_loca</strong></th>
                    <th><strong>Deliverydate</strong></th>
                    <th><strong>Orderdate</strong></th>
                    
                </tr>
             </thead>

            <tbody>
            <?php
                include_once("connection.php");
                $No=1;
                $result = pg_query( "SELECT * FROM order");
                while($row=pg_fetch_array($result))
                {
            ?>
            <tr>
              <td class="cotCheckBox"><?php echo $No; ?></td>
              <td><?php echo $row["orderid"]; ?></td>
              <td><?php echo $row["username"]; ?></td>
              <td style='text-align:center'> <a href="?page=update_order&&id=<?php echo $row["orderid"]; ?>">
              <img src='images/edit.png' border='0' /></td>
              <td style='text-align:center'>
              <a href="?page=order_management&&function=del&&id=<?php echo $row["orderid"]; ?>" onclick="return deleteConfirm()">
              <img src='images/delete.png' border='0' /></a></td>
            </tr>
            <?php
                $No++;
                }
            ?>
            </tbody>
        </table>  
        
        
        
        <div class="row" style="background-color:#FFF">
            <div class="col-md-12">
                
            </div>
        </div>
         </form>
 <?php
  
?>
<?php
    }
    else{
        echo '<script>alert("You are not administrator")</script>';
        echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
    }
?>
