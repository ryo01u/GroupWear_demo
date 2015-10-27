<?php echo $this->element('header'); ?>

<header>
qrator リンク集
</header>

<br />
<a href="/users/login">ログインTOP</a><br>
<br />
<a href="/mypage/index">マイページTOP</a><br>

・・・・・管理画面・・・・・
<br>
<a href="<?php echo URI_PATH; ?>/registnews/">ニュース登録</a><br>
<a href="<?php echo URI_PATH; ?>/registstaff/">スタッフ登録</a><br>
<a href="<?php echo URI_PATH; ?>/registdepartment/">部署登録</a><br>
<a href="<?php echo URI_PATH; ?>/registgroup/">グループ登録</a><br>
<a href="<?php echo URI_PATH; ?>/registproject/">案件登録</a><br>
<a href="<?php echo URI_PATH; ?>/registclient/">取引先登録</a><br>

・・・・・<br>

<br>
<br>


<a href="/staff/list">スタッフ一覧</a><br>
<br>
<a href="/staff/detail/1">社員詳細</a><br>
<br>
<a href="/client/list">取引先一覧</a><br>
<a href="/client/detail/1">取引先詳細</a><br>



<!--<a href="/static">静的TOP</a><br>-->

<br>
<br>

<a href="project/list">プロジェクト一覧</a><br>
<a href="project/detail/1">プロジェクト詳細</a><br>

<br>
<a href="depart/list">部署一覧</a><br>
<a href="staff/detail/1">部署詳細</a><br>
<br>
<a href="depart/list">キーワード検索</a><br>

<br>
<a href="depart/list">ニュース表示</a><br>





<br />
<br />


<footer>

<a href="/users/logout">ログアウト</a><br>

</footer>



<?php echo $this->element('footer'); ?>