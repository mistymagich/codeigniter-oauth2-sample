<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>サービスプロバイダー</title>

<!-- Bootstrap -->
<link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
	padding-top: 60px;
}
</style>
<link href="/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="brand" href="#">サービスプロバイダー側</a> </div>
  </div>
</div>
<div class="container">
  <div class="permissions allow">
    <p>この連携アプリを認証すると、次の動作が<strong>許可されます</strong>。</p>
    <ul>
      <li>XXXXXXXXXXXXXXXXXXXXXXXX</li>
      <li>YYYYYYYYYYYYYYYYYYYYYYYY</li>
    </ul>
  </div>
  <fieldset class="login">
    <legend>Login(※デモなので入力の必要なし)</legend>
    <div class="control-group">
      <label class="control-label" for="username">ユーザ名</label>
      <div class="controls">
        <input name="username" type="text" />
      </div>
    </div>
    <div class="control-group">
      <label class="control-label" for="password">パスワード</label>
      <div class="controls">
        <input name="password" type="password" />
      </div>
    </div>
  </fieldset>
  <div class="form-actions">
    <form action="/oauth2/authorize?client_id=<?php echo $client_id ?>&redirect_uri=<?php echo $redirect_uri ?>&response_type=<?php echo $response_type ?>" method="post">
      <input type="hidden" name="authorize" value="1" />
      <button type="submit" class="btn btn-primary">許可する</button>
      <button type="button" class="btn" onclick="document.getElementById('cancel').submit()">Cancel</button>
    </form>
    <form id="cancel" action="/oauth2/authorize?client_id=<?php echo $client_id ?>&redirect_uri=<?php echo $redirect_uri ?>&response_type=<?php echo $response_type ?>" method="post">
      <input type="hidden" name="authorize" value="0" />
    </form>
  </div>
  <div class="permissions deny">
    <p>この連携アプリを認証しても、次の動作は<strong>許可されません</strong>。</p>
    <ul>
      <li>ZZZZZZZZZZZZZZZZZZZZZZZZ</li>
    </ul>
  </div>
</div>
<script src="http://code.jquery.com/jquery-latest.js"></script> 
<script src="/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
