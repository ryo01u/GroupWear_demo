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


<script>
	jQuery(function ($) {
		// 要素を移動する関数（まだ仮） */
		function moveOption(event) {
			$("#" + event.data.from + " option:selected").each(function () {
				$(this).appendTo($("#" + event.data.to));
				$(this).prop("selected", true);// 選択状態の解除
			});
		}

		// 「カートへ→」ボタンのクリック時
		$("#move_right_s").on("click", {from: "staff", to: "select_staff"}, moveOption);

		// 「←棚へ戻す」ボタンのクリック時
		$("#move_left_s").on("click", {from: "select_staff", to: "staff"}, moveOption);

		// 「カートへ→」ボタンのクリック時
		$("#move_right_c").on("click", {from: "client", to: "select_client"}, moveOption);

		// 「←棚へ戻す」ボタンのクリック時
		$("#move_left_c").on("click", {from: "select_client", to: "client"}, moveOption);


		// 送信時は、「カート」側のオプションを選択状態にする
		$("#form1").on("submit", function (event) {
			$("#cart").children().prop("selected", true);
		});
	});

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
            <p class="bass_title_01">案件登録</p>
        </div>
         <div class="bass_sec_01">
        <div class="row">
            <p class="bass_title_02">追加／編集</p>
         </div>
<!--     <div class="row">
                <div class="col-sm-12"> -->

<!-- 追加編集フォーム -->

<?php echo $this->Form->create('Staff', array('action'=>'post', 'url' =>  '/registproject/action' )); ?>

<!-- </div>
    </div> --><?php echo $this->Form->input('Project.id',  array('type' => 'hidden',  'value'=>$id)); ?>
    <div class="row">




<!--     </div>
    <div class="row"> -->
<div class="col-sm-2 ">
	案件名</div>
                <div class="col-sm-6 bass_textarea_01">
			   <?php echo $this->Form->input('Project.name',array('required' => false  )); ?>
			 	<?php // echo($errors["name"]["0"]) ; ?>
</div>
    </div>

<!-- 
   <div class="row">
                <div class="col-sm-4">

	        <?php
	            echo $this->Form->input( 'Project.project_group_id', array(
	            'label' => 'グループ',
	            'type' => 'select',
	            'options' => $projectgroup
	            ));
	        ?>

		</div>
    </div>
 -->

   <!-- <div class="row">
                <div class="col-sm-4">
		<?php	
			echo $this->Form->input( 'Project.akasatana', array(
			'label' => 'あかさたな', 
		    'type' => 'select', 
		    'options' => $akasatana
		    ));
			?>
		</div>
    </div> -->

    <div class="row">
            <div class="col-sm-2">
			得意先選択
			</div>
            <div class="col-sm-6">
			<select name="data[ProjectClient][regular_client_id]">
				<option value=""></option>

				<?php foreach ($client as $row): ?>
					<?php $exist = False; ?>

					<?php foreach ($projectClientRegular as $row_project_client_regular): ?>
						<?php if ( $row["Client"]['id'] == $row_project_client_regular["ProjectClient"]["client_id"]): ?>
							<?php $exist = True; ?>
						<?php endif; ?>
					<?php endforeach; ?>					
					<?php if ( $exist == True): ?>
						<option value="<?php echo $row["Client"]['id']; ?>" selected><?php echo $row["Client"]['name']; ?></option> 
					<?php else: ?>
						<option value="<?php echo $row["Client"]['id']; ?>"><?php echo $row["Client"]['name']; ?></option> 
					<?php endif; ?>

				<?php endforeach; ?>
			</select>

					
			</div>
    </div>


    <div class="row content_row table"><div class="col-sm-2 t_r">
			仕入れ先選択</div>
                <div class="col-sm-4 col-xs-5">
                	
			<select id="client" multiple="multiple" size="5">
							
				<?php foreach ($client as $row): ?>
					<?php $exist = False; ?>

					<?php foreach ($projectClient as $row_project_client): ?>
						<?php if ( $row["Client"]['id'] == $row_project_client["ProjectClient"]["client_id"]): ?>
							<?php $exist = True; ?>
						<?php endif; ?>
					<?php endforeach; ?>					
					<?php if ( $exist == False): ?>
						<option value="<?php echo $row["Client"]['id']; ?>"><?php echo $row["Client"]['name']; ?></option> 
					<?php endif; ?>
				<?php endforeach; ?>
			</select></div>
			<div class="col-sm-1 col-xs-2">
			<input type="button" id="move_right_c" value="≫">
			<input type="button" id="move_left_c" value="≪">
			</div>
                <div class="col-sm-4 col-xs-5">
			<select id="select_client" name="data[ProjectClient][client_id][]" multiple="multiple" size="5">

				<?php if ($projectClient): ?>
					<?php foreach ($projectClient as $row_project_client): ?>
						<option value="<?php echo $row_project_client["ProjectClient"]["client_id"]; ?>" selected>
							<?php echo $client_array[$row_project_client["ProjectClient"]["client_id"]]; ?>
						</option> 						
					<?php endforeach; ?>
				<?php endif; ?>
			</select>                	
   		</div><div class="col-sm-1"></div>
    </div>




   <!--  <div class="row">
        <div class="col-sm-6">担当グループ</div>
          <div class="col-sm-6 bass_select_01">
        <?php
            echo $this->Form->input( 'Project.group_id', array(
            'label' => 'グループ',
            'type' => 'select',
            'options' => $department
            ));
            ?>
        　　</div>
    </div> -->

    <!-- <div class="col-sm-12">
	<?php	
		echo $this->Form->input( 'Project.states', array(
		'value' =>	$states,
		'label' => '契約情報', 
	    'type' => 'textarea', 
	    'requierd' => 'false',
	    ));
		?>
	</div> -->
<div class="row"><div class="col-sm-2">リンク</div>
            <div class="col-sm-6">
	<?php	
		echo $this->Form->input( 'Project.markets', array(
		'value' =>	$markets,
		'label' => false, 
	    'type' => 'textarea', 
	    'requierd' => 'false',
	    ));
		?>
	</div></div>

	<!-- div class="col-sm-12">
	<?php	
		echo $this->Form->input( 'Project.memo', array(
		'value' =>	$plane_memo,
		'label' => '簡易スケジュールメモ', 
	    'type' => 'textarea', 
	    'requierd' => 'false',
	    ));
		?>
	</div> -->

    <div class="row">
    	<div class="col-sm-2">種類</div>
                <div class="col-sm-6">
		<?php	
			echo $this->Form->input( 'Project.project_type', array(
			'label' => false, 
		    'type' => 'select', 
		    'options' => $project_type
		    ));
			?>
</div>
    </div>




<div class="row content_row table">  <div class="col-sm-2 t_r ">
			担当者選択</div>
                <div class="col-sm-4 col-xs-5">
			<select id="staff" multiple="multiple" size="5">
				<?php foreach ($staff as $row): ?>
					<?php $exist = False; ?>
					<?php if ($projectStaff): ?>
						<?php foreach ($projectStaff as $row_project_staff): ?>
							<?php if ( $row['Staff']['id'] == $row_project_staff["ProjectStaff"]["staff_id"]): ?>
								<?php $exist = True; ?>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
									
					<?php if ( $exist == False): ?>
						<option value="<?php echo $row['Staff']['id']; ?>"><?php echo $row['Staff']['name']; ?></option> 
					<?php endif; ?>
				<?php endforeach; ?>
			</select>

			
		</div>
			<div class="col-sm-1 col-xs-2">
		<input type="button" id="move_right_s" value="≫">
			<input type="button" id="move_left_s" value="≪">
			</div>
                <div class="col-sm-4 col-xs-5">	
			<select id="select_staff" name="data[ProjectStaff][staff_id][]" multiple="multiple" size="5">

				<?php if ($projectStaff): ?>

					<?php foreach ($projectStaff as $row_project_staff): ?>
						<?php if (isset($staff_array[$row_project_staff["ProjectStaff"]["staff_id"]] )): ?>
						<option value="<?php echo $row_project_staff["ProjectStaff"]["staff_id"]; ?>" selected>
						
							<?php echo $staff_array[$row_project_staff["ProjectStaff"]["staff_id"]]; ?>
							
						</option>
						<?php endif; ?>
					<?php endforeach; ?>
					
				<?php endif; ?>
			</select>       


			<!--
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
											<?php if ( isset($projectStaff)  ): ?>	
											<?php foreach ($projectStaff as $row_project_staff): ?>
												<?php if ( $row_project_staff["ProjectStaff"]["staff_id"] == $row_staff_group["sg"]["staff_id"] ): ?>
													<?php
													$checked = "checked";
													break ;
													; ?>
												<?php endif; ?>
											<?php endforeach; ?>
											<?php endif; ?>	
												
													☆<?php print ( $row_staff_group["s"]["staff_name"]) ; ?>
						<input type="checkbox" name="data[ProjectStaff][staff_id][]" value="<?php print $row_staff_group["sg"]["staff_id"]; ?>" <?php print $checked; ?> >
													<br>
													
											<?php endif; ?>					
									<?php endforeach; ?>
									
									<?php endif; ?>						
																							
						<?php endif; ?>
						
					<?php endforeach; ?>
				
			<?php endforeach; ?>
			-->
			
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
			-->
 </div> <div class="col-sm-1"></div>
    </div>


        <div class="row">

        	<div class="col-sm-2">表示有無</div>
        	<div class="col-sm-2">
		<?php echo $this->Form->input('Project.view_flag', array('label' => "表示する" ,  'type' => 'checkbox',));?>
	</div>
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




