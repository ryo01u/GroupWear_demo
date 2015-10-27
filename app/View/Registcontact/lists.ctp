<?php echo $this->element('header'); ?>
<?php echo $this->element('head'); ?>
<?php echo $this->element('navi'); ?>
<div class="bass_maincontents_01">
    <div class="container">
        <div class="row">
            <p class="bass_title_01">
                コンタクト履歴登録画面</p>
        </div>
        <div class="bass_sec_01">
            <div class="row head_btn">
                <div class="col-sm-12 bass_btn"><a href="<?php echo URI_PATH; ?>/registcontact/action/">コンタクト履歴追加</a><br>
                </div>

                <div class="col-sm-12 bass_btn"><a href="<?php echo URI_PATH; ?>/registclient/lists/">取引先一覧に戻る</a>
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
            </div><?php foreach ($contact as $row): ?>
            <div class="row">
                <div class="col-sm-6 table">
                    <div class="cell icon p15"><a href="<?php echo URI_PATH; ?>/registcontact/action/<?php echo $row['Contact']['id']; ?>"><?php echo $row['Contact']['id']; ?></a></div>
                        <div class="cell"><?php echo $client[$row['Contact']['client_id']]; ?></div>
                    </div>
                    <div class="col-sm-6 table">
                        <div class="cell"><?php echo $row['Contact']['name']; ?></div>
                        <div class="cell bass_btn p40"><a href="/registcontact/del/<?php echo $row['Contact']['id']; ?>">削除</a></div>
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
