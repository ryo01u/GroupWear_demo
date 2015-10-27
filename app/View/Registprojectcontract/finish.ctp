<?php echo $this->element('header'); ?>
<?php echo $this->element('head'); ?>
<?php echo $this->element('navi'); ?>
<div class="bass_maincontents_01">
    <div class="container">
        <div class="row">
            <p class="bass_title_01">案件契約登録完了</p>
        </div>
        <div class="bass_sec_01">
            <div class="row">
                <p>完了</p>
            </div>
            <div class="row">
                <div class="col-sm-12 page_nav">
                    <div>
                         <a href="<?php echo URI_PATH; ?>/registprojectcontract/lists?pid=<?php echo $project_id; ?>">戻る</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->element('footer'); ?>
