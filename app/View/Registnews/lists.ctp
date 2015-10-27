<?php echo $this->element('header'); ?>
<?php echo $this->element('head'); ?>
<?php echo $this->element('navi'); ?>
<div class="bass_maincontents_01">
    <div class="container">
        <div class="row">
            <p class="bass_title_01">お知らせ登録画面</p>
        </div>
        <div class="bass_sec_01">
            <div class="row head_btn">
                <div class="col-sm-12 bass_btn">
                    <a href="<?php echo URI_PATH; ?>/registnews/action/">お知らせ追加</a>
                </div>
            </div>
            <div class="row head_row">
                <div class="col-sm-5 table">
                    <div class="cell icon">編集</div>
                    <div class="cell">タイトル</div>
                </div>
                <div class="col-sm-7 table">
                    <div class="cell">内容</div>
                </div>
            </div>

            <!--<?php var_dump($news) ; ?>-->

            <?php foreach ($news as $row): ?>

            <div class="row">
                <div class="col-sm-5 table">
                    <div class="cell bass_btn p20">
                        <a href="<?php echo URI_PATH; ?>/registnews/action/<?php echo $row['News']['id']; ?>">
                            編集
                        </a>
                    </div>
                    <div class="cell">
                        <?php echo $row[ 'News'][ 'name']; ?>
                    </div>
                </div>

                <div class="col-sm-4 table">

                    <div class="cell">
                        <?php echo $row[ 'News'][ 'body']; ?>
                    </div>
                </div>

                <div class="col-sm-3 table">
                    <!--<div class="cell bass_btn"><a href=<?php echo URI_PATH; ?>/registnews/action/<?php echo $row['News']['id']; ?>">編集</a>
                    </div>-->
                    <div class="cell bass_btn"><a href="<?php echo URI_PATH; ?>/registnews/del/<?php echo $row['News']['id']; ?>">削除<br /></a>
                    </div>
                </div>

            </div>

            <?php endforeach; ?>

            <div class="row">

                <div class="col-sm-12 page_nav">
                    <div><?php echo $this->Paginator->prev('< 前へ', array(), null, array('class' => 'prev disabled')); ?></div>
                    <div><?php echo $this->Paginator->numbers(array('separator' => '')); ?></div>
                    <div><?php echo $this->Paginator->next('次へ >', array(), null, array('class' => 'next disabled')); ?></div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php echo $this->element('footer'); ?>
