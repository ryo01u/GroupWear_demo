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

// -->
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
  // -->
<div class="bass_maincontents_01">
    <div class="container">
        <div class="row">
            <p class="bass_title_01">取引先登録</p>
        </div>
         <div class="bass_sec_01">
        <div class="row">
            <p class="bass_title_02">追加／編集</p>
         </div>
    <div class="row">
                <div class="col-sm-12">
<!-- 追加編集フォーム -->

<?php echo $this->Form->create('Client', array('action'=>'post', 'url' =>  '/registclient/action' )); ?>


 </div>
    </div>
    <div class="row">
                <div class="col-sm-4">


<?php echo $this->Form->input('Client.id',  array('type' => 'hidden',  'value'=>$id)); ?>

 </div>
    </div>
    <div class="row">
                <div class="col-sm-4">
			   <?php echo $this->Form->input('Client.name',array('label'=>'取引先名','required' => false  )); ?>
			</div>
                <div class="col-sm-8">
			 	<?php // echo($errors["name"]["0"]) ; ?>
			 
 </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
	　　   <?php echo $this->Form->input('Client.client_department',array('label'=>'部署/課')); ?>
		</div>
    </div>
    <div class="row">
        <div class="col-sm-12">
	　　   <?php echo $this->Form->input('Client.intro',array('label'=> '紹介文' )); ?>
		</div>
    </div>
    <div class="row">
        <div class="col-sm-12">
	　　   <?php echo $this->Form->input('Client.adress',array('label'=>'住所')); ?>
		</div>
    </div>
    <div class="row">
        <div class="col-sm-12">
	　　   <?php echo $this->Form->input('Client.map',array('label'=>'地図')); ?>
		</div>
    </div>

    <!--<div class="row">
                <div class="col-sm-12">
		<?php	
			echo $this->Form->input( 'Client.akasatana', array(
			'label' => 'あかさたな', 
		    'type' => 'select', 
		    'options' => $akasatana
		    ));
			?>
			  
 </div>
    </div>-->
    <!--<div class="row">
                <div class="col-sm-12">
		<?php	
			echo $this->Form->input( 'Client.client_type', array(
			'label' => '種類', 
		    'type' => 'select', 
		    'options' => $client_type
		    ));
			?>
			  
 </div>
    </div>-->
    <div class="row">
                <div class="col-sm-12">
			   <?php echo $this->Form->input('Client.phone',array('label'=>'電話' )); ?>
			 	<?php // echo($errors["name"]["0"]) ; ?>
			 
 </div>
    </div>
    <!--<div class="row">
                <div class="col-sm-12">
			   <?php echo $this->Form->input('Client.mail',array('label'=>'メール' )); ?>
			 	<?php // echo($errors["name"]["0"]) ; ?>
			 
 </div>
    </div>-->
    <div class="row">
                <div class="col-sm-12">
			   <?php echo $this->Form->input('Client.memo',array(
			   'value' =>	$memo,
			   'label'=>'メモ(基本情報)',
			   'type' => 'textarea', 
			   'requierd' => 'false',
			   ));
			   ?>
			 	<?php // echo($errors["name"]["0"]) ; ?>
			 
 </div>
    </div>

<!--
    <div class="row">
                <div class="col-sm-12">
			【関連社員（弊社）選択	】<br />

			<?php foreach ($department as $row_department): ?>
				
				[<?php print $row_department["Department"]["name"] ; ?>]</br>
		
					<?php foreach ($group as $row_group): ?>
						<?php if ( $row_department["Department"]["id"] == $row_group["Group"]["department_id"] ): ?>
							
							・<?php print $row_group["Group"]["name"]; ?><br>
							<?php // print $row_group["Group"]["id"]; ?>
							
									<?php if ( isset($staffGroup)  ): ?>
										
									<?php foreach ($staffGroup as $row_staff_group): ?>
									
											<?php if ( $row_staff_group["sg"]["group_id"] == $row_group["Group"]["id"] ): ?>
												<?php $checked = null ; ?>
											<?php if ( isset($clientStaff)  ): ?>	
											<?php foreach ($clientStaff as $row_client_staff): ?>
												
												<?php if ( $row_client_staff["ClientStaff"]["staff_id"] == $row_staff_group["sg"]["staff_id"] ): ?>
													<?php
													$checked = "checked";
													break ;
													; ?>
												<?php endif; ?>
											<?php endforeach; ?>
											<?php endif; ?>	
												
													☆<?php print ( $row_staff_group["s"]["staff_name"]) ; ?>
						<input type="checkbox" name="data[ClientStaff][staff_id][]" value="<?php print $row_staff_group["sg"]["staff_id"]; ?>" <?php print $checked; ?> >
													<br>
													
											<?php endif; ?>					
									<?php endforeach; ?>
									
									<?php endif; ?>						
																							
						<?php endif; ?>
						
					<?php endforeach; ?>
				
			<?php endforeach; ?>

			
			<br />

			<!--
			<?php foreach ($staff as $row_staff): ?>
							<?php $checked = null ; ?>					
							<?php if (isset( $projectStaff)): ?>
								<?php foreach ($projectStaff as $row_project_staff): ?>
									<?php if ( $row_project_staff["ProjectStaff"]["staff_id"] == $row_staff["Staff"]["id"] ): ?>
										<?php
										$checked = "checked";
										break ;
										; ?>
														
									<?php endif; ?>
								<?php endforeach; ?>
							<?php endif; ?>
			<input type="checkbox" name="data[ProjectStaff][staff_id][]" value="<?php print $row_staff["Staff"]["id"]; ?>" <?php print $checked; ?> >
			<?php print $row_staff["Staff"]["name"]; ?><br />
		
			<?php endforeach; ?>
			

 </div>

    </div>

-->

    <!-- <div class="row">
        <div class="col-sm-12">
	　　   <?php echo $this->Form->input('Client.cont_memo',array('label'=>'コンタクト履歴')); ?>
		</div>
    </div>
    <div class="row">
        <div class="col-sm-12">
	　　   <?php echo $this->Form->input('Client.base_memo',array('label'=>'メモ')); ?>
		</div>
    </div> -->

        <div class="row">
		<?php echo $this->Form->input('Client.view_flag', array('label' => "表示" ,  'type' => 'checkbox',));?>
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



