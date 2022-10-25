     <!-- Bootstrap --> 
     <link rel="stylesheet" type="text/css" href="style.css"/>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	    
	<?php
		include_once("connection.php");
		if(isset($_POST["btnAdd"]))
		{
				$id = $_POST["txtID"];
				$name = $_POST["txtName"];	
				$address = $_POST["txtAddress"];
				$err="";
				if($id==""){
					$err.="<li>Enter Shop ID, please</li>";
				}
				{
				}
				if($err!=""){
					echo "<ul>$err</ul>";
				}
				else{
				
					$sq="Select * from shop where shopid='$id' or shopname='$name'";
					$result = pg_query($sq);
					if(pg_num_rows($result)==0)
					{
						pg_query( "INSERT INTO shop (shopid,shopname, address) VALUES ('$id','$name','$address')");
						echo '<meta http-equiv="refresh" content="0;URL=?page=shop_management"/>';
					}
					else
					{
						echo "<li>Duplicate shop ID </li>";

					}
				}
		}
	?>

<div class="container">
	<h2>Adding Shop</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
				 <div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">Shop ID(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Shopid" value='<?php echo isset($_POST["txtID"])?($_POST["txtID"]):"";?>'>
							</div>
					</div>	
				 <div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">Shop Name (*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtName" id="txtName" class="form-control" placeholder="shopname" value='<?php echo isset($_POST["txtName"])?($_POST["txtName"]):"";?>'>
							</div>
					</div>
					
                    
                    <div class="form-group">
						    <label for="txtMoTa" class="col-sm-2 control-label">Address (*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtAddress" id="txtAddress" class="form-control" placeholder="address" value='<?php echo isset($_POST["txtAddress"])?($_POST["txtAddress"]):"";?>'>
							</div>
					</div>
                    
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new"/>
                              <input type="button" class="btn btn-primary" name="btnIgnore"  id="btnIgnore" value="Ignore" onclick="window.location='Shop_Management.php'" />
                              	
						</div>
					</div>
				</form>
	</div>