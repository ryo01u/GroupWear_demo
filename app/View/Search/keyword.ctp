<?php echo $this->element('header'); ?>

<script>
	function mypage_add($mypage_kbn, $page_id , $user_id){

	
		// 「OK」時の処理開始 ＋ 確認ダイアログの表示
		if(window.confirm('このページをホームへ登録しますか？')){
			jQuery(function ($) {
			  $.post("<?php echo URI_PATH; ?>/mypage/mypageadd/"+ $mypage_kbn + "/" + $page_id + "/" + $user_id);
			});
			//alert("登録完了しました");
		
		}
		// 「OK」時の処理終了
		// 「キャンセル」時の処理開始
		else{
			window.alert('キャンセルされました'); // 警告ダイアログを表示
		}
		// 「キャンセル」時の処理終了
	}
</script>



<?php echo $this->element('head'); ?>
<?php echo $this->element('navi'); ?>



<div class="bass_maincontents_01">
    <div class="container keyword">
        <div class="row">
            <p class="bass_title_03">キーワード検索</p>
        </div>

      <form action="<?php echo URI_PATH; ?>/search/keyword" id="SearchGETForm" method="get" accept-charset="utf-8">
     	
            <div class="search_wrap">
                <div class="row text_input_wrap">
                    <div class="col-sm-10 col-xs-10 text_input">

                        <input type="text" name="keyword" value="<?php  if(isset($keyword)){ echo trim($keyword) ; }   ?>  " >
                        
                    </div>

                    <div class="col-sm-2 col-xs-2 serch_btn">
                        <input type="submit" value="検索">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <span class="serch_toggle">▼さらに細かく<span>
                    </div>
                </div>
                <div class="search_area">
                    <div class="row">
                        <div class="col-sm-12">
                            <p>検索対象</p>
                        </div>
                    </div>
                    <div class="row">
                 	                    	
                        <div class="col-sm-3 col-xs-6">
                            <label><input type="checkbox" name="s_v" <?php print $staff_search_checked ?>  >スタッフ</label>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <label><input type="checkbox" name="c_v" <?php print $client_search_checked ?>  >取引先</label>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <label><input type="checkbox" name="p_v" <?php print $project_search_checked ?>  >案件</label>
                        </div>
                    </div>
                </div>

                <div class="search_area">
                    <div class="row">
                        <div class="col-sm-12">
                            検索対象
                        </div>
                    </div>
                    <div class="row">

                    <?php foreach ($department_array as $row): ?>
             			<?php $checked = ""; ?>

					 	<?php if (isset($department_by_groupId)): ?>
									<?php if ($row["Department"]["id"] == $department_by_groupId["Group"]["department_id"]): ?>
										<?php $checked = "checked"; ?>
									<?php endif; ?>

						<?php else: ?>
		 					 		
					 		<?php if ($param_department_array): ?>
					 					
						 		<?php foreach ($param_department_array as $set_row): ?>
						 			
									<?php if ($set_row ==  $row["Department"]["id"]): ?>
										<?php $checked = "checked"; ?>
									<?php endif; ?>
								<?php endforeach; ?>
								
							<?php else: ?>
								<?php $checked = "checked"; ?>
								
							<?php endif; ?>
							
						<?php endif; ?>

             			       		
                        <div class="col-sm-3 col-xs-6">
                            <label>
                            	<input type="checkbox" name="d[]" value="<?php print $row["Department"]["id"]; ?>"  <?php print $checked; ?> >
                            	<?php print $row["Department"]["name"]; ?>		
                            </label>
                        </div>
                    <?php endforeach; ?>    
                    </div>
                    
                </div>


                <div class="row table_opt">
                    <div class="col-sm-2 no_all">

		<?php if ($this->Paginator->params()): ?>
			<?php  echo $this->Paginator->counter(array('format' => '全%count%件' ));?>
			<?php echo $this->Paginator->counter(array('format' => '{:page}/{:pages}'));?>
		 <?php endif; ?>                          
                        
                    </div>
                    <div class="col-sm-3 col-xs-6">
						<select name="order">
							<option value="type" <?php print $type_selected ;?> >種別</option>
							<option value="name" <?php print $name_selected  ;?>>名前(昇順)</option>
							<option value="akasatana" <?php print $akasatana_selected;?> >あいうえお順</option>
							<option value="created" <?php print $created_selected;?> >作成順</option>
						</select>
                    </div>

                </div>

             
         </form>
                
			<?php if ( isset( $search_array)): ?>
                
                <table cellspacing="0" cellpadding="0" border="0" class="tbl-search">
                    <tr>
                        <th></th>
                        <th>名前</th>
                        <th>種別</th>
                        <th>部署</th>
                        <th>グループ</th>
                        <th>担当</th>
                        <th></th>
                    </tr>
                    
					<?php foreach ($search_array as $row): ?>
						<?php if ($row["Some"]["type"] == "p"): ?>
		                    <tr>
		                        <td><?php echo $this->Util->getImageTag("project" , $row["Some"]["id"]) ?></td>



		                        <td>
					<a href="<?php echo URI_PATH; ?>/project/detail/<?php print $row["Some"]["id"]  ;?>">
					<?php print $project_array[$row["Some"]["id"]]["name"] ;?>
					</a>
					</td>
		                        <td>プロジェクト</td>
		                        <td>


		                        	<?php if(isset($project_array[$row["Some"]["id"]]["departments"])): ?>
				                        <?php foreach ($project_array[$row["Some"]["id"]]["departments"] as $project_department): ?>
				                        	<a href="<?php echo URI_PATH; ?>/department/detail/<?php echo $project_department["id"] ;?>">
								<?php print $project_department["name"]  ;?>
								</a><br>
				                        <?php endforeach; ?>
			                        <?php endif; ?>
		                        </td>
		                        
	                        	<td>
	                        	<?php if(isset($project_array[$row["Some"]["id"]]["groups"])): ?>	
			                        <?php foreach ($project_array[$row["Some"]["id"]]["groups"] as $project_group): ?>	
			                        	<a href="<?php echo URI_PATH; ?>/group/detail/<?php echo $project_group["id"] ;?>">
								<?php print $project_group["name"]  ;?>
							</a><br>
			                        <?php endforeach; ?>
			                    <?php endif; ?> 
	                        	</td>
	                        	
		                        <td>
	                        	<?php if(isset($project_array[$row["Some"]["id"]]["staffs"])): ?>
			                        <?php foreach ($project_array[$row["Some"]["id"]]["staffs"] as $project_staff): ?>	
			                        	<a href="<?php echo URI_PATH; ?>/staff/detail/<?php print $project_staff["id"] ;?>">
								<?php print $project_staff["name"] ;?>
							</a><br>
			                        <?php endforeach; ?>
			                    <?php endif; ?>		                        	
		                        	</td>
		                        <td>
		                            <div class="btn_cell">
		                            <span class="bass_btn">
		                            	<a href="<?php print URI_PATH ;?>/project/detail/<?php print $row["Some"]["id"] ;?>">詳細 </a>
		                            </span>
		                            </div>
		                            <div class="btn_cell">
			                            <span class="bass_btn">

<span class="bass_btn col-sm-3 col-xs-5"><a onClick="mypage_add(<?php echo MYPAGE_PROJECT; ?>,<?php print $row["Some"]["id"] ;?>,<?php echo $user_id; ?>)">ホームに追加</a></span>

			                            </span>
		                            </div>
		                        </td>
		                    </tr>
		                <?php endif; ?>

						<?php if ($row["Some"]["type"] == "s"): ?>
		                    <tr>
		                        <td>
		                        <?php if(isset($row["Some"]["id"])): ?>	
		                        	<?php echo $this->Util->getImageTag("staff" , $row["Some"]["id"])  ?>
		                        <?php endif; ?>
		                        </td>
		                        <td>
		                        <?php if(isset($row["Some"]["id"])): ?>
						<a href="<?php echo URI_PATH; ?>/staff/detail/<?php print $row["Some"]["id"]  ;?>">	
		                        		<?php print $staff_array[$row["Some"]["id"]]["name"] ;?>
						</a>
		                        <?php endif; ?>	
		                        </td>
		                        <td>スタッフ</td>
		                        <td>
		                        <?php if(isset($row["Some"]["id"])): ?>	
			                        <?php if(isset($staff_array[$row["Some"]["id"]]["departments"])): ?>	
				                        <?php foreach ($staff_array[$row["Some"]["id"]]["departments"] as $staff_department): ?>
								<a href="<?php echo URI_PATH; ?>/department/detail/<?php echo $staff_department["department_id"] ;?>">
				                        	<?php print $staff_department["department_name"]  ;?>
								</a><br>
				                        <?php endforeach; ?>
				                    <?php endif; ?>
				                <?php endif; ?>    
		                        </td>
		                        <td>
			                    <?php if(isset($row["Some"]["id"])): ?>
			                        <?php if(isset($staff_array[$row["Some"]["id"]]["groups"])): ?>
			                        		                        	
				                        <?php foreach ($staff_array[$row["Some"]["id"]]["groups"] as $staff_group): ?>
				                        	<a href="<?php echo URI_PATH; ?>/group/detail/<?php echo $staff_group["group_id"] ;?>">
								<?php print $staff_group["group_name"]  ;?>
								</a><br>
				                        <?php endforeach; ?>
				                    <?php endif; ?>			                        
		                        <?php endif; ?>    
		                        </td>
		                        <td>-</td>
		                        <td>
		                            <div class="btn_cell">
		                            <span class="bass_btn">
		                            	<?php if(isset($row["Some"]["id"])): ?>
		                               		<a href="<?php print URI_PATH ;?>/staff/detail/<?php print $row["Some"]["id"] ;?>">詳細 </a>
		                                <?php endif; ?>
		                            </span>
		                            </div>
		                            <div class="btn_cell">
			                            <span class="bass_btn">
			                            	<?php if(isset($row["Some"]["id"])): ?>

	<span class="bass_btn col-sm-3 col-xs-5"><a onClick="mypage_add(<?php echo MYPAGE_STAFF; ?>,<?php print $row["Some"]["id"] ;?>,<?php echo $user_id; ?>)">ホームに追加</a></span>

			                            	<?php endif; ?>
			                            </span>
		                            </div>

		                        </td>
		                    </tr>
		                <?php endif; ?>

						<?php if ($row["Some"]["type"] == "c"): ?>
		                    <tr>
		                        <td><?php echo $this->Util->getImageTag("client" , $row["Some"]["id"]) ?></td>
		                        <td>
						<a href="<?php echo URI_PATH; ?>/client/detail/<?php print $row["Some"]["id"]  ;?>">
						<?php print $client_array[$row["Some"]["id"]]["name"] ;?>
						</a>

					</td>
		                        <td>取引先</td>
		                        <td>
		                        	
			                        <?php if(isset($client_array[$row["Some"]["id"]]["departments"])): ?>
		                        	<!--取引先の部署-->			                        	
				                        <?php foreach ($client_array[$row["Some"]["id"]]["departments"] as $client_department): ?>
				                        	<a href="<?php echo URI_PATH; ?>/department/detail/<?php echo $client_department["id"] ;?>">
				                        	<?php print $client_department["name"]  ;?>
								</a><br>

				                        <?php endforeach; ?>
				                    <?php endif; ?>

		                        </td>
		                        <td>
		                        	<!--取引先のグループ-->
			                        <?php if(isset($client_array[$row["Some"]["id"]]["groups"])): ?>
				                        <?php foreach ($client_array[$row["Some"]["id"]]["groups"] as $client_group): ?>
				                        	<a href="<?php echo URI_PATH; ?>/group/detail/<?php echo $client_group["id"] ;?>">
								<?php print $client_group["name"]  ;?>
								</a><br>
				                        <?php endforeach; ?>
				                    <?php endif; ?>			                        	
		                        </td>
		                        <td>
		                        	<!--取引先のスタッフ -->
			                        <?php if(isset($client_array[$row["Some"]["id"]]["staffs"])): ?>		                        	
				                        <?php foreach ($client_array[$row["Some"]["id"]]["staffs"] as $client_staff): ?>	
				                        	<a href="<?php echo URI_PATH; ?>/staff/detail/<?php print $client_staff["id"] ;?>">
									<?php print $client_staff["name"]  ;?>
								</a><br>
				                        <?php endforeach; ?>
				                    <?php endif; ?>				                        	
		                        			                        	
		                        </td>
		                        <td>
		                            <div class="btn_cell">
		                            <span class="bass_btn">
		                                <a href="<?php print URI_PATH ;?>/client/detail/<?php print $row["Some"]["id"] ;?>">詳細 </a>
		                            </span>
		                            </div>
		                            <div class="btn_cell">
			                            <span class="bass_btn">
	<span class="bass_btn col-sm-3 col-xs-5"><a onClick="mypage_add(<?php echo MYPAGE_CLIENT; ?>,<?php print $row["Some"]["id"] ;?>,<?php echo $user_id; ?>)">ホームへ追加</a></span>

			                            </span>
		                            </div>
		                        </td>
		                    </tr>
		                <?php endif; ?>

		                    
					<?php endforeach; ?>
                </table>
                
			<?php endif; ?>

            </div>

    </div><!--class="container"-->
</div>


<br>
<!--ページネーション-->




<?php if ($this->Paginator->params()): ?>

<?php $this->paginator->options(array('url' => array('?' => $query_string_url)));?>

	<!--
	<?php  echo $this->Paginator->counter(array('format' => '全%count%件' ));?>
	<?php echo $this->Paginator->counter(array('format' => '{:page}/{:pages}'));?>
	-->
	<br >
	
	<?php 
	
		if($this->Paginator->params()["prevPage"]){
			echo $this->Paginator->prev('< 前へ', array(), null, array('class' => 'prev disabled'));
		}
	?>
	<?php
	echo $this->Paginator->numbers(array('separator' => ''));
	?>
	<?php 
		if($this->Paginator->params()["nextPage"]){
			echo $this->Paginator->next('次へ >', array(), null, array('class' => 'next disabled'));
		}	
	?>

<?php endif; ?>




<!--ページネーション-->




  <?php echo $this->element('footer'); ?>

