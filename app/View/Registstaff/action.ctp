<?php echo $this->element('header'); ?>
<?php echo $this->element('head'); ?>
<?php echo $this->element('navi'); ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>

<script type="text/javascript">
<!--

function disp(){

	// 「OK」時の処理開始 ＋ 確認ダイアログの表示
	if(window.confirm('本当にいいんですね？')){
		location.href = "/registstaff/action"; // example_confirm.html へジャンプ
	}
	// 「OK」時の処理終了
	// 「キャンセル」時の処理開始
	else{
		//window.alert('キャンセルされました'); // 警告ダイアログを表示
	}
	// 「キャンセル」時の処理終了

}

 //-->
</script>

<!--
<?php
// 営業所切り替えのJS
$this->Js->get('#StaffDepartmentId')->event(
    'change',
    $this->Js->request(
        array('controller'=>'Registstaff','action'=>'ajax_group'),//url
        array(
            'update' => '#StaffGroupId',
            'dataExpression' => true,
            'data' => '$("#StaffDepartmentId").serialize()',
		'complete' => '$("#StaffGroupId").change();'     //営業所を選んだら担当者も変える
       )
    )
);

echo $this->Js->writeBuffer();
?>
   //-->

<div class="bass_maincontents_01">
    <div class="container">
        <div class="row">
            <p class="bass_title_01">社員登録</p>
        </div>
         <div class="bass_sec_01">
        <div class="row">
            <p class="bass_title_02">追加／編集</p>
         </div>
    <!-- <div class="row">
                <div class="col-sm-12"> -->



<!-- 追加編集フォーム -->

<?php echo $this->Form->create('Staff', array('action'=>'post', 'url' =>  '/registstaff/action' , 'enctype' => 'multipart/form-data' ) ); ?>
<?php echo $this->Form->input('Staff.id',  array('type' => 'hidden',  'value'=>$id)); ?>

<!--  </div>
    </div> -->

    <!-- <div class="row">
                <div class="col-sm-12"> -->
<!--  </div>
    </div> -->
    <div class="row">
                <div class="col-sm-2">氏名</div>
			   <div class="col-sm-6 bass_textarea_01">
			 	<?php // echo($errors["name"]["0"]) ; ?>
			   <?php echo $this->Form->input('Staff.name',array('label'=>'',
			   'required' => false  )); ?>
			</div>
    </div>
    <div class="row">

    <div class="row">
    	<div class="col-sm-2">姓</div>
                <div class="col-sm-3  bass_textarea_01">
			   <?php echo $this->Form->input('Staff.last_name',array('label'=>false,'required' => false  )); ?>

		</div><div class="col-sm-2">名</div>
                <div class="col-sm-3  bass_textarea_01">
			   <?php echo $this->Form->input('Staff.first_name',array('label'=>false,'required' => false  )); ?>
		</div>
    </div>
    <div class="row">


    <div class="row"><div class="col-sm-2">姓(かな）</div>
                <div class="col-sm-3  bass_textarea_01">
			   <?php echo $this->Form->input('Staff.last_name_kana',array('label'=>false,'required' => false  )); ?>

		</div><div class="col-sm-2">名(かな）</div>
                <div class="col-sm-3  bass_textarea_01">
			   <?php echo $this->Form->input('Staff.first_name_kana',array('label'=>false,'required' => false  )); ?>
		</div>
    </div>
    <div class="row">




       <div class="col-sm-2">アカウント</div>
			   <div class="col-sm-6 bass_textarea_01">
		<?php
			echo $this->Form->input( 'Staff.account', array(
			'label' => false,
		    'type' => 'text',
		    'requierd' => 'false',
		    ));
			?>
		</div>
    </div>
    <div class="row">
        <div class="col-sm-2">パスワード</div>
			   <div class="col-sm-6 bass_textarea_01">
		<?php
			echo $this->Form->input( 'Staff.password', array(
			'label' => false,
		    'type' => 'text',
		    'requierd' => 'false',
		    ));
			?>
		</div>
    </div>


    <div class="row">
        <div class="col-sm-12">
		<!--グループ-->
		<tr>
			<th width="170">
			<td>
			所属グループ選択<Br>
			<?php foreach ($department as $row_department): ?>
				</br><?php print $row_department["Department"]["name"] ; ?></br>

					<?php foreach ($group as $row_group): ?>
						<?php if ( $row_department["Department"]["id"] == $row_group["Group"]["department_id"] ): ?>

							<?php $checked = null ; ?>

							<?php foreach ($staffGroup as $row_staff_group): ?>
								<?php if ( $row_staff_group["StaffGroup"]["group_id"] == $row_group["Group"]["id"] ): ?>
									<?php
									$checked = "checked";
									break ;
									; ?>

								<?php endif; ?>
							<?php endforeach; ?>

							 <div class="col-sm-2"></div>
							<input type="checkbox" name="data[StaffGroup][group_id][]" value="<?php print $row_group["Group"]["id"]; ?>" <?php print $checked; ?> >
							<?php print $row_group["Group"]["name"]; ?><br>


						<?php endif; ?>

				<?php endforeach; ?>

			<?php endforeach; ?>
			</td>
		</tr>


		</div>
    </div>


            <div class="row">
                <div class="col-sm-2">画像</div>
                <div class="col-sm-6">

            	<?php if (file_exists( WWW_ROOT  . "img" . "/staff/" . $id . ".jpg")): ?>
			                <div class="col-sm-6">
						<div class="icon">
							<img src="<?php print URI_PATH ; ?>/img/staff/<?php print $id ; ?>.jpg" alt="Qrater" >
						</div>
					</div>
                <?php endif; ?>

		   <?php echo $this->Form->input('Staff.image', array('label' => false, 'type' => 'file', 'multiple')); ?>
		</div>

            </div>

    <div class="row">
        <div class="col-sm-2">性別</div>
                <div class="col-sm-1">
		<?php
			echo $this->Form->input( 'Staff.sex', array(
			'label' => false,
		    'type' => 'select',
		    'options' => $sex
		    ));
			?>
		</div>
    </div>



    <div class="row">

        <div class="col-sm-2">仕事内容</div>
                <div class="col-sm-6 bass_textarea_01">
		<?php
			echo $this->Form->input( 'Staff.job_item', array(
			'label' => false,
		    'type' => 'text',
		    ));
			?>
		</div>
    </div>
    <div class="row">
                <div class="col-sm-2">職種</div>
                <div class="col-sm-6">
		<?php
			echo $this->Form->input( 'Staff.job', array(
			'label' => false,
		    'type' => 'select',
		    'options' => $job
		    ));
			?>
		</div>
    </div>
    <div class="row">

                <div class="col-sm-2">役職</div>
                <div class="col-sm-6">
		<?php
			echo $this->Form->input( 'Staff.position_id', array(
			'label' => false,
		    'type' => 'select',
		    'options' => $position
		    ));
			?>
		</div>
    </div>

    <div class="row">

                <div class="col-sm-2">内線番号</div>
                <div class="col-sm-6 bass_textarea_01">
		<?php
			echo $this->Form->input( 'Staff.extension_number', array(
			'label' => false,
		    'type' => 'text',
		    'requierd' => 'false',
		    ));
			?>
		</div>
    </div>


    <div class="row">
       <div class="col-sm-2">メールアドレス</div>
       <div class="col-sm-6 bass_textarea_01">
		<?php
			echo $this->Form->input( 'Staff.mail_address', array(
			'label' => false,
		    'type' => 'text',
		    'requierd' => 'false',
		    'default' => '@gigno.co.jp'
		    ));
			?>
		</div>
    </div> <div class="row">
    <div class="col-sm-2">紹介文</div>
       <div class="col-sm-2 bass_textarea_01">
	<?php
		echo $this->Form->input( 'Staff.memo', array(
		'label' => false,
	    'type' => 'textarea',
	    'default' => '入力して下さい',
	    'requierd' => 'false',
	    ));
		?>
	</div></div> <div class="row">
    <div class="col-sm-2">プロフィール</div>
       <div class="col-sm-3 bass_textarea_01">
	<?php
		echo $this->Form->input( 'Staff.profile', array(
		'default' =>	$profile,
		'label' => false,
	    'type' => 'textarea',
	    'requierd' => 'false',
	    ));
		?>
	</div></div>

         <div class="row">
        	<div class="col-sm-2">表示有無</div><div class="col-sm-2">
		<?php echo $this->Form->input('Staff.view_flag', array('label' => "表示" ,  'type' => 'checkbox',));?></div>
	</div>


            <div class="row">
                <div class="col-sm-12 bass_btn">
            <input type="submit" value="登録">
        </div>
    </div>

</form>

<!-- 追加編集フォーム -->

            </div>
        </div>
        </div>
<?php echo $this->element('footer'); ?>

