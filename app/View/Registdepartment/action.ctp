<?php echo $this->element('header'); ?>
<?php echo $this->element('head'); ?>
<?php echo $this->element('navi'); ?>
<div class="bass_maincontents_01">
    <div class="container">
        <div class="row">
            <p class="bass_title_01">部署登録</p>
        </div>
         <div class="bass_sec_01">
        <div class="row">
            <p class="bass_title_02">追加／編集</p>
            </div>

    <?php echo $this->Form->create('Department', array('action'=>'post', 'url' => '/registdepartment/action' , 'enctype' => 'multipart/form-data')); ?>

    <?php echo $this->Form->input('Department.id',  array('type' => 'hidden',  'value'=>$id)); ?>
    
            <div class="row">
                <div class="col-sm-2">部署名</div>
                <div class="col-sm-6 bass_textarea_01">
			   <?php echo $this->Form->input('Department.name',array('type' => 'text', 'required' => false  )); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-2">画像</div>

            	<?php if (file_exists( WWW_ROOT  . "img" . "/department/" . $id . ".jpg")): ?>
				<!-- <div class="row"> -->
				<div class="col-sm-6 bass_textarea_01">
			                <div class="col-sm-6">
						<div class="icon">
							<img src="<?php print URI_PATH ; ?>/img/department/<?php print $id ; ?>.jpg" alt="Qrater" >
						</div>
					</div>
				<!-- </div> -->
				</div>
                <?php endif; ?>	

		   <?php echo $this->Form->input('Department.image', array('label' => false, 'type' => 'file', 'multiple')); ?>

                </div>
            

            <div class="row">
                <div class="col-sm-2">紹介文</div>
	  			<!-- <label for="body">紹介文：</label> -->
	  		<div class="col-sm-3 bass_textarea_01">
	  			<?php 
	  			echo $this->Form->input('Department.memo', array('type' => 'textarea'));
	  			?></div>
			</div>

  <div class="row">

            <div class="col-sm-2">表示有無</div>
            <div class="col-sm-2">


<?php echo $this->Form->input('Department.view_flag', array('label' => "表示する" ,  'type' => 'checkbox',));?>


<?php echo $this->form->hidden('Department.set_staff_id', array('value'=>$set_staff_id)); ?>
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
<?php echo $this->element('footer'); ?>



