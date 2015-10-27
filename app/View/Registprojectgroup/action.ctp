<?php echo $this->element('header'); ?>
<?php echo $this->element('head'); ?>
<?php echo $this->element('navi'); ?>
<div class="bass_maincontents_01">
    <div class="container">
        <div class="row">
            <p class="bass_title_01">案件グループ登録</p>
        </div>
        <div class="bass_sec_01">
            <div class="row">
                <p class="bass_title_02">追加／編集</p>
            </div>

<!-- 追加編集フォーム -->

    <?php echo $this->Form->create('Projectgroup', array('action'=>'post', 'url' => '/registprojectgroup/action' )); ?>

    <table class="sheet">

    <?php echo $this->Form->input('Projectgroup.id',  array('type' => 'hidden',  'value'=>$id)); ?>


        <div class="row">
            <div class="col-sm-6">案件グループ名</div>
            <div class="col-sm-6 bass_textarea_01">
            <?php echo $this->Form->input('Projectgroup.name',array(
            'type'=>'text',
            'label'=>'グループ名',
            'required' => false  
            ));
             ?>
            </div>

        </div>

<?php echo $this->form->hidden('Projectgroup.set_staff_id', array('value'=>$set_staff_id)); ?>
        
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



