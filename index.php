<?php
session_start();
include_once 'MainFunction/functions.php';

if(isset($_COOKIE['token'])){
	token();
}

include_once 'modules/ResultRouter.php';
$articals = R::getAll("SELECT `artical`.*,`users`.`login`,`rating`.`rating`
				FROM `artical`
				INNER JOIN `users` ON `artical`.`user_id` = `users`.`id`
				LEFT JOIN `rating` ON `rating`.`artical_id` = `artical`.`id`
			   GROUP BY `artical`.`id` ORDER BY `artical`.`id` DESC LIMIT 15" );

$images = [];
foreach($articals as $artical){
	$images[] = R::getAll("SELECT * FROM `images` WHERE `artical_id` = ? ORDER BY `id`",[$artical['id'] ]);
   $first_image[] = R::find("images","artical_id = ? LIMIT 1",[$artical['id']]);
   $count_comments[] = R::getAll("SELECT *,count(*) as C FROM `comment` WHERE `artical_id` = ?",[$artical['id']]);
}

// dump($articals);

$created_at = get_date_created($artical[0]['created_at']);
$count = 0;
// dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>BlogMini</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="icon" href="images/main_photo/icons8-домен-64.png" type="image/png">
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
								<div class="menu_right_part_footer">
									<?php 
									if  ($value['rating'] == '') $rating = 0;
									else $rating = $value['rating'];
									?>	
									<div class="rating_plus" data-id=<?=$value['id']?>>
										<img src="images/main_photo/heart.svg"><?=$rating?>
									</div>
									<div class="dropdown">
									  <button class="dropbtn"><img src="images/main_photo/menu.svg" class="menu"></button>
									  <div class="dropdown-content">
									    <a href="#">Add to playlist</a>
									    <a href="#">Save</a>
									    <a href="#">Save link</a>
									    <a href="#">Complain</a>
									  </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="../../js/update_rating.js"></script>
</body>
</html>