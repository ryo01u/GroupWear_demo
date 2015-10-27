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

       <div class="bass_maincontents_01 dtail_staff"  style="background: url(../img/bg/bg_staff.png) no-repeat 100% 0;">
           <div class="container bass_detail_01">
               <div class="row bass_title_03">
                   <p class="col-sm-9 col-xs-7">スタッフ情報：<?php echo $staff['Staff']['name'] ; ?></p>

	           <span class="bass_btn col-sm-3 col-xs-5"><a onClick="mypage_add(<?php echo MYPAGE_STAFF; ?>,<?php echo $staff['Staff']['id']; ?>,<?php echo $user_id; ?>)">ホームに追加</a></span>

               </div>

               <div class="row detail_comment">
                   <div class="col-sm-2 col-xs-2 person">
                       <p class="photo"><?php echo $this->Util->getImageTag('staff' , $staff['Staff']['id']) ?></p>
                       </div>
                   <div class="col-sm-8 col-xs-10 comment">
                           <div class="inner on">
                               <em>
                                   <p><?php echo $staff['Staff']['memo'] ; ?></p>
                               </em>
                        </div>
                       </div>
               </div>
               <div class="row detail_contents_wrap table_row_wrap">
                <span class="col-sm-5 table_row">
                   <div class="col-xs-12 detail_contents basic_information table_row_inr">
                      <div class="inner">
                       <p class="detail_contents_h01"><span>基本情報</span></p>
                       <div class="contents_list">
                           <p>役職：<?php echo $position[$staff['Staff']['position_id']] ; ?></p>
                           <p>所属部署：</br>
                           <?php if ($staffgroup): ?>
                               <?php foreach ($staffgroup as $row): ?>
                               <?php echo $row['d']['department_name'] ; ?></br>
                               <?php endforeach; ?>
                           <?php endif; ?>
                           </p>
                           <p>所属グループ：</br>
                           <?php if ($staffgroup): ?>
                               <?php foreach ($staffgroup as $row): ?>
                               <?php echo $row['g']['group_name'] ; ?></br>
                               <?php endforeach; ?>
                           <?php endif; ?>
                           </p>
                           <p>氏名：<?php echo $staff['Staff']['name'] ; ?></p>
                           <p>内線番号：<?php echo $staff['Staff']['extension_number'] ; ?></p>
                       </div>
                       </div>
                   </div>

                   <div class="col-xs-12 detail_contents job_description table_row_inr">
                       <div class="inner">
                           <p class="detail_contents_h01"><span>仕事内容</span></p>
                           <div class="contents_list">
                               <p>職種：<?php echo $job[$staff['Staff']['job']] ; ?></p>
                               <p>仕事内容：<?php echo $staff['Staff']['job_item'] ; ?></p>
                           </div>
                       </div>
                   </div>
                 </span>
                   <div class="table_row_span col-sm-7 col-xs-12 detail_contents user">
                       <div class="inner">
                           <p class="detail_contents_h01"><span>プロフィール</span></p>
                           <div>
                               <p><?php echo nl2br($staff['Staff']['profile']) ; ?></p>
<!--
                              <div class="qa">
                               <p class="q">2015-02-19 02:40:05</p>
                                  <p class="a">お知らせですお知らせですお知らせです</p>
                               </div>
-->
                           </div>
                       </div>
                   </div>
               </div>
               <div class="row detail_btn">
                   <div class="col-sm-6 btn book_btn">
                       <a href="<?php echo URI_PATH; ?>/search/keyword/?keyword=<?php echo $staff['Staff']['name'] ; ?>&c_v=on"><?php echo $staff['Staff']['name'] ; ?>さんの取引先一覧へ</a>
                   </div>
                   <div class="col-sm-6 btn index_btn">
                       <a href="<?php echo URI_PATH; ?>/search/keyword/?keyword=<?php echo $staff['Staff']['name'] ; ?>&p_v=on"><?php echo $staff['Staff']['name'] ; ?>さんの案件一覧へ</a>
                   </div>
              </div>

           </div><!--class="container"-->
       </div>

<?php echo $this->element('footer'); ?>
