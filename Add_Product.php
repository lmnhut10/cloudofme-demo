<?php
    if(isset($_SESSION['admin']) && $_SESSION['admin']==1)
    {
?> 
    <!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<?php
    include_once("connection.php");
    function bind_Category_List($conn) {
	    $sqlstring = "select Cat_ID, Cat_Name from category";
	    $result = pg_query($conn, $sqlstring);
	    echo "<select name= 'CategoryList' class='form-control'>
			    <option value='0'>Choose category</option>";
			    while ($row = pg_fetch_array($result)) {
				    echo "<option value='".$row['Cat_ID']."'>".$row['Cat_Name']."</option>";
			    }
	    echo "</select>";
	}		
?>
<div class="container">
	<h2>Adding new Product</h2>

	 	<form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form">
				<div class="form-group">
					<label for="txtname" class="col-sm-2 control-label">Product ID(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Product ID" value=''/>
							</div>
				</div> 
				<div class="form-group"> 
					<label for="txtname" class="col-sm-2 control-label">Product Name(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtName" id="txtName" class="form-control" placeholder="Product Name" value=''/>
							</div>
                </div>   
                <div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Product category(*):  </label>
							<div class="col-sm-10">
							      <?php bind_Category_List($conn); ?>
							</div>
                </div>  
                          
                <div class="form-group">  
                    <label for="lblprice" class="col-sm-2 control-label">Price(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtPrice" id="txtPrice" class="form-control" placeholder="Price" value=''/>
							</div>
                 </div>   
                            
                <div class="form-group">   
                    <label for="lblShort" class="col-sm-2 control-label">Short description(*):  </label>
							<div class="col-sm-10">
							<input type="text" name="txtShort" id="txtShort" class="form-control" placeholder="Short description" value=''/>
							</div>
                </div>
                            
            	<div class="form-group">  
                    <label for="lblquantity" class="col-sm-2 control-label">Quantity(*):  </label>
							<div class="col-sm-10">
							      <input type="number" name="txtQty" id="txtQty" class="form-control" placeholder="Quantity" value=""/>
							</div>
                </div>

				<div class="form-group"> 
					<label for="txtshop" class="col-sm-2 control-label">Shop(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtShop" id="txtShop" class="form-control" placeholder="Shop" value=''/>
							</div>
                </div> 
				
 
				<div class="form-group">  
	                <label for="spimage" class="col-sm-2 control-label">Image(*):  </label>
							<div class="col-sm-10">
							      <input type="file" name="txtImage" id="txtImage" class="form-control" value=""/>
							</div>
                </div>
                        
				<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new"/>
                              <input type="button" class="btn btn-primary" name="btnIgnore"  id="btnIgnore" value="Ignore" onclick="window.location='Product_Management.php'" />
                              	
						</div>
				</div>
			</form>
</div>
<?php
if(isset($_POST["btnAdd"]))
{
	$id= $_POST["txtID"];
	$proname= $_POST["txtName"];
	$short= $_POST['txtShort'];
	$price= $_POST['txtPrice'];
	$qty= $_POST['txtQty'];
	$shop= $_POST["txtName"];
	$pic= $_POST['txtShop'];
	$category= $_POST['CategoryList'];
	$err="";
	if(trim($id)==""){
		$err.="<li>Enter product ID, please</li>";
	}
	if(trim($proname)==""){
	$err.="<li>Enter product name, please</li>";	
	}
	if($category=="0"){
		$err.="<li>Choose product category, please</li>";	
	}
	if(!is_numeric($price)){
		$err.="<li>Product price must be number</li>";	
	}
	if(!is_numeric($qty)){
		$err.="<li>Product quantity must be number</li>";	
	}

	if(trim($shop)==""){
		$err.="<li>Enter shop, please</li>";	
		}
	
	if($err !==""){
		echo "<ul>$err</ul>";
	}
	else{
		if($pic['type']=="image/jpg" || $pic['type']=="image/jpeg" || $pic['type']=="image/png" ||$pic['type']=="image/gif"){
			if($pic['size']<=614400)
			{
				$sq="Select * from product where Product_ID='$id' or Product_Name='$proname'";
				$result=pg_query($conn,$sq);
				if(pg_num_rows($result)==0)
				{
					copy($pic['tmp_name'],"product-imgs/".$pic['name']);
					$filePic = $pic['name'];

					$sqlstring="INSERT INTO product (
					Product_ID, Product_Name, Price, SmallDesc, Pro_qty, Pro_image, Cat_ID, ProDate)
					VALUES ('$id','$proname',$price,'$short', $qty,'$filePic','$category','".date('Y-m-d H:i:s')."')";
					pg_query($conn,$sqlstring);
					echo '<meta http-equiv="refresh" content="0;URL=?page=product_management"/>';
				}
				else{
					echo"<li>Duplicate product ID or Name</li>";
				}
			}
			else{
				echo"Size of image too big";
			}				
		}
		else{
			echo "Image format is not correct";
		}
	}
}
?>
<?php
    }
    else{
		echo '<script>alert("You are not administrator")</script>';
        echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
    }
?>