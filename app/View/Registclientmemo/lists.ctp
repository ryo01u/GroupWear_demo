<?php echo $this->element('header'); ?>
<?php echo $this->element('head'); ?>
<?php echo $this->element('navi'); ?>
<div class="bass_maincontents_01">
    <div class="container">
        <div class="row">
            <p class="bass_title_01">
                取引先メモ登録画面</p>
        </div>
        <div class="bass_sec_01">
            <div class="row head_btn">
                <div class="col-sm-12 bass_btn"><a href="<?php echo URI_PATH; ?>/registclientmemo/action/">取引先メモ追加</a><br>
                </div>
                <div class="col-sm-12 bass_btn"><a href="<?php echo URI_PATH; ?>/registclient/lists/">取引先一覧に戻る</a><br>
                </div>
            </div>
            <div class="row head_row">
                <div class="col-sm-6 table">
                    <div class="cell icon p15">ＩＤ</div>
                    <div class="cell">取引先企業</div>
                </div>
                <div class="col-sm-6 table">
                    <div class="cell">件名</div>
                    <div class="cell p40">削除</div>
                </div>
            </div><?php foreach ($clientmemo as $row): ?>
            <div class="row">
                <div class="col-sm-6 table">
                    <div class="cell bass_btn p20"><a href="<?php echo URI_PATH; ?>/registclientmemo/action/<?php echo $row['Clientmemo']['id']; ?>">編集</a></div>

                        <div class="cell"><?php echo $client[$row['Clientmemo']['client_id']]; ?></div>
                    </div>
                    <div class="col-sm-6 table">
                        <div class="cell"><?php echo $row['Clientmemo']['name']; ?></div>
                        <div class="cell bass_btn p40"><a href="/registclientmemo/del/<?php echo $row['Clientmemo']['id']; ?>">削除</a></div>
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
