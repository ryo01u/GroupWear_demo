<?php echo $this->element('header'); ?>
<?php echo $this->element('head'); ?>
<?php echo $this->element('navi'); ?>

    <div class="bass_maincontents_01">
        <div class="container">
            <div class="row">
                <p class="bass_title_03">お知らせ</p>
            </div>
            <div class="row">
            <?php foreach ($datas as $data): ?>
                <div class="bass_news_01 col-sm-12">
                    <div class="person">
                        <p class="photo"><?php echo $this->Util->getImageTag('news' , $data['News']['id'])  ?></p>
                        <p class="name"><?php echo $data['News']['set_staff_id']; ?></p>
                    </div>
                    <div class="comment">
                    <div class="inner">
                    <em>
                        <p><?php echo $data['News']['modified']; ?></p>
                        <p><strong><?php echo $data['News']['name']; ?></strong></p></br>
                        <p><?php echo $this->Text->Truncate($data['News']['body'],13); ?></p>
                        <p><?php echo $data['News']['body']; ?></p>
                    </em>
                    </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div><!--"row"-->
        </div><!--class="container"-->
    </div>
    <!--class="bass_maincontents_01"-->

 <?php echo $this->element('footer'); ?>

