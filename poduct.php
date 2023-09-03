<?php include 'includes/overall/oheader.php';
$err = "";	?>
<?php
$id = $_REQUEST['id'];

$db = new Doctrine();
$sql = "SELECT * FROM articles WHERE id = ?";
$queryBuilder = $db->queryBuilder();
$result = $queryBuilder
    ->select('id', 'image', 'name', 'title', 'price', 'description')
    ->from('products')
    ->where('id = ?')
    ->setParameter(0, $id)->fetchAssociative();

if (!empty($result)) {
?>
	<div class="flexcontainer">
		<div class="img" >
			<img src="<?php $img = $result['image'];
						echo substr($img, 1); ?>" alt="<?php echo $result['name']; ?>" style="height: 65vh;"  />
		</div>
		<div class="p_tab">
			<table align="right" width="600px">
				<tr>
					<th colspan="2">Name:</th>
					<td colspan="2"><?php echo $result['name']; ?></td>
				</tr>
				<tr>
					<th colspan="2">Title:</th>
					<td colspan="2"><?php echo $result['title']; ?></td>
				</tr>
				<tr>
					<th colspan="2">Price:</th>
					<td colspan="2"><?php echo $result['price']; ?></td>
				</tr>
				<tr>
					<th colspan="2">Description:</th>
					<td colspan="2"><?php echo $result['description']; ?></td>
				</tr>
				<tr>
					<td colspan="6"><a href="invoice.php?id=<?php echo $result['id']; ?>" style="text-decoration:none;" class="myButton">Place Order</a></td>
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