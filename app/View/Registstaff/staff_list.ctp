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
社員一覧画面
</header>
<br />

<h2>あ行</h2>
浅岡さん:<?php echo $info["Staff"]["staff_id"] ; ?><br />

浅岡さん2:<?php echo $info["Staff"]["staff_id"] ; ?><br />

浅岡さん3:<?php echo $info["Staff"]["staff_id"] ; ?><br />

浅岡さん4:<?php echo $info["Staff"]["staff_id"] ; ?><br />


<h2>か行</h2>
かさおかさん:<?php echo $info["Staff"]["staff_id"] ; ?><br />

かさおかさん2:<?php echo $info["Staff"]["staff_id"] ; ?><br />

かさおかさん3:<?php echo $info["Staff"]["staff_id"] ; ?><br />


</body>
</html>

