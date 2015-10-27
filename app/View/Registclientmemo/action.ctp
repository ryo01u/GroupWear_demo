<?php echo $this->element('header'); ?>
<?php echo $this->element('head'); ?>
<?php echo $this->element('navi'); ?>
<div class="bass_maincontents_01">
    <div class="container">
        <div class="row">
            <p class="bass_title_01">取引先メモ登録</p>
        </div>
        <div class="bass_sec_01">
            <div class="row">
                <p class="bass_title_02">追加／編集</p>
            </div>

<!-- 追加編集フォーム -->

    <?php echo $this->Form->create('Clientmemo', array('action'=>'post', 'url' => '/registclientmemo/action' )); ?>

    <table class="sheet">

    <?php echo $this->Form->input('Clientmemo.id',  array('type' => 'hidden',  'value'=>$id)); ?>



        <div class="row">
            <div class="col-sm-6">取引先</div>
            <div class="col-sm-6 bass_select_01">
        <?php
            echo $this->Form->input( 'Clientmemo.client_id', array(
            'label' => '企業名',
            'type' => 'select',
            'options' => $client
            ));
            ?>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-6">件名</div>
            <div class="col-sm-6 bass_textarea_01">
            <?php echo $this->Form->input('Clientmemo.name',array(
            'type'=>'text',
            'label'=>'件名',
            'required' => false  
            ));
             ?>
            </div>

        </div>
        
        <div>
	  		<label for="memo">内容：</label>
	  		<?php 
	  		echo $this->Form->input('Clientmemo.memo', array('type' => 'textarea'));
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



