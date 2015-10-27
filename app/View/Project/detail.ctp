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

<!-- <p><input type="button" value="マイページへ" onClick="mypage_add(<?php echo MYPAGE_PROJECT; ?>,<?php echo $id; ?>,<?php echo $user_id; ?>)"></p> -->


       <div class="bass_maincontents_01 detail_project"  style="background: url(<?php echo TOP_URL ; ?>/img/bg/bg_project.png) no-repeat 100% 0;"> 
           <div class="container bass_detail_01">
               
            <div class="row">
                <p class="bass_title_03"><span class="col-sm-9  col-xs-7">案件情報：<?php print($project["Project"]["name"]) ; ?></span>
                <span class="bass_btn col-sm-3 col-xs-5"><a onClick="mypage_add(<?php echo MYPAGE_PROJECT; ?>,<?php echo $id; ?>,<?php echo $user_id; ?>)">ホームに追加</a></span>
            </p>
            </div>
               <div class="row detail_comment">
                   <div class="col-sm-2 col-xs-2 person">
                       <p class="photo">
                       	<?php echo $this->Util->getImageTag("project" , $id)  ?>
                       	</p>
                       </div>
                       
                   <!--<div class="col-sm-8 col-xs-10 comment">
                           <div class="inner on">
                               <em>
                                   <p>2015-02-19 18:34:49</p>
                                   <p><strong>【号外】</strong></p><br>
                                   <p>ISISじゃないよ</p>
                                   <p>ISISじゃないよ</p>
                               </em>
                        </div>
                  </div>-->
                   
               </div>
               
               <div class="row detail_contents_wrap two_col">
                   <div class="col-sm-6 detail_contents basic_information">
                      <div class="inner">
                       <p class="detail_contents_h01"><span>基本情報</span></p>
                       <div class="contents_list">
                       	
    					
							<p>案件名：<?php print($project["Project"]["name"]) ; ?></p>
							<p>	案件概要：<?php print($project["Project"]["memo"]) ; ?></p>
							<p>担当者：
								<?php foreach ($projectStaff as $row): ?>
									<?php echo $row["name"]  ; ?><br>
								<?php endforeach; ?>								
								</p>
							<p>グループ：<br>
								<?php foreach ($projectGroup as $row): ?>
									<?php echo($row["department_name"]) ; ?><?php echo($row["group_name"]) ; ?><br>
								<?php endforeach; ?>								
								</p>
								
							<!--<p>得意先名：（取引先へのリンク）</p>-->

							<p>得意先名：<br />
								<?php foreach ($projectClientRegular as $row): ?>
									<?php echo($row["client_name"]) ; ?><br />
								<?php endforeach; ?>
							</p>

							<p>仕入先名：<br />
								<?php foreach ($projectClient as $row): ?>
									<?php echo($row["client_name"]) ; ?><br />
								<?php endforeach; ?>
							</p>
							<p>期間：<?php if(isset($project["start_date"])) { echo $project["start_date"] ;}?>
								～<?php if(isset($project["end_date"])) { echo $project["end_date"] ;}?></p>
                       </div>
                       </div>
                   </div>

                   <div class="col-sm-6 detail_contents memo">
                       <div class="inner">
                           <p class="detail_contents_h01"><span>メモ</span></p>
                       <div class="link_list01">
                       	<?php if ($projectMemo): ?>
							<?php foreach ($projectMemo as $row): ?>
								<p> 
									<?php print($row["Projectmemo"]["title"]) ; ?>
									
									<?php if (isset($row["Projectmemo"]["set_staff_id"])): ?>			
											<?php echo $staff[$row["Projectmemo"]["set_staff_id"]] ;?>
									<?php endif; ?>	          			                       	
									<?php print($row["Projectmemo"]["modified"]) ; ?>
								</p>
							<?php endforeach; ?>	                       	
						<?php endif; ?>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="row detail_contents_wrap two_col">
                   <div class="col-sm-6 detail_contents agreement">
                      <div class="inner">
                       <p class="detail_contents_h01"><span>契約情報</span></p>
                       <div class="contents_list">
                       	<?php if ($projectcontract): ?>
							<?php foreach ($projectcontract as $row): ?>
								<p> 
										<?php print($row["Projectcontract"]["title"]) ; ?>
										
										<?php if (isset($row["Projectcontract"]["status"])): ?>			
												<?php echo $contract_status[$row["Projectcontract"]["status"]] ;?>
										<?php endif; ?>
										<?php print($row["Projectcontract"]["modified"]) ; ?>
																				
								</p>
							<?php endforeach; ?>
						<?php endif; ?>                       	

                       </div>
                       </div>
                   </div>

                   <div class="col-sm-6 detail_contents link">
                       <div class="inner">
                           <p class="detail_contents_h01"><span>リンク</span></p>
                       <div class="link_list02">
							<p>					
							<?php print($project["Project"]["markets"]) ; ?>
	                        </p>
                           </div>
                       </div>
                   </div>

               </div>
           </div><!--class="container"-->
       </div>



<?php echo $this->element('footer'); ?>
