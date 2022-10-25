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
                    pg_query( "DELETE FROM supplier WHERE supplierid='$id'");
                } 
            }
        ?>
            <form name="frm" method="post" action="">
            <h1>Supplier</h1>
            <p>
            <img src="images/add.png" alt="Add new" width="16" height="16" border="0" />
            <a href="?page=add_supplier"> Add</a>
            </p>
            <table id="tablesupplier" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Supplier ID</strong></th>
                    <th><strong>Supplier Name</strong></th>
                    <th><strong>Address</strong></th>
                    
                </tr>
             </thead>

            <tbody>
            <?php
                include_once("connection.php");
                $No=1;
                $result = pg_query( "SELECT * FROM supplier");
                while($row=pg_fetch_array($result))
                {
            ?>
            <tr>
              <td class="cotCheckBox"><?php echo $No; ?></td>
              <td><?php echo $row["supplierid"]; ?></td>
              <td><?php echo $row["suppliername"]; ?></td>
              <td style='text-align:center'> <a href="?page=update_supplier&&id=<?php echo $row["supplierid"]; ?>">
              <img src='images/edit.png' border='0' /></td>
              <td style='text-align:center'>
              <a href="?page=supplier_management&&function=del&&id=<?php echo $row["supplierid"]; ?>" onclick="return deleteConfirm()">
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
