<?php  
$user_id = $_SESSION['user_id'];
$articals = R::getAll("SELECT `artical`.*,`users`.`login` FROM `artical` 	
	     INNER JOIN `users` ON `artical`.`user_id` = `users`.`id` 
	     WHERE `artical`.`user_id` = ? ORDER BY `artical`.`id` DESC",[$user_id]);

$images = [];
foreach($articals as $artical){
	$images[] = R::getAll("SELECT * FROM `images` WHERE `artical_id` = ? ORDER BY `id`",[$artical['id'] ]);
}

foreach($articals as $artical){
	$first_image[] = R::getAll("SELECT * FROM `images` WHERE `artical_id` = ? LIMIT 1",[$artical['id'] ]);
}
$time = new DateTime($articals[0]['created_at']);
$created_at = date_format($time,"d:m:y"); 
$count=0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../../css/header.css">
	<link rel="stylesheet" href="../../css/main.css">
	<link rel="stylesheet" href="../../css/profile.css">
</head>
<body>
<?php include_once 'headers.php'; ?>
<div class="page">
	<div class="container">
		<div class="content">
			<div class="profile">
				<h2>Profile</h2>
				<nav>
					<ol>
						<li>Login:<span><?=$users[0]['login']?></span></li>
						<li>Email:<span><?=$users[0]['email']?></span></li>
						<li>Password:<span>secret</span></li>
						<li>Role:<span>Users</span></li>
						<li>Data_created:<span><?=$date_created?></span></li>
					</ol>
					<ol>
						<li><a href="/">Main:Page</a></li>
						<li><a href="#">Pro_accaunt</a></li>
						<li><a href="/exit">Exit</a></li>
					</ol>
				</nav>	
			</div>
		<article class="article">
			<h2><?=$_COOKIE['succes']?></h2>
			<?php foreach ($articals as $key => $value): ?>	
					<div class="articale_values">
						<div class="photo">
							<div class="main_image">
								<?php foreach($first_image[$count] as $key => $image): ?>
									<a href=""><img src="images/<?=$image['image_path']?>" class="img_artical"></a>
								<?php endforeach; ?>
							</div>
							<div class="border"></div>	
							<div class="mini_images">
								<?php if (count($images[$count]) > 1): ?>
									<?php foreach($images[$count] as $key => $image): ?>
										<a href="/photos"><img src="images/<?=$image['image_path']?>" class="img_artical"></a>
									<?php endforeach; ?>
								<?php endif ?>
							</div>
						</div>
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
								<div class="delete_artical">
									<a href="/DeleteArtical?AtclId=<?=$value['id']?>"><img src="images/main_photo/close.svg"></a>
									<p>Удалить статью</p>
								</div>
								<div class="right_part_footer">
									<button class="save">Save</button>
									<button class="like">130 </button>
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

		</div>	
	</div>		
</div>			
<!-- <script src="../../js/slider.js"></script> -->

</body>
</html>