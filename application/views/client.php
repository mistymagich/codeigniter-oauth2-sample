<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>クライアント</title>
<!-- Bootstrap -->
<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<style>
body {
	padding-top: 60px;
}
</style>
<link href="/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="brand" href="/">クライアント側</a> </div>
  </div>
</div>
<div class="container">
  <?php if ($auth_url) { ?>
  <p><a href="<?php echo $auth_url ?>" class="btn btn-info">認証・認可ページへ</a></p>
  <?php } else { ?>
  <p>アクセストークン：<?php echo $access_token ?></p>
  <p>APIからのレスポンス<br />
    <?php var_dump($friends) ?>
  </p>
  <?php } ?>
</div>
<script src="http://code.jquery.com/jquery-latest.js"></script> 
<script src="/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
