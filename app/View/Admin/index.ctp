<?php echo $this->element('header'); ?>
<?php echo $this->element('head'); ?>
<?php echo $this->element('navi'); ?>
<div class="bass_maincontents_01">
    <div class="container">
        <div class="row">
            <p class="bass_title_01">
                管理者メニュー</p>
        </div>
<div class="bass_sec_01">
<!--総務と技術統括は管理者権限-->
<?php $adminuser_flag = 1; ?>
<?php if ($adminuser_flag): ?>
	<div class="row"><div class="col-sm-12 bass_btn"><a href="<?php echo URI_PATH; ?>/registdepartment/">部署情報管理</a></div></div>
	<div class="row"><div class="col-sm-12 bass_btn"><a href="<?php echo URI_PATH; ?>/registgroup/">グループ情報管理</a></div></div>
	<div class="row"><div class="col-sm-12 bass_btn"><a href="<?php echo URI_PATH; ?>/registstaff/">スタッフ情報管理</a></div></div>
<?php endif; ?>

	<div class="row"><div class="col-sm-12 bass_btn"><a href="<?php echo URI_PATH; ?>/registclient/">取引先情報管理</a></div></div>
	<div class="row"><div class="col-sm-12 bass_btn"><a href="<?php echo URI_PATH; ?>/registproject/">案件情報管理</a></div></div>
	<!--<a href="<?php echo URI_PATH; ?>/registprojectgroup/">案件グループ情報管理</a><br>-->
	<div class="row"><div class="col-sm-12 bass_btn"><a href="<?php echo URI_PATH; ?>/registnews/">お知らせ登録</a></div></div>
	<!--<a href="<?php echo URI_PATH; ?>/registtag/">タグ情報管理</a><br>-->
    </div>
</div>
</div>
    <?php echo $this->element('footer'); ?>
