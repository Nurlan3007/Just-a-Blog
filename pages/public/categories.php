<?php 
$category_id = $_GET['category_id'];
$articals = R::getAll("SELECT `artical`.*,`users`.`login` FROM `artical` 	
	     INNER JOIN `users` ON `artical`.`user_id` = `users`.`id` 
	     WHERE `artical`.`category_id` = ? ORDER BY `artical`.`id` DESC LIMIT 15" ,
	     array($category_id));


$images = [];
foreach($articals as $artical){
	$images[] = R::getAll("SELECT * FROM `images` WHERE `artical_id` = ? ORDER BY `id`",[$artical['id'] ]);
}

foreach($articals as $artical){
	$first_image[] = R::getAll("SELECT * FROM `images` WHERE `artical_id` = ? LIMIT 1",[$artical['id'] ]);
}

$created_at = get_date_created($artical[0]['created_at']);
$count = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/main.css">
	<link rel="icon" href="images/main_photo/icons8-домен-64.png" type="image/png">
	<title>Blog</title>
</head>
<body>
	<?php include_once 'pages/public/headers.php' ?>
<div class="page">
	<div class="container">
		<div class="content">
			<?php include_once 'pages/public/main_menu.php'; ?>
			<article class="article">
				<?php foreach ($articals as $key => $value): ?>	
					<div class="articale_values">
						<div class="photo">
							<div class="main_image">
								<?php foreach($first_image[$count] as $key => $image): ?>
									<a href="/ArticalPage?AtclId=<?=$value['id']?>"><img src="images/<?=$image['image_path']?>" class="img_artical"></a>
								<?php endforeach; ?>
							</div>
							<div class="border"></div>	
							<div class="mini_images">
								<?php if (count($images[$count]) > 1): ?>
									<?php foreach($images[$count] as $key => $image): ?>
										<a href="/ArticalPage?AtclId=<?=$value['id']?>">
											<img src="images/<?=$image['image_path']?>" class="img_artical">
										</a>
									<?php endforeach; ?>
								<?php endif ?>
							</div>
						</div>
						<div class="articale_info">
							<div class="name_artical">
								<a href="/ArticalPage?AtclId=<?=$value['id']?>"><h2><?=$value['main_name']?></h2></a>
							</div>
							<div class="text">
								<p><?=substr($value['value'],0,1150)?>
								<?php if (strlen($value['value']) >= 1150): ?>
									...<a href="">more</a></p>
								<?php endif ?>
							</div>
							<div class="artical_footer">
								<div class="autor left_part_footer">
									<h5>Autor: <?=$value['login']?></h5>
									<h5>Data: <?=$created_at?></h5>
								</div>
								<div class="right_part_footer">
									<button class="save">Save</button>
									<button class="like"></button>
									<img src="images/main_photo/heart.svg" alt="" class="like_img">
									<div class="comment">
										Comment:30
									</div>
								</div>
							</div>	
						</div>
					</div>	
						<?$count++;?>
				<?php endforeach; ?>
			
			</article>
			<div class="categories menu">
				<h2>Categories</h2>
				<? $categories = get_categories();?>
				<nav class="main_menu">
					<ul>
						<?php foreach ($categories as $category): ?>
							<li>
								<a href="category?category_id=<?=$category['id']?>">
									<?=$category['name']?>
								</a>
							</li>
						<?php endforeach ?>
					</ul>
				</nav>	
			</div>	
		
		</div>
	</div>
</div>	
</body>
</html>