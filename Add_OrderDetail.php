     <!-- Bootstrap --> 
     <link rel="stylesheet" type="text/css" href="style.css"/>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	    
	<?php
		include_once("connection.php");
		if(isset($_POST["btnAdd"]))
		{
				$id = $_POST["txtID"];
				$oid = $_POST["txtOid"];
				$pid = $_POST["txtPid"];
				$quanity = $_POST["txtQuanity"];
				$err="";
				if($id==""){
					$err.="<li>Enter Order Detail ID, please</li>";
				}
				
				if($pid==""){
					$err.="<li>Enter Product ID, please</li>";
				}
				if($err!=""){
					echo "<ul>$err</ul>";
				}
				else{
				
					$sq="Select * from orderdetail where orderdetail_id='$id' ";
					$result = pg_query($sq);
					if(pg_num_rows($result)==0)
					{
						pg_query("INSERT INTO orderdetail (orderdetail_id, orderid, product_id, quanity) VALUES ('$id','$oid','$pid','$quanity')");
						echo '<meta http-equiv="refresh" content="0;URL=?page=orderdetail_management"/>';
					}
					else
					{
						echo "<li>Duplicate orderdetail ID </li>";

					}
				}
		}
	?>

<div class="container">
	<h2>Adding OrderDetail</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
				 <div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">OrderDetail ID(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtID" id="txtID" class="form-control" placeholder="OrderDetail ID" value='<?php echo isset($_POST["txtID"])?($_POST["txtID"]):"";?>'>
							</div>
					</div>	
				 <div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">OrderID(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtOid" id="txtOid" class="form-control" placeholder="Order ID" value='<?php echo isset($_POST["txtOid"])?($_POST["txtOid"]):"";?>'>
							</div>
					</div>
					<div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">Product_ID(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtPid" id="txtPid" class="form-control" placeholder="Product_ID" value='<?php echo isset($_POST["txtPid"])?($_POST["txtPid"]):"";?>'>
							</div>
					</div>
                    
                    <div class="form-group">
						    <label for="txtMoTa" class="col-sm-2 control-label">Quanity (*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtQuanity" id="txtQuanity" class="form-control" placeholder="Quanity" value='<?php echo isset($_POST["txtQuanity"])?($_POST["txtQuanity"]):"";?>'>
							</div>
					</div>
                    
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new"/>
                              <input type="button" class="btn btn-primary" name="btnIgnore"  id="btnIgnore" value="Ignore" onclick="window.location='OrderDetail_Management.php'" />
                              	
						</div>
					</div>
				</form>
	</div>