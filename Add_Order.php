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
				$pay = $_POST["txtPayment"];
                $deli = $_POST["txtDelivery_loca"];
                $dedate = $_POST["txtDeleverydate"];
                $ordate= $_POST["txtOrderdate"];
				$err="";
				if($id==""){
					$err.="<li>Enter Order ID, please</li>";
				}
				if($name==""){
					$err.="<li>Enter User Name, please</li>";
				}
				if($err!=""){
					echo "<ul>$err</ul>";
				}
				else{
				
					$sq="Select * from order where orderid='$id' or username='$name'";
					$result = pg_query($sq);
					if(pg_num_rows($result)==0)
					{
						pg_query( "INSERT INTO order (orderid, username, payment, delevery_loca, deleverydate, orderdate) 
                        VALUES ('$id','$name','$pay','$deli','$deate', '$ordate')");
						echo '<meta http-equiv="refresh" content="0;URL=?page=order_management"/>';
					}
					else
					{
						echo "<li>Duplicate order ID or Name</li>";

					}
				}
		}
	?>

<div class="container">
	<h2>Adding Order</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
				 <div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">Order ID(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtID" id="txtID" class="form-control" placeholder="Order ID" value='<?php echo isset($_POST["txtID"])?($_POST["txtID"]):"";?>'>
							</div>
					</div>	
				 <div class="form-group">
						    <label for="txtTen" class="col-sm-2 control-label">User Name(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtName" id="txtName" class="form-control" placeholder="User Name" value='<?php echo isset($_POST["txtName"])?($_POST["txtName"]):"";?>'>
							</div>
					</div>
                    
                    <div class="form-group">
						    <label for="txtMoTa" class="col-sm-2 control-label">Payment (*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtPayment" id="txtPayment" class="form-control" placeholder="Payment" value='<?php echo isset($_POST["txtPayment"])?($_POST["txtPayment"]):"";?>'>
							</div>
					</div>

                    <div class="form-group">
						    <label for="txtMoTa" class="col-sm-2 control-label">Delevery_loca (*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtDelivery_loca" id="txtDelivery_loca" class="form-control" placeholder="Delivery_loca" value='<?php echo isset($_POST["txtDelivery_loca"])?($_POST["txtDelivery_loca"]):"";?>'>
							</div>
					</div>

                    <div class="form-group">
						    <label for="txtMoTa" class="col-sm-2 control-label">Deliverydate (*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtDeliverydate" id="txtDeliverydate" class="form-control" placeholder="Deliverydate" value='<?php echo isset($_POST["txtDeliverydate"])?($_POST["txtDeliverydate"]):"";?>'>
							</div>
					</div>

                    <div class="form-group">
						    <label for="txtMoTa" class="col-sm-2 control-label">Orderdate (*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtOrderdate" id="txtOrderdate" class="form-control" placeholder="Orderdate" value='<?php echo isset($_POST["txtOrderdate"])?($_POST["txtOrderdate"]):"";?>'>
							</div>
					</div>
                    
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnAdd" id="btnAdd" value="Add new"/>
                              <input type="button" class="btn btn-primary" name="btnIgnore"  id="btnIgnore" value="Ignore" onclick="window.location='Order_Management.php'" />
                              	
						</div>
					</div>
				</form>
	</div>