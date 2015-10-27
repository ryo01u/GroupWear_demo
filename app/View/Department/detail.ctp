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
    <div class="bass_maincontents_01 dtail_department"  style="background: url(../img/bg/bg_department.png) no-repeat 100% 0;">
        <div class="container bass_detail_01">
            <div class="row bass_title_03">
                <p class="col-sm-9 col-xs-7">部署情報：<?php echo $data_department['Department']['name'] ; ?>
		</p>
                <span class="bass_btn col-sm-3 col-xs-5"><a onClick="mypage_add(<?php echo MYPAGE_DEPARTMENT; ?>,<?php echo $data_department['Department']['id']; ?>,<?php echo $user_id; ?>)">ホームに追加</a></span>

            </div>

            <div class="row detail_comment">
                <div class="col-sm-2 col-xs-2 person">
                    <p class="photo"><?php echo $this->Util->getImageTag('department' , $data_department['Department']['id'])  ?></p>
                   <!-- <p class="name">85</p> -->
                </div>
                <div class="col-sm-8 col-xs-10 comment">
                    <div class="inner on">
                        <em>
                            <p><?php echo $data_department['Department']['memo'] ; ?></p>
                        </em>
                    </div>
                </div>
            </div>


<!-- 追記 -->





            <div class="row detail_contents_wrap">

<!-- 部長追記 

                <div class="row">
                    <div class="bass_seccard_01 col-sm-2">
                        <div class="inner">
                            <div class="name"><a href="<?php echo URI_PATH; ?>/staff/detail/<?php echo $data_staff['Staff']['id'] ; ?>"><?php echo $data_staff['Staff']['name'] ; ?></a></div>
                            <div class="twocol">
                                <div class="icon">
                                    <?php echo $this->Util->getImageTag('staff' , $data_staff['Staff']['id'])  ?>
                                </div>
                                <div>

                                    <p><?php echo $data_staff['Staff']['name'] ; ?></p>
                                </div>
                            </div>
                            <p><?php echo $this->Text->Truncate($data_staff['Staff']['memo'],30); ?></p>
                        </div>
                    </div>  

 ここまで -->

                <div class="row">
                    <?php foreach ($data_group as $row): ?>
                    <div class="bass_seccard_01 col-sm-2 bass_seccard_group">
                        <div class="inner">
                            <div class="name"><a href="<?php echo URI_PATH; ?>/group/detail/<?php echo $row['Group']['id'] ; ?>"><?php echo $row['Group']['name'] ; ?></a></div>
                            <div class="twocol">
                                <div class="icon">
                                    <?php echo $this->Util->getImageTag('group' , $row['Group']['id'])  ?>
                                </div>
                                <div>

                                    <p><?php echo $data_department['Department']['name'] ; ?></p>
                                </div>
                            </div>
                            <p><?php echo $this->Text->Truncate($row['Group']['memo'],30); ?></p>
                        </div>
                    </div>  
                    <?php endforeach; ?>


                </div>
            </div>
            <div class="row detail_btn">
                <div class="col-sm-6 btn book_btn">
                    <a href="<?php echo URI_PATH; ?>/search/keyword/?d[]=<?php echo $data_department['Department']['id'] ; ?>&c_v=on"><?php echo $data_department['Department']['name'] ; ?>の取引先一覧へ</a>
                </div>
                <div class="col-sm-6 btn index_btn">
                    <a href="<?php echo URI_PATH; ?>/search/keyword/?d[]=<?php echo $data_department['Department']['id'] ; ?>&p_v=on"><?php echo $data_department['Department']['name'] ; ?>の案件一覧へ</a>
                </div>
            </div>

        </div><!--class="container"-->
    </div>
<?php echo $this->element('footer'); ?>
