<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../css/main.css">
	<link rel="icon" href="images/main_photo/icons8-домен-64.png" type="image/png">
	<title>Blog-Search</title>
</head>
<body>
<?php include_once 'headers.php';?>
<div class="page">
	<div class="container">
		<div class="content">
			<?php foreach ($result_search as $key => $value): ?>
				<?php $count++; ?>
				<h2><a href="ArticalPage?AtclId=<?=$value['id']?>"><?=$count.":".$value['main_name']?></a></h2>
			<?php endforeach ?>
		</div>	
	</div>
</div>
</body>
</html>