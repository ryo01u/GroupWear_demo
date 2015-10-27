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

    <div class="bass_maincontents_01 dtail_group"  style="background: url(../img/bg/bg_group.png) no-repeat 100% 0;">
        <div class="container bass_detail_01">
            <div class="row bass_title_03">
                <p class="col-sm-9 col-xs-7">グループ情報：<?php echo $group['Group']['name'] ; ?></p>
                <p class="bass_btn col-sm-3 col-xs-5"><a onClick="mypage_add(<?php echo MYPAGE_GROUP; ?>,<?php echo $group['Group']['id']; ?>,<?php echo $user_id; ?>)">ホームに追加</a></p>
		
            </div>
            <div class="row detail_comment">
                <div class="col-sm-2 col-xs-2 person">
                    <p class="photo"><?php echo $this->Util->getImageTag('group' , $group['Group']['id'])  ?></p>
                    <!-- <p class="name">85</p> -->
                </div>
                <div class="col-sm-8 col-xs-10 comment">
                    <div class="inner on">
                        <em>
                            <p><?php echo $group['Group']['memo'] ; ?></p>
                        </em>
                    </div>
                </div>
            </div>
            <div class="row detail_contents_wrap">

                <div class="row">
                   <?php foreach ($staffgroup as $row): ?>


                    <div class="bass_seccard_01 col-sm-2 bass_seccard_staff">
                        <a href="<?php echo URI_PATH; ?>/staff/detail/<?php echo $row['sg']['staff_id'] ; ?>">
                            <div class="inner">
                            <div class="name">
			<?php echo $row['s']['staff_name'] ; ?></div>
                            <div class="twocol">
                                <div class="icon">
                                    <?php echo $this->Util->getImageTag('staff' , $row['sg']['staff_id'])  ?>
                                </div>
                                <div>
                                    <p><?php echo $row['s']['extension_number'] ; ?></p>
                                </div>
                            </div>
                            <p><?php // echo $row['s']['memo'] ; ?></p>
                        </div></a>
                    </div>
                   <?php endforeach; ?>


                </div>
            </div>
            <div class="row detail_btn">
                <div class="col-sm-6 btn book_btn">
                    <a href="<?php echo URI_PATH; ?>/search/keyword/?keyword=<?php echo $group['Group']['name'] ; ?>&c_v=on"><?php echo $group['Group']['name'] ; ?>さんの取引先一覧へ</a>
                </div>
                <div class="col-sm-6 btn index_btn">
                    <a href="<?php echo URI_PATH; ?>/search/keyword/?keyword=<?php echo $group['Group']['name'] ; ?>&p_v=on"><?php echo $group['Group']['name'] ; ?>さんの案件一覧へ</a>
                </div>
            </div>

        </div><!--class="container"-->
    </div>

<!--
グループID:<?php echo $info["Group"]["group_id"] ; ?><br />

グループ名:<?php echo $info["Group"]["name"] ; ?><br />
-->

<?php echo $this->element('footer'); ?>
