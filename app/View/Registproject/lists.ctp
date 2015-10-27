<?php echo $this->element('header'); ?>
<script>

	function del($name,$id){
	
		// 「OK」時の処理開始 ＋ 確認ダイアログの表示
		if(window.confirm($name +'を削除します')){
			jQuery(function ($) {
			  $.post("/registproject/del/"+ $id);
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
            <p class="bass_title_01">案件登録画面</p>
        </div>
        <div class="bass_sec_01">
            <div class="row head_btn">
                <div class="col-sm-12 bass_btn">
<a href="<?php echo URI_PATH; ?>/registproject/action/">案件情報追加</a></div>
            </div>
            <div class="row head_row">
                <div class="col-sm-6 table">
                    <div class="cell p30">編集</div>
                    <div class="cell">プロジェクト名</div>
                </div>
                <div class="col-sm-6 table">

                    <div class="cell">契約登録</div>
                    <div class="cell">メモ登録</div>
                    <!-- <div class="cell">関係社員</div> -->
                    <div class="cell p30">削除</div>
                </div>
            </div>
	<?php foreach ($project as $row): ?>
            <div class="row">
                <div class="col-sm-6 table">
                    <div class="cell bass_btn p20"><a href="<?php echo URI_PATH; ?>/registproject/action/<?php echo $row['Project']['id']; ?>">
				編集</a></div>
                    <div class="cell">
				<?php echo $row['Project']['name']; ?></div>
                </div>

                <div class="col-sm-6 table">
                    <div class="cell">
			<a href="<?php echo URI_PATH; ?>/registprojectcontract/lists/?pid=<?php echo $row['Project']['id']; ?>">契約登録<br /></a>
	            </div>
                    <div class="cell">
			<a href="<?php echo URI_PATH; ?>/registprojectmemo/lists/?pid=<?php echo $row['Project']['id']; ?>">メモ登録<br /></a>
	            </div>

                <div class="cell bass_btn p30"> 

                    <!-- <div class="cell">
				<?php foreach ($projectStaffInfo as $row_projectStaff): ?>
			    
					<?php if ($row['Project']['id'] == $row_projectStaff["st"]["project_id"]): ?>
						<?php echo $row_projectStaff["s"]["staff_name"] ; ?><br>
					<?php endif; ?>
					
				<?php endforeach; ?>	
			</div> -->


			<a href="#"  onClick="del('<?php echo $row['Project']['name']; ?>', <?php echo $row['Project']['id']; ?>)" >削除<br /></a>

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