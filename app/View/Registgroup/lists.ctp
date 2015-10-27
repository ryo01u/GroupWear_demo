<?php echo $this->element('header'); ?>

<script>

	function del($name,$id){
	
		// 「OK」時の処理開始 ＋ 確認ダイアログの表示
		if(window.confirm($name +'を削除します')){
			jQuery(function ($) {
			  $.post("/registgroup/del/"+ $id);
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
                部署グループ登録画面</p>
        </div>
        <div class="bass_sec_01">
            <div class="row head_btn">
                <div class="col-sm-12 bass_btn"><a href="<?php echo URI_PATH; ?>/registgroup/action/">グループ追加</a><br>
                </div>
            </div>
            <div class="row head_row">
                <div class="col-sm-6 table">
                    <div class="cell icon p15">編集</div>
                    <div class="cell">部署</div>
                </div>
                <div class="col-sm-6 table">
                    <div class="cell">グループ</div>
                    <div class="cell p40">削除</div>
                </div>
            </div><?php foreach ($group as $row): ?>
            <div class="row">
                <div class="col-sm-6 table">
                    <div class="cell bass_btn p20"><a href="<?php echo URI_PATH; ?>/registgroup/action/<?php echo $row['Group']['id']; ?>">編集</a></div>
                        <div class="cell"><?php echo $department[$row['Group']['department_id']]; ?></div>
                    </div>
                    <div class="col-sm-6 table">
                        <div class="cell"><?php echo $row['Group']['name']; ?></div>

	<div class="cell bass_btn p40"><a href="#"  onClick="del('<?php echo $row['Group']['name']; ?>', <?php echo $row['Group']['id']; ?>)" >削除<br /></a></div>


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
