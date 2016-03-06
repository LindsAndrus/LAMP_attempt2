<html>
<head>
	<title></title>
	<style type="text/css">
		.table{border: solid 1px;}
		.table th{height: 100%; width: 20%; font-weight: bold;}
		.table td{width: 25%;}
	</style>
</head>
<body>
	<?php $this->load->view('header');?>
	<h2>Hello <?=$user['username']?></h2>

	<h3>Your Wish List:</h3>
	<div class="table">
	<table>
	<th>Item</th>
	<th>Added By</th>
	<th>Date Added</th>
	<th>Action</th>
	<?php
		foreach ($items as $item) { ?>
			<tr>
				<td><a href="/item_view/<?= $item['id']?>"><?= $item['name'];?></a></td>
				<td><?= $item['username'];?></td>
				<td><?= $item['added_on'];?></td>
				<td>
					<?php
					if ($item['username'] == $user['username']) { ?>
					 	<a href="/remove_item/<?=$item['id']?>">Delete</a>
					<?php } else {?>
						<a href="/deletefromwishlist/<?=$item['id']?>">Remove from my Wishlist</a>
					<?php } ?>
				</td>
			</tr>	
		<?php }	?>
	</table>
	</div>
	<h3>Other Users' Wish Lists:</h3>
	<div class="table">
		<table>
		<th>Item</th>
		<th>Added By</th>
		<th>Date Added</th>
		<th>Action</th>
		<?php
			foreach ($wishes as $wish) { 
				if ($wish['id'] !== $item['id']) { ?>
				<tr>
					<td><a href="/item_view/<?= $item['id']?>"><?= $wish['name'];?></a></td>
					<td><?= $wish['username'];?></td>
					<td><?= $wish['added_on'];?></td>
					<td><a href="/addtowishlist/<?=$wish['id']?>">Add to my Wishlist</a></td>
				</tr>	
				<?php }
				}	?>
		</table>
	</div>
	<br></br>
	<div>
		<a href="/add_item">Add New Item</a>
	</div>
</body>
</html>