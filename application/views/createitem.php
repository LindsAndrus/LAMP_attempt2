<html>
<head>
	<title>Create an Item</title>
</head>
<body>
	<?php $this->load->view('header'); 
	?>
	<h2>Create a New Wishlist Item</h2>

	<form action="/new_item" method="post">
		Item/Product<input type="text" name="item">
		<input type="submit" value="Add">
	</form>
	<?php echo $errors; ?>
</body>
</html>