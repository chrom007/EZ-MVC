<!DOCTYPE html>
<html>
<head>
	<title><?=$this->title;?></title>
	<link rel="stylesheet" href="/css/site.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&amp;subset=cyrillic" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script src="/js/main.js"></script>
	<!--link rel="shortcut icon" href="favicon.png" type="image/png"-->
	<link rel="shortcut icon" href="favicon.ico">
	<meta charset="utf-8">
</head>
<body>

<div class="wrap" id="page">

	<?

		$this->render($this->template);

	?>

</div>

</body>
</html>