<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Get Electrified</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="author" content="mrk25" />
<meta name="robots" content="index, follow" />
<meta name="viewport" content="width=device-width" />
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
</head>
<body>
<header>
<h1>Get Electrified Blog</h1>
<h2>Musica elettronica, DJing, audio &amp; video live set.</h2>
</header>
<?php foreach($contents as $post){ ?>
	<div>
		<h2 title="<?php echo $post['title']; ?>">
			<a href="<?php echo $post['link']; ?>">
				<?php echo $post['title']; ?>
			</a>
		</h2>
		<div>
			<?php echo ($fullposts)?$post['content:encoded']:$post['description']; ?>
		</div>
	</div>
<?php } ?>
</body>
</html>
