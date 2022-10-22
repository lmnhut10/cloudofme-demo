
<?php
include_once("connection.php");
?>
    <div class="slider-area">
        	<!-- Slider -->
			<div class="block-slider block-slider4">
				<ul class="" id="bxslider-home4">
					<li>
						<img src="img/images (10).jpg" alt="Slide">
						<div class="caption-group">
							<h2 class="caption title">   
                            
							               
							</h2>						
						</div>
					</li>
									
				</ul>
			</div>
			
    </div> 
    

    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Lish of toys</h2>
                        <div class="product-carousel">
                        
                       
                           <?php
						  
		  				   	$result = pg_query($conn, "SELECT * FROM product" );
			
			                if (!$result) { //add this check.
                                die('Invalid query: ' . pg_error($conn));
                            }
		
			            
			                while($row = pg_fetch_array($result)){
				            ?>
				            <!--A product -->
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="product-imgs/<?php echo $row['Pro_image']?>" width="200" height="200">
                                    <div class="product-hover">
                                        <a href="?page=quanly_product details&ma=<?php echo  $row['Product_ID']
                                        ?>" class="view-details-link"><i class="fa fa-link"></i> See</a>
                                    </div>
                                </div>
                                
                                <h2><a href="?page=quanly_product details&ma=<?php echo  $row['Product_ID']?>"> <?php echo  $row['Product_Name']?></a></h2>
                                
                                <div class="product-carousel-price">
                                    <ins><?php echo  $row['Price']?></ins> 
                                </div> 
                            </div>
                
                <?php
				}
				?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    
    <div class="product-widget-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <div class="single-wid-product">
                            <a href="index.php"><img src="img/images (1).jpg" alt="" class="product-thumb"></a>
                            <h2><a href="index.php">Cranes</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>155.000 VND</ins> <del> 200.000 VND</del>
                            </div>                            
                        </div>
                        <div class="single-wid-product">
                            <a href="index.php"><img src="img/images (2).jpg" alt="" class="product-thumb"></a>
                            <h2><a href="index.php">Car Model</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>500.000 VND</ins> 
                            </div>                            
                        </div>
                        <div class="single-wid-product">
                            <a href="index.php"><img src="img/images (3).jpg" alt="" class="product-thumb"></a>
                            <h2><a href="index.php">Pushchair</a></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>400.000 VND</ins> 
                            </div>                            
                        </div>
                    </div>
                
            </div>
        </div>
    </div> 
    
   
  