<h1>編集用画面</h1>

<?php
//フォームの開始を宣言する
echo $this->Form->create('News');

//入力フォームの生成
echo $this->Form->input('name');
echo $this->Form->input('set_staff_id');
echo $this->Form->input('news_type');
echo $this->Form->input('body');
//フォームの終了宣言
echo $this->Form->end('送信');
?>

