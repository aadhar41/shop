<?php include 'includes/overall/oheader.php';
$err = "";	?>
<?php
$id = $_REQUEST['id'];

$db = new Db();
$sql = "SELECT * FROM products WHERE id = '$id'";
$data = $db->runQueryObj($sql);
if ($db->numRows($sql)) {
?>
	<div class="flexcontainer">
		<div class="img css-product-page-image" >
			<img src="<?php $img = $data->image;
						echo substr($img, 1); ?>" alt="<?php echo $data->name; ?>" style="height: 65vh;"  />
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
<?php
}
$db->close();
?>
<?php include 'includes/overall/ofooter.php'; ?>