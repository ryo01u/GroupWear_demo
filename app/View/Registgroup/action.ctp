<?php echo $this->element('header'); ?>
<?php echo $this->element('head'); ?>
<?php echo $this->element('navi'); ?>
<div class="bass_maincontents_01">
    <div class="container">
        <div class="row">
            <p class="bass_title_01">グループ登録</p>
        </div>
        <div class="bass_sec_01">
            <div class="row">
                <p class="bass_title_02">追加／編集</p>
            </div>

<!-- 追加編集フォーム -->

    <?php echo $this->Form->create('Group', array('action'=>'post', 'url' => '/registgroup/action' )); ?>

    <table class="sheet">

    <?php echo $this->Form->input('Group.id',  array('type' => 'hidden',  'value'=>$id)); ?>



        <div class="row">
            <div class="col-sm-2">部署</div>
            <div class="col-sm-2 bass_select_01">
        <?php
            echo $this->Form->input( 'Group.department_id', array(
            'label' => false,
            'type' => 'select',
            'options' => $department
            ));
            ?>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-2">グループ名</div>
            <div class="col-sm-6 bass_textarea_01">
            <?php echo $this->Form->input('Group.name',array(
            'type'=>'text',
            'label'=>'グループ名',
            'required' => false
            ));
             ?>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-2">内容</div>
            <div class="col-sm-3 bass_textarea_01">
	  		<!-- <label for="memo">内容：</label> -->
	  		<?php
	  		echo $this->Form->input('Group.memo', array('type' => 'textarea'));
	  		?></div>
		</div>


  <div class="row">

            <div class="col-sm-2">表示有無</div>
            <div class="col-sm-6">
		<?php echo $this->Form->input('Group.view_flag', array('label' => "表示する" ,  'type' => 'checkbox',));?>
	</div></div>

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



