<?php echo $this->element('header'); ?>
<?php echo $this->element('head'); ?>
<?php echo $this->element('navi'); ?>
<div class="bass_maincontents_01">
    <div class="container">
        <div class="row">
            <p class="bass_title_01">コンタクト履歴登録</p>
        </div>
        <div class="bass_sec_01">
            <div class="row">
                <p class="bass_title_02">追加／編集</p>
            </div>

<!-- 追加編集フォーム -->

    <?php echo $this->Form->create('Contact', array('action'=>'post', 'url' => '/registcontact/action' )); ?>

    <table class="sheet">

    <?php echo $this->Form->input('Contact.id',  array('type' => 'hidden',  'value'=>$id)); ?>



        <div class="row">
            <div class="col-sm-6">取引先</div>
            <div class="col-sm-6 bass_select_01">
        <?php
            echo $this->Form->input( 'Contact.client_id', array(
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
            <?php echo $this->Form->input('Contact.name',array(
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
	  		echo $this->Form->input('Contact.memo', array('type' => 'textarea'));
	  		?>
		</div>

            <div class="row">
                <div class="col-sm-12 bass_btn">
            <input type="submit" value="登録">
        </div>
    </div>
</form>

    </div>
</div>
</div>
<!-- 追加編集フォーム -->
        <?php echo $this->element('footer'); ?>



