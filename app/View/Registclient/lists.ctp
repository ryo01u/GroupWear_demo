<?php echo $this->element('header'); ?>

<script>

	function del($name,$id){
	
		// 「OK」時の処理開始 ＋ 確認ダイアログの表示
		if(window.confirm($name +'を削除します')){
			jQuery(function ($) {
			  $.post("/registclient/del/"+ $id);
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
            <p class="bass_title_01">取引先登録画面</p>
        </div>
        <div class="bass_sec_01">
            <div class="row head_btn">
                <div class="col-sm-12 bass_btn">
<a href="<?php echo URI_PATH; ?>/registclient/action/">取引先追加</a></div>
            </div>
            <div class="row head_row">
                <div class="col-sm-6 table">
                    <div class="cell p15">取引先ＩＤ</div>
                    <div class="cell">取引先名</div>
                    <div class="cell">関係社員（弊社）</div>
                </div>
                <div class="col-sm-6 table">
                    <div class="cell">コンタクト履歴</div>
                    <div class="cell">取引先メモ追加</div>
                    <div class="cell p30">削除</div>
                </div>
            </div>


	<?php foreach ($client as $row): ?>
            <div class="row">
                <div class="col-sm-6 table">
                    <div class="cell bass_btn p15"><a href="<?php echo URI_PATH; ?>/registclient/action/<?php echo $row['Client']['id']; ?>">
				編集</a></div>
                    <div class="cell"><?php echo $row['Client']['name']; ?></div>
                    <div class="cell p40"><?php foreach ($clientStaffInfo as $row_clientStaff): ?>
                
                    <?php if ($row['Client']['id'] == $row_clientStaff["cs"]["client_id"]): ?>
                        <?php echo $row_clientStaff["s"]["staff_name"] ; ?>
                    <?php endif; ?>
                    
                <?php endforeach; ?></div>
                </div>
                <div class="col-sm-6 table">
                    <div class="cell  bass_btn"><a href="<?php echo URI_PATH; ?>/registcontact/lists/<?php echo $row['Client']['id']; ?>">コンタクト履歴追加</a></div>
                    <div class="cell  bass_btn"><a href="<?php echo URI_PATH; ?>/registclientmemo/lists/<?php echo $row['Client']['id']; ?>">取引先メモ追加</a></div>


                    <div class="cell bass_btn p30"> 
			<a href="#"  onClick="del('<?php echo $row['Client']['name']; ?>', <?php echo $row['Client']['id']; ?>)" >削除</a>
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