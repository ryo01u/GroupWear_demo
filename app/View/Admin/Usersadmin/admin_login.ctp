
<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('Adminuser'); ?>
    <fieldset>
        <legend><?php echo __('ユーザ名、パスを入れてね'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>