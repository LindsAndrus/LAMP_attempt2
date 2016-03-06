<html>
<head>
	<title><?=$data[0]['name']?></title>
</head>
<body>
	<?php $this->load->view('header'); ?>
	<h2><?=$data[0]['name']?></h2>

	<h3>Users who added this product/item under their wishlist:</h3>
	<ul>
		<?php 
			foreach ($data as $user) { ?>
				<li><?=$user['username'];?></li>
			<?php } ?>
	</ul>
</body>
</html>