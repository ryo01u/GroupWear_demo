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

       <div class="bass_maincontents_01 dtail_client" style="background: url(<?php echo TOP_URL ; ?>/img/bg/bg_client.png) no-repeat 100% 0;">
           <div class="container bass_detail_01">
               <div class="row bass_title_03">
                   <p class="col-sm-9 col-xs-7">取引先情報：<?php echo $client['Client']['name'] ; ?></p>
                <span class="bass_btn col-sm-3 col-xs-5"><a onClick="mypage_add(<?php echo MYPAGE_CLIENT; ?>,<?php echo $client['Client']['id']; ?>,<?php echo $user_id; ?>)">ホームに追加</a></span>
               </div>
               <div class="row detail_comment">
                   <div class="col-sm-2 col-xs-2 person">
                       <p class="photo"><?php echo $this->Util->getImageTag('client' , $client['Client']['id'])  ?></p>
                          <!-- <p class="name">85</p> -->
                       </div>
                   <div class="col-sm-8 col-xs-10 comment">
                           <div class="inner on">
                               <em>
                                   <p><?php echo $client['Client']['memo'] ; ?></p>
                               </em>
                        </div>
                       </div>
               </div>
               <div class="row detail_contents_wrap three_col">
                   <div class="col-sm-4 detail_contents basic_information">
                      <div class="inner">
                       <p class="detail_contents_h01"><span>基本情報</span></p>
                       <div class="contents_list">
                           <p>会社名：<?php echo $client['Client']['name'] ; ?></p>
                           <p>部署／課：<?php echo $client['Client']['client_department'] ; ?></p>
                           <p>住所：<?php echo $client['Client']['adress'] ; ?></p>
                           <p>地図：<a href="<?php echo $client['Client']['map'] ; ?>"><?php echo $this->Text->Truncate($client['Client']['map'],30) ; ?></a></p>
                           <p>電話番号：<?php echo $client['Client']['phone'] ; ?></p>
                       </div>
                       </div>
                   </div>

                   <div class="col-sm-4 detail_contents contact">
                       <div class="inner">
                           <p class="detail_contents_h01"><span>コンタクト履歴</span></p>
                           
                       <?php foreach ($contact as $row): ?>
                       <div class="link_list01">
                        <p><a>件名：<?php echo $row['Contact']['name'] ; ?></br>
                              記入者:○○○<span><?php echo $row['Contact']['created'] ; ?></span></a></p>
                       </div>
                       <?php endforeach; ?>
                       </div>
                   </div>
                   
                   <div class="col-sm-4 detail_contents memo">
                       <div class="inner">
                           <p class="detail_contents_h01"><span>メモ</span></p>
                           
                       <?php foreach ($clientmemo as $row): ?>
                       <div class="link_list01">
                        <p><a><?php echo $row['Clientmemo']['name'] ; ?></br></br> <?php echo $row['Clientmemo']['memo'] ; ?></br></br> <?php echo $row['Clientmemo']['created'] ; ?></a></p>
                       </div>
                       <?php endforeach; ?>
                       </div>
                   </div>


               </div>
               <div class="row detail_contents_wrap two_col">
                   <div class="col-sm-6 detail_contents project_information">
                      <div class="inner">
                       <p class="detail_contents_h01"><span>案件情報</span></p>
                       
                       <?php foreach ($project as $row): ?>
                       <div class="link_list02">
                        <p><a href="<?php echo URI_PATH; ?>/project/detail/<?php echo $row['Project']['id'] ; ?>"><?php echo $row['Project']['created'] ; ?> <?php echo $client['Client']['name'] ; ?>の<?php echo $row['Project']['name'] ; ?></a></p>
                       </div>
                       <?php endforeach; ?>

                   <div class="bass_btn index_btn">
		<!--
                       <a href="<?php echo URI_PATH; ?>/search/keyword/?keyword=<?php echo $client['Client']['name'] ; ?>&p_v=on"><?php echo $client['Client']['name'] ; ?>の案件一覧へ</a>
		-->
                   </div>
                       </div>
                   </div>

                   <div class="col-sm-6 detail_contents staff">
                       <div class="inner">
                           <p class="detail_contents_h01"><span>担当者情報</span></p>

<!--
          <div class="select01">
            <select >
              <option value="akasatana">あいうえお順</option>
            </select>
          </div>
-->

                       <?php foreach ($clientstaff as $row): ?>
                       <div class="link_list01">
                        <p><a><?php echo $row['s']['staff_name'] ; ?><!--<span>--><?php //echo $row['ClientStaff']['created'] ; ?><!--</span>--></a></p>
                       </div>
                       <?php endforeach; ?>
                       </div>
                   </div>

               </div>

           </div><!--class="container"-->
       </div>

<?php echo $this->element('footer'); ?>
