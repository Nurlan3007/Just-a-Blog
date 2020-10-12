<?php
$ArticalId = $_GET['AtclId'];

$artical = R::getAll("SELECT `artical`.*,`users`.`login`,count(`rating`.`rating`) as rating
		  FROM `artical` 	
	     INNER JOIN `users` ON `artical`.`user_id` = `users`.`id`
	     LEFT JOIN `rating` ON `rating`.`artical_id` = `artical`.`id` 
	     WHERE `artical`.`id` = ? ORDER BY `artical`.`id` DESC LIMIT 15" ,[$ArticalId]);

$comments = R::getAll("SELECT `comment`.*,`users`.`login`,`users`.`id`
                      FROM `comment`
	                   INNER JOIN `users` ON `comment`.`user_id` = `users`.`id` 
	                   WHERE `comment`.`artical_id` = ?
	                   ORDER BY `comment`.`id` ",[$ArticalId]);

$images = [];
foreach($artical as $value)
	$images[] = R::getAll("SELECT * FROM `images` WHERE `artical_id` = ? ORDER BY `id`",[$value['id'] ]);

$created_at = get_date_created($artical[0]['created_at']);
$artical_id = base64_encode($artical[0]['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../../css/main.css">
	<link rel="stylesheet" href="../../css/artical_page.css">
	<link rel="icon" href="images/main_photo/icons8-домен-64.png" type="image/png">
</head>
<body>
<?php include_once 'pages/public/headers.php' ?>
<div class="page">
	<div class="container">
		<div class="content">
			<?php include_once 'pages/public/main_menu.php'; ?>
			<article class="article">
				<?php foreach ($artical as $key => $value): ?>	
					<div class="articale_values">
						<div class="photo">
							<!-- <div class="main_image main_image_2"> -->
								<?php foreach($images[0] as $key => $image): ?>
									<a href=""><img src="images/<?=$image['image_path']?>" class="img_artical"></a>
								<?php endforeach; ?>
							<!-- </div> -->
						</div>
						<input type="hidden" value="<?=$value['id']?>" id="artical_id2">
						<div class="articale_info">
							<div class="name_artical">
								<a href=""><h2><?=$value['main_name']?></h2></a>
							</div>
							<div class="text">
								<p><?=$value['value']?></p>
							</div>
							<div class="artical_footer">
								<div class="autor left_part_footer">
									<h5>Autor: <?=$value['login']?></h5>
									<h5>Data: <?=$created_at?></h5>
								</div>
								<div class="right_part_footer">
									<button class="like">
										<img src="images/main_photo/heart.svg" alt="" class="like_img">
										<?=$value['rating']	?>
									</button>
									<button class="save">Save</button>

								</div>
							</div>	
							<div class="border"></div>
							<div class="comment">
								<h3>Comments(<?=count($comments)?>)</h3>
								<h4 id="result"></h4>
								<input type="text" placeholder="TEXT" id="text" name="comment" autocomplete="off">
								<input type="hidden" id="artical_id" value="<?=$artical_id?>" name="artical_id">
								<button id="send" type="button">Send</button>
								<div class="value">
									<?php foreach ($comments as $key => $comment): ?>
										<p>Autor:  <?=$comment['login']?></p>
										<p>Comment: <?=$comment['comment']?> </p>
										<div class="border"></div>
									<?php endforeach; ?>
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
								<a href="from_this_category.php?category_id=<?=$category['id']?>">
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
<script type="text/javascript" src="../../js/add_comment_ajax.js"></script>
</body>
</html>