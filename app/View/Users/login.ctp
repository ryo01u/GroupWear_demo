<?php echo $this->element('header'); ?>
<div class="canvas_wrp login">
<canvas id="myCanvas" width="XXX" height="YYY" ></canvas>

<div class="bass_maincontents_01">
    <div class="container">
<!--         <div class="row">
            <p class="bass_title_01">サイト側ＴＯＰ</p>
        </div> -->

        <div class="bass_sec_01">
            <?php echo $this->Session->flash('auth'); ?>
            <?php echo $this->Form->create('Staff'); ?>


          <?php if (isset($login_error)): ?>
		<p class="bass_title_02"><?php echo __('ユーザ名、パスを正しく入力してください'); ?></p>
          <?php endif; ?>	

            <div class="row">
                <div class="col-sm-4">ログインID</div>
                <div class="col-sm-8 bass_textarea_01">
                <?php echo $this->Form->input('account');?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">パスワード</div>
                <div class="col-sm-8 bass_textarea_01">
                <?php echo $this->Form->input('password');?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 bass_btn">
           <?php echo $this->Form->end(__('Login')); ?>
                </div>
           </div>

        </div>

    </div>
    <!--class="container"-->
</div>

</div>
            

            <script src="http://code.createjs.com/createjs-2013.05.14.min.js" type="text/javascript"></script>
            <script src="http://code.createjs.com/easeljs-0.7.1.min.js" type="text/javascript"></script>
            <script src="http://code.createjs.com/tweenjs-0.5.1.min.js" type="text/javascript"></script>

<script src="/js/login.js"></script>
<?php echo $this->element('footer'); ?>