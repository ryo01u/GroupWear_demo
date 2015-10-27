<?php echo $this->element('header'); ?>
<?php echo $this->element('head'); ?>
<?php echo $this->element('navi'); ?>
<div class="bass_maincontents_01">
    <div class="container">
        <div class="row">
            <p class="bass_title_01">案件契約登録</p>
        </div>
        <div class="bass_sec_01">
            <div class="row">
                <p class="bass_title_02">追加／編集</p>
            </div>

<!-- 追加編集フォーム -->

    <?php echo $this->Form->create('Projectcontract', array('action'=>'post', 'url' => '/registprojectcontract/action' )); ?>

    <table class="sheet">

    <?php echo $this->Form->input('Projectcontract.id',  array('type' => 'hidden',  'value'=>$id)); ?>

    <?php echo $this->Form->input('Projectcontract.project_id',  array('type' => 'hidden',  'value'=>$project_id)); ?>
 
        <div class="row">
			<div class="col-sm-6"><?php echo( $project["Project"]["name"])  ;?></div>
        </div>

		<div class="row">
			<div class="col-sm-6">種別</div>
			<div class="col-sm-6 bass_textarea_01">
			<?php	
				echo $this->Form->input( 'Projectcontract.status', array(
				'label' => '契約種別', 
			    'type' => 'select', 
			    'options' => $contract_status
			    ));
			?>
			</div>
		</div>
		
        <div class="row">
            <div class="col-sm-6">タイトル</div>
            <div class="col-sm-6 bass_textarea_01">
            <?php echo $this->Form->input('Projectcontract.title',array(
            'type'=>'text',
            'label'=>'タイトル',
            'required' => false  
            ));
             ?>
            </div>
        </div>
        
        <div class="row">
	  		<?php 
	  		echo $this->Form->input('Projectcontract.memo', array('type' => 'textarea','label'=>'メモ',));
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



