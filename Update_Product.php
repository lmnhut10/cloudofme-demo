<?php
if(isset($_SESSION['admin']) && $_SESSION['admin']==1)
{
?>
<!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<?php
	include_once("connection.php");
	function bind_Category_List($selectedValue){
		$sqlstring="SELECT Cat_ID, Cat_Name from category";
		$result=pg_query($sqlstring);
		echo"<Select name='CategoryList' class='form-control'>
			<option value='0'>Choose category</option>";
			while($row=pg_fetch_array($result)){
				if($row['Cat_ID']==$selectedValue){
					echo"<option value='". $row['cat_id']."' selected>".$row['cat_name']."</option>";
				}
				else{
					echo"<option value='". $row['cat_id']."'>".$row['cat_name']."</option>";
				}
			}
	echo"</select>";
	}
	if(isset($_GET["id"])){
		$id=$_GET["id"];
		$sqlstring="SELECT product_name, price, smalldesc, prodate, pro_qty,
		pro_image, cat_id from product where product_id='$id'";
		$result=pg_query($sqlstring);
		$row=pg_fetch_array($result);
		$proname=$row["product_name"];
		$short=$row['smalldesc'];
		$price=$row['price'];
		$qty=$row['pro_qty'];
		$pic=$row['pro_image'];
		$category=$row['cat_id'];
	
?>
<div class="container">
	<h2>Updating Product</h2>

	 	<form id="frmProduct" name="frmProduct" method="post" enctype="multipart/form-data" action="" class="form-horizontal" role="form">
				<div class="form-group">
					<label for="txtTen" class="col-sm-2 control-label">Product ID(*):  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtID" id="txtID" class="form-control" 
								  placeholder="Product ID" readonly value='<?php echo $id; ?>'/>
							</div>
				</div> 
				<div class="form-group"> 
					<label for="txtTen" class="col-sm-2 control-label">Product Name(*):  </label>
							<div class="col-sm-10">
								  <input type="text" name="txtName" id="txtName" class="form-control" 
								  placeholder="Product Name" value='<?php echo $proname; ?>'/>
							</div>
                </div>   
                <div class="form-group">   
                    <label for="" class="col-sm-2 control-label">Product category(*):  </label>
							<div class="col-sm-10">
							    <?php bind_Category_List( $category); ?>
							</div>
                </div>  
                          
                <div class="form-group">  
                    <label for="lblGia" class="col-sm-2 control-label">Price(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtPrice" id="txtPrice" class="form-control" placeholder="Price" value='<?php echo $price; ?>'/>
							</div>
                 </div>   
                            
                 <div class="form-group">   
                    <label for="lblShort" class="col-sm-2 control-label">Short description(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtShort" id="txtShort" class="form-control" placeholder="Short description" value='<?php echo $short; ?>'/>
							</div>
                </div>
                            
               
                            
            	<div class="form-group">  
                    <label for="lblSoLuong" class="col-sm-2 control-label">Quantity(*):  </label>
							<div class="col-sm-10">
							      <input type="number" name="txtQty" id="txtQty" class="form-control" placeholder="Quantity" value="<?php echo $qty; ?>"/>
							</div>
                </div>

				<div class="form-group">  
                    <label for="lblShop" class="col-sm-2 control-label">Shop(*):  </label>
							<div class="col-sm-10">
							      <input type="number" name="txtShop" id="txtShop" class="form-control" placeholder="Quantity" value="<?php echo $qty; ?>"/>
							</div>
                </div>
 
				<div class="form-group">  
	                <label for="sphinhanh" class="col-sm-2 control-label">Image(*):  </label>
							<div class="col-sm-10">
							<img src='product-imgs/<?php echo $pic; ?>' border='0' width="50" height="50"  />
							      <input type="file" name="txtImage" id="txtImage" class="form-control" value=""/>
							</div>
                </div>
                        
				<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnUpdate" id="btnUpdate" value="Update"/>
                              <input type="button" class="btn btn-primary" name="btnIgnore"  id="btnIgnore" value="Ignore" onclick="window.location='index.php'" />
                              	
						</div>
				</div>
			</form>
</div>
<?php
	}
	else{
		echo'<meta http-equiv="refresh" content="0;URL=Product_Management.php"/>';
	}
?>
<?php	
	if(isset($_POST["btnUpdate"]))
	{
		$id=$_POST["txtID"];
		$proname=$_POST["txtName"];
		$short=$_POST['txtShort'];
		$price=$_POST['txtPrice'];
		$qty=$_POST['txtQty'];
		$shopid= $_POST["txtShop"];
		$pic=$_FILES['txtImage'];
		$category=$_POST['CategoryList'];
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
			$err.="<li>Product price must be number</li>";
		}
		if(trim($shopid)==""){
			$err.="<li>Enter shop, please</li>";	
			}
		if($err!=""){
			echo "<ul>$err</ul>";
		}
		else{
			if($pic['name']!="")
			{
			    if($pic['type']=="image/jpg" || $pic['type']=="image/jpeg" ||$pic['type']=="image/png"
			        ||$pic['type']=="image/gif"){
				    if($pic['size']<= 614400){

					    $sq="SELECT * from product where product_id != '$id' and product_name='$proname'";
					    $result=pg_query($sq);
					    if(pg_num_rows($result)==0){
						        copy($pic['tmp_name'], "product-imgs/".$pic['name']);
						        $filePic = $pic['name'];
						        $sqlstring="UPDATE product set 
								
								product_name='$proname', 
								price=$price, 
								smalldesc='$short',
						        pro_qty=$qty, 
								shopid='$shopid'
						        pro_image='$filePic',
								cat_id='$category',
						        prodate='".date('Y-m-d H:i:s').
								
								"WHERE product_id='$id'";
						        pg_query($sqlstring);
						        echo '<meta http-equiv="refresh" content="0;URL=?page=product_management"/>';
					        }
					        else{
						        echo "<li>Duplicate product Name</li>";
					        }
				        }
				        else{
					        echo "Size of image too big";
				        }
			        }
			        else{
				        echo "Image format is not correct";
			        }		
		    }
		    else{
				$sq="SELECT * from product where product_id != '$id' and product_name='$proname'";
				$result=pg_query($sq);
				if(pg_num_rows($result)==0){

					$sqlstring="UPDATE product set 

					product_name='$proname',
					price=$price, 
					smalldesc='$short', 
					pro_qty=$qty, 
					shopid='$shopid',
					pro_image='$filePic',
					cat_id='$category',
					prodate='".date('Y-m-d H:i:s')."
					
					'WHERE product_id='$id'";

					pg_query($sqlstring);
					echo '<meta http-equiv="refresh" content="0;URL=?page=product_management"/>';
				}
				else{
					echo "<li>Duplicate product Name</li>";
				}
			}		
	    }
	}	
?>
<?php
}
else 
{
    echo '<script>alert("You are not administrator")</script>';
    echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
}
?>