<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="device-width, user-scalable=no, initial-scale=1, maximum-scale=1">
	<title>qrator</title>
	<?php echo $this->Html->css('common'); ?>
	<?php echo $this->Html->css('reset'); ?>

	<!--
	cssファイルを使いたい場合
	/httpd/cake/app/webroot/cssにcss ファイルを置くこと
	呼び出し方は下記のようにかくこと
	<?php echo $this->Html->css('cake.generic'); ?>
	-->
</head>


<body>

<header>
事業部詳細画面
</header>
<br />

事業部ID:<?php echo $info["Department"]["department_id"] ; ?><br />

事業部名:<?php echo $info["Department"]["name"] ; ?><br />


</body>
</html>

