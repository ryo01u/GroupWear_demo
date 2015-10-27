<div class="bass_header_01">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 bass_logo_01">
                <img src="<?php echo $this->html->webroot( "img/logo.png");?>" alt="Qrater" >
            </div>

            <?php foreach ($data_news as $row): ?><div class="col-sm-3 info"><span>
				
				
            	<a href="<?php echo URI_PATH; ?>/news/index/"><?php echo $row['name']; ?>/<?php echo $row['modified']; ?></a>
</span></div>
            <?php endforeach; ?>

		<?php if ( isset($user_name)  ): ?>
	                    
	                    <div class="col-sm-2 name"><span><?php echo $user_name; ?>様</span></div>
	                    <div class="col-sm-2 log">
	                    	<p class="col-xs-6 login"><a href="<?php echo URI_PATH; ?>/users/logout/">ログアウト</a></p>
	                    	<p class="col-xs-6 setting"><a href="<?php echo URI_PATH; ?>/admin/index/">管理者メニュー</a></p>
	                    </div>
		<?php endif; ?>
            </div>
    </div>
</div>
