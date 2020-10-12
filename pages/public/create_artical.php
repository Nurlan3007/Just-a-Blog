<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../../css/main.css">
	<link rel="stylesheet" href="../../css/create_artical.css">
</head>
<body>
<?php  $categories = get_categories();?>
<div class="page">
	<div class="container">
		<h3><a href="/"> <-Return main page.</a></h3>
		<div class="block_form">
			<form action="/create_artical_post" method="post" 
			autocomplete="off" class="auth_form" enctype="multipart/form-data">
				<h1>Create Artical</h1>
					<p>
						<?php 
						echo print_error('name_artical_1').'<br>';
						echo print_error('name_artical_2').'<br>';
						echo print_error('image');
						?>
					</p>
				<div class="form_group count_images_block">
					<input type="text" placeholder="How many images? Would you want add?" id="count_images">
					<button id="click" type="button">Send</button>
					<a href="/create_artical" id="return">Return</a>
				</div>	
				<div class="form_group images">
					<label>Images</label>
					<input type="file" name="images" placeholder="Choose images">
				</div>
				<div class="form_group select">
					<label for="">Category</label>
					 <select class="select-css" name="category"> 
					  	<?php foreach ($categories as $value): ?>
						    <option value="<?=$value['id']?>"><?=$value['name']?></option>
					  	<?php endforeach ?>
					  </select>
				</div>
				<div class="form_group">
					<label>Name Artical</label>
					<input type="text" name="name" placeholder="Write name">
				</div>
				<div class="form_group">
					<label>TEXT</label>
					<textarea name="text" placeholder="Write email"></textarea>
				</div>
				<div class="form_group">
					<input type="submit" value="Create">
					<a href="/login">Проблемы? напишите нам!</a>
				</div>
			</form>
		</div>
	</div>	
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src=".././../js/count_and_add_images_input.js"></script>
</body>
</html>