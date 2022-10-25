<?php
    if(isset($_SESSION['admin']) && $_SESSION['admin']==1)
    {
?> 
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script>
        function deleteConfirm() {
            if(confirm("Do you want delete it?")) {
                return true;
            }
            else {
                return false;
            }
        }
        </script>
        <form name="frm" method="post" action="">
        <h1>Product Management</h1>
        <p>
        <img src="images/add.png" alt="Add new" width="20" height="20" border="0" /> 
        <a href="?page=add_product"> Add </a>  
    </p>  
        <table id="tableproduct" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>No.</strong></th>
                    <th><strong>Product ID</strong></th>
                    <th><strong>Product Name</strong></th>
                    <th><strong>Price</strong></th>
                    <th><strong>Quantity</strong></th>
                    <th><strong>Category ID</strong></th>
                    <th><strong>Image</strong></th>
                    <th><strong>Edit</strong></th>
                    <th><strong>Delete</strong></th>
                </tr>
             </thead>

            <tbody>
        <?php
        include_once("connection.php");
        if(isset($_GET["function"])=="del")
        {
            if(isset($_GET["id"]))
            {
                $id=$_GET["id"];
                pg_query( "DELETE FROM product WHERE product_id='$id'");
            }
        }
        $No=1;
                $result = pg_query( "SELECT product_id, product_name, price, pro_qty, pro_image, cat_name
                FROM product a, category b 
                WHERE a.cat_id = b.cat_id ORDER BY prodate DESC");
            
                while($row=pg_fetch_array($result)) {
        ?>
        <tr>
              <td ><?php echo $No; ?></td>
              <td ><?php echo $row["product_id"]; ?></td>
              <td><?php echo $row["product_name"];  ?></td>
              <td><?php echo $row["price"]; ?></td>
              <td ><?php echo $row["pro_qty"]; ?></td>
              <td><?php echo $row["cat_name"]; ?></td>

             <td align='center' class='cotfunction button'>
                 <img src='product-imgs/<?php echo $row['pro_image']?>' border='0' width="50" height="50"  /></td>
             <td align='center' class='cotfunction button'> <a href="?page=update_product&&id=<?php echo $row["product_id"]; ?>">
             <img src='images/edit.png' border='0'/></a></td>
             <td align='center' class='cotfunction button'> 
             <a href="?page=product_management&&function=del&&id=<?php echo $row["product_id"]; ?>" 
             onclick="return deleteConfirm()">
             <img src='images/delete.png' border='0' /></a></td>
            </tr>
            <?php
                    $No++;
                }
            ?>
            </tbody>
        </table>
</form>
<?php
   }
    else
    {
        echo '<script>alert("You need to register an account to login")</script>';
        echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
    }
?>
