<?php echo $this->element('header'); ?>
<?php echo $this->element('head'); ?>
<?php echo $this->element('navi'); ?>
<div class="bass_maincontents_01">
    <div class="container">
        <div class="row">
            <p class="bass_title_01">お知らせ登録</p>
        </div>
         <div class="bass_sec_01">
        <div class="row">
            <p class="bass_title_02">お知らせ追加</p>
            </div>

    <?php echo $this->Form->create('News', array('action'=>'post', 'url' => '/registnews/action' )); ?>
            <div class="row">
                <div class="col-sm-2">NEWS TITLE</div>
                <div class="col-sm-6 bass_textarea_01">
				<?php echo $this->Form->input('News.name',array('type' => 'text','label'=> false,'required' => false  )); ?>
                </div>
            </div>

	<?php echo $this->form->hidden('News.set_staff_id', array('value'=>$set_staff_id)); ?>

    <?php echo $this->Form->input('News.id',  array('type' => 'hidden',  'value'=>$id)); ?>


		<div class="row">
                <div class="col-sm-2">種類</div>
                <div class="col-sm-6 bass_textarea_01">
		<?php
			echo $this->Form->input( 'News.news_type', array(
			'label' => false,
		    'type' => 'select',
		    'options' => $news_type
		    ));
			?></div></div>
<div class="row">
                <div class="col-sm-2">内容</div>
                <div class="col-sm-3 bass_textarea_01">
			

	  			<?php
	  			echo $this->Form->input('News.body', array('type' => 'textarea'));
	  			?>
			</div></div>

<div class="row">
  <div class="col-sm-2">登録日時</div>
<div class="col-sm-6 bass_textarea_01">
  <?php echo $this->Form->input('News.modified',array('type' => 'text','label'=>false,'required' => false , 'default' => date("Y-m-d") . ' 00:00:00'
  )); ?>
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



