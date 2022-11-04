<?php include 'includes/overall/oheader.php';	$err ="";	?>
<?php 
	error_reporting(0);
	session_start();
	//include 'includes/database/dbconfig.php';
	$id = $_REQUEST['id'];

	$query = "SELECT * FROM products WHERE id = '$id'";
	$result = mysql_query($query);
	
	while($data = mysql_fetch_object($result)) {
?>
	<div class="wrapper">
        <div class="img">
            <img src="<?php $img = $data->image; echo substr($img, 1); ?>" alt="<?php echo $data->name; ?>" width="400px" height="280px" />
        </div>
		<div class="p_tab">
        	<table align="right" width="600px">
            	<tr>
                	<th colspan="2">Name:</th>
                    <td colspan="2"><?php echo $data->name; ?></td>
                </tr>
        		<tr>
                	<th colspan="2">Title:</th>
                   <td colspan="2"><?php echo $data->title; ?></td>
                </tr>
                <tr>
                	<th colspan="2">Price:</th>
                    <td colspan="2"><?php echo $data->price; ?></td>
                </tr>
                <tr>
                	<th colspan="2">Description:</th>
                    <td colspan="2"><?php echo $data->description; ?></td>
                </tr>
                <tr>
                	<td colspan="6"><a href="invoice.php?id=<?php echo $data->id; ?>" style="text-decoration:none;" class="myButton">Place Order</a></td>
                    <!--/*<td colspan="6"><a>Add to cart</a></td>*/-->
                </tr>
            </table>
        </div>
	</div>
	<?php } ?>
<?php include 'includes/overall/ofooter.php'; ?>
	