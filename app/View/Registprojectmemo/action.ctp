<?php echo $this->element('header'); ?>
<?php echo $this->element('head'); ?>
<?php echo $this->element('navi'); ?>
<div class="bass_maincontents_01">
    <div class="container">
        <div class="row">
            <p class="bass_title_01">案件メモ登録</p>
        </div>
        <div class="bass_sec_01">
            <div class="row">
                <p class="bass_title_02">追加／編集</p>
            </div>

<!-- 追加編集フォーム -->

    <?php echo $this->Form->create('Projectmemo', array('action'=>'post', 'url' => '/registprojectmemo/action' )); ?>

    <table class="sheet">

    <?php echo $this->Form->input('Projectmemo.id',  array('type' => 'hidden',  'value'=>$id)); ?>

    <?php echo $this->Form->input('Projectmemo.project_id',  array('type' => 'hidden',  'value'=>$project_id)); ?>
 
        <div class="row">
			<div class="col-sm-6"><?php echo( $project["Project"]["name"])  ;?></div>
        </div>

        <div class="row">
            <div class="col-sm-6">タイトル</div>
            <div class="col-sm-6 bass_textarea_01">
            <?php echo $this->Form->input('Projectmemo.title',array(
            'type'=>'text',
            'label'=>'グループ名',
            'required' => false  
            ));
             ?>
            </div>
        </div>
        
        <div class="row">
	  		<?php 
	  		echo $this->Form->input('Projectmemo.memo', array('type' => 'textarea','label'=>'メモ',));
	  		?>
		</div>

            <div class="row">
                <div class="col-sm-12 bass_btn">
            <input type="submit" value="送信">
        </div>
    </div>
</form>

    </div>
</div>
</div>
<!-- 追加編集フォーム -->
        <?php echo $this->element('footer'); ?>



