<?php echo $this->element('header'); ?>

<script>

	function del($name,$id){
	
		// 「OK」時の処理開始 ＋ 確認ダイアログの表示
		if(window.confirm($name +'を削除します')){
			jQuery(function ($) {
			  $.post("/registstaff/del/"+ $id);
			});
			alert($name + "を削除しました");
			location.reload();
		}
		// 「キャンセル」時の処理開始
		else{
			window.alert('キャンセルされました'); // 警告ダイアログを表示
		}
	}
</script>


<?php echo $this->element('head'); ?>
<?php echo $this->element('navi'); ?>

<div class="bass_maincontents_01">
    <div class="container">
        <div class="row">
            <p class="bass_title_01">
	社員登録画面</p>
        </div>
        <div class="bass_sec_01">
            <div class="row head_btn">
                <div class="col-sm-12 bass_btn"><a href="<?php echo URI_PATH; ?>/registstaff/action/">社員追加</a>
                </div>
            </div>
            <div class="row head_row">
                <div class="col-sm-6 table">
                    <div class="cell icon p15">編集</div>
                    <div class="cell icon p15">男/女</div>
                    <div class="cell p35">社員名</div>
                    <div class="cell p35">グループ</div>
                </div>
                <div class="col-sm-6 table">
                    <div class="cell p40">役職</div>
                    <!--<div class="cell p40">職種</div>-->
                    <div class="cell p20">削除</div>
                </div>
            </div>
            <?php foreach ($staff as $row): ?>           
           <div class="row">
                <div class="col-sm-6 table">
                    <div class="cell bass_btn p20"><a href="<?php echo URI_PATH; ?>/registstaff/action/<?php echo $row['Staff']['id']; ?>">編集</a></div>
				    <?php if ($row['Staff']['sex']): ?>
                    	<div class="cell icon p15"><?php echo $sex[$row['Staff']['sex']]; ?></a></div>
                    <?php endif; ?>
                    <div class="cell p35"><?php echo $row['Staff']['name']; ?></a></div>
                    <div class="cell p35"><?php foreach ($staffGroupInfo as $row_staffGroup): ?>
			    
					<?php if ($row['Staff']['id'] == $row_staffGroup["sg"]["staff_id"]): ?>
						
						<?php echo $row_staffGroup["d"]["department_name"] ; ?>:<?php echo $row_staffGroup["g"]["group_name"] ; ?>
					<?php endif; ?>
					
				<?php endforeach; ?></a></div>
                </div>
                <div class="col-sm-6 table">
                    
                    <?php if ($row['Staff']['position_id']): ?>
                    <div class="cell p40">
                    <?php // var_dump($position); ?>
                    	<?php echo $position[$row['Staff']['position_id']]; ?></a>
                    </div>
                    <?php endif; ?>
                    <div class="cell p40">
                    	<!--<?php echo $job[$row['Staff']['job']]; ?></a>-->
                    </div>
                    <div class="cell bass_btn p20"> 
			<a href="#"  onClick="del('<?php echo $row['Staff']['name']; ?>', <?php echo $row['Staff']['id']; ?>)" >削除<br /></a>
                    </div>

                </div>
            </div>
            <?php endforeach; ?>

                <div class="row">
                    <div class="col-sm-12 page_nav">
                        <div><?php echo $this->Paginator->prev('< 前へ', array(), null, array('class' => 'prev disabled')); ?></div>
                        <div><?php echo $this->Paginator->numbers(array('separator' => '')); ?></div>
                        <div><?php echo $this->Paginator->next('次へ >', array(), null, array('class' => 'next disabled')); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php echo $this->element('footer'); ?>