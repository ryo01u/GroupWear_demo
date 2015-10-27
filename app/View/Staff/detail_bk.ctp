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
社員詳細画面
</header>
<br />

社員番号:<?php echo $info["Staff"]["staff_id"] ; ?><br />

社員名:<?php echo $info["Staff"]["name"] ; ?><br />

グループID:<?php echo $info["Staff"]["group_id"] ; ?><br />

メールアドレス:<?php echo $info["Staff"]["mail_address"] ; ?><br />

プロフィール:<?php echo $info["Staff"]["profile"] ; ?><br />

内線:<?php echo $info["Staff"]["extension_number"] ; ?><br />


</body>
</html>

