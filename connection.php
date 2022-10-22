<?php
$Connect = pg_connect("host=ec2-44-206-137-96.compute-1.amazonaws.com 
port=5432 
dbname=d350ulqeiackrv
user=ninggkpqcpykxj
 password=f1b811114a740a3ae5535f9c2d0cafe43a3795f22db5c13094c8e439c85877a8");	
if (!$Connect) 
{
     die("Connection failed");
}
?>