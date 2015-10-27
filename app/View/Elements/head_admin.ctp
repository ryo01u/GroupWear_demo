<div class="bass_header_01 bass_admin_01>
    <div class="container">
        <div class="row">
            <p class="bass_logo_01">
                <img src="<?php echo $this->html->webroot( "img/logo.png");?>" alt="Qrater" >
            </p>
            <div class="heder_list">

		<?php if ( isset($user_name)  ): ?>
	                <ul>
	                    <li class="info"><span>総務部・座席表変更のお知らせ</span></li>
	                    <li class="name"><span><?php echo $user_name; ?></span></li>
	                    <li class="login"><span>

				<a href="<?php echo URI_PATH; ?>/users/logout/">ログアウト</a><br>
			    </span>
			</li>

	                </ul>

				<a href="<?php echo URI_PATH; ?>/top/link/">リンク集（仮）</a><br>
		<?php endif; ?>




            </div></div>
    </div>
</div>
