<div class="bass_nav_01">
    <div class="container">
        <ul class="row">

        <?php if ($this->name == 'Search' || $this->name == 'Top' ): ?>
            <li class="col-sm-3  home"><a href="/mypage/index">ホーム</a></li>
            <li class="col-sm-3 search on"><a href="/top/index">さがす</a></li>

	<?php else : ?>
            <li class="col-sm-3 on home"><a href="/mypage/index">ホーム</a></li>
            <li class="col-sm-3 search"><a href="/top/index">さがす</a></li>

	<?php endif; ?>



<li class="<?php echo (!empty($this->params['action']) && ($this->params['action']=='controlpanel') )?'active' :'inactive col-sm-3' ?>">
  <!-- <?php echo $this->Html->link('Dashboard', array('controller'=>'users','action' => 'controlpanel'), array('title' => 'Dashboard','class' => 'shortcut-dashboard'));?> -->
</li>

<li class="<?php echo (!empty($this->params['action']) && ($this->params['action']=='index') )?'active' :$this->params['action'] ?>">
  <!-- <?php echo $this->Html->link('Contacts', array('controller'=>'contacts','action' => 'index'), array('title' => 'Contacts','class' => 'shortcut-contacts'));?> -->
</li>
        </ul><?php
$navLinks = array(
    'home' => array(
        'title' => 'home',
        'path' => '/',
    ),
    'services' => array(
        'title' => 'our services',
        'path' => '/pages/services',
    ),
    'contact' => array(
        'title' => 'contact us',
        'path' => '/contacts',
    ),
    'about' => array(
        'title' => 'about us',
        'path' => '/pages/about',
    ),
);
?>
 
<ul id="global_nav">
    <?php foreach ($navLinks as $key => $link) : 
           
          $class = null;
        
    ?>
     
  
    <?php endforeach; ?>
</ul>
    </div>
</div>
