<?php echo $this->element('header'); ?>
<?php echo $this->element('head'); ?>
<?php echo $this->element('navi'); ?>
  	 
<!--URL登録-->
<div class="bass_pop_01"> 
<div class="pop_inner">
<div class="pop_title">ブックマーククリップの追加</div> 	 
    <?php echo $this->Form->create('StaffMypage', array('action'=>'post', 'url' => '/mypage/bookmark' )); ?>
       

                    <div class="input_wrp">
				   		<?php echo $this->Form->input('StaffMypage.name',array('type' => 'text','label'=>'タイトル','required' => true  )); ?>
	                </div>
                            	
	                <div class="input_wrp">
				   		<?php echo $this->Form->input('StaffMypage.url',array('type' => 'url','value'=>'http://','label'=>'URL','required' => true  )); ?>
	                </div>
                    <div class="bass_btn">
                        <input type="submit" value="追加する">
                    </div>
	</form>
    <p class="close">&nbsp;</p>
</div>
</div>
 <!--URL登録-->  	 
  	  
  	 
    <div class="bass_maincontents_01 del_mode_wrap">
        <div class="container">
            <div class="row">
                <p class="bass_title_03"><span class="col-sm-9  col-xs-7">ホーム</span>
                <span class="bass_btn col-sm-3 col-xs-5"><a onClick="bass_pop_01()">クリップを追加</a></span>
            </p>
            </div>


            <div class="row">
        	<?php foreach ($mypage_array as $row): ?>
            	
            	
            	<?php if ($row["StaffMypage"]["mypage_type"] == MYPAGE_BOOKMARK): ?>
            	<!--ブックマーク -->
                <div class="bass_seccard_01 col-sm-2 bass_seccard_bookmark">
<a class="delete_btn" style ="display:none" href="/mypage/delete/<?php print $row["StaffMypage"]["id"] ;?>">DELETE</a>
                <a target="_blank" href="<?php print $row["StaffMypage"]["url"] ;?>" >     
                 <div class="inner">
                         	 <div class="name"><?php print $row["StaffMypage"]["name"] ;?></div>
                         	 
                	   <div class="twocol">
	                       <div class="icon">

					<?php echo $this->Util->getImageTag("bookmark" ,  $row["StaffMypage"]["id"])  ?>

					<!--<?php print $row["StaffMypage"]["url"] ;?>-->
				

                    		</div>
                    	<div>
                             
                        <p>


			</p>
                    </div>
                       </div>
                        <p></p>
                        

                    </div>
                </a>
                </div>
                <!--ブックマーク -->
                <?php endif; ?>	
                
            	<?php if ($row["StaffMypage"]["mypage_type"] == MYPAGE_DEPARTMENT): ?>
				<!--部署 -->            		
                <div class="bass_seccard_01 col-sm-2 bass_seccard_department">
	<a class="delete_btn" style ="display:none" href="/mypage/delete/<?php print $row["StaffMypage"]["id"] ;?>">DELETE</a>
                    <a href="/department/detail/<?php print $row["StaffMypage"]["page_id"] ;?>">      
                 <div class="inner">
                         	 <div class="name"><?php print $department_array[$row["StaffMypage"]["page_id"]]["name"] ;?></div>
                         	 
                	   <div class="twocol">
	                       <div class="icon">
					<?php echo $this->Util->getImageTag("department" , $row["StaffMypage"]["id"])  ?>
                    		</div>
                    	<div>
                             
                        <p>紹介文:<?php print $department_array[$row["StaffMypage"]["page_id"]]["memo"] ;?></p>
                    </div>
                       </div>
                        <p></p>
                        

                    </div></a>
                </div>
                <!--部署 -->
                <?php endif; ?>	


            	<?php if ($row["StaffMypage"]["mypage_type"] == MYPAGE_GROUP): ?>

				<!--グループ -->
                <div class="bass_seccard_01 col-sm-2 bass_seccard_group">
	<a class="delete_btn" style ="display:none" href="/mypage/delete/<?php print $row["StaffMypage"]["id"] ;?>">DELETE</a>

                    <a href="/group/detail/<?php print $row["StaffMypage"]["page_id"] ;?>">   
                	<div class="inner">
                         	 <div class="name">
				<?php print $group_array[$row["StaffMypage"]["page_id"]]["name"] ;?><br>
				<?php print $group_array[$row["StaffMypage"]["page_id"]]["department_name"] ;?><br>
				
                         	 </div>
                         	 
                	   <div class="twocol">
	                       <div class="icon">
					<?php echo $this->Util->getImageTag("group" , $row["StaffMypage"]["page_id"])  ?>
                    		</div>
	                    	<div>
				<p>紹介文:<?php print mb_strimwidth((nl2br($group_array[$row["StaffMypage"]["page_id"]]["memo"])), 0, 20, "..") ;?></p>

	                    	</div>
                       </div>
                        <p></p>

                    </div></a>
                </div>
				<!--グループ -->
                <?php endif; ?>	

            	<?php if ($row["StaffMypage"]["mypage_type"] == MYPAGE_STAFF): ?>
				<!--スタッフ -->            		
                <div class="bass_seccard_01 col-sm-2 bass_seccard_staff">
	<a class="delete_btn" style ="display:none" href="/mypage/delete/<?php print $row["StaffMypage"]["id"] ;?>">DELETE</a>

                       <a href="/staff/detail/<?php print $row["StaffMypage"]["page_id"] ;?>">      
	                 <div class="inner">

	                      <div class="name"><?php print $staff_array[$row["StaffMypage"]["page_id"]]["name"] ;?></div>
	                	   <div class="twocol">
		                       <div class="icon">
						<!--<img src="<?php echo $this->html->webroot( "img/data/i02.png");?>" alt="画像" />-->
						<?php echo $this->Util->getImageTag("staff" , $row["StaffMypage"]["page_id"])  ?>
	                    		</div>
	                    		<div>
	                        		<p>
									<!--スタッフに所属したグループ-->
									<?php foreach ($staff_array[$row["StaffMypage"]["page_id"]]["groups"] as $staff_group): ?>
										<?php print $staff_group["department_name"]  ;?>									
										<?php print $staff_group["group_name"]  ;?>
									<?php endforeach; ?>
									<!--スタッフに所属したグループ-->
	                        		</p>
	                    		</div>
	                       </div>
				<p>内線:<?php print $staff_array[$row["StaffMypage"]["page_id"]]["extension_number"] ;?></p>

				<p>紹介文:<?php print mb_strimwidth((nl2br($staff_array[$row["StaffMypage"]["page_id"]]["memo"])), 0, 20, "..") ;?></p>
	                 </div></a>
                 </div>
				<!--スタッフ -->
                <?php endif; ?>	



            	<?php if ($row["StaffMypage"]["mypage_type"] == MYPAGE_PROJECT): ?>
				<!--プロジェクト-->            		
                <div class="bass_seccard_01 col-sm-2 bass_seccard_project">
	<a class="delete_btn" style ="display:none" href="/mypage/delete/<?php print $row["StaffMypage"]["id"] ;?>">DELETE</a>

               <a href="/project/detail/<?php print $row["StaffMypage"]["page_id"] ;?>"> 

                 <div class="inner">
                         	 <div class="name"><?php print $project_array[$row["StaffMypage"]["page_id"]]["name"] ;?></div>
                         	 
                	   <div class="twocol">
	                       <div class="icon">
					<?php echo $this->Util->getImageTag("project" , $row["StaffMypage"]["page_id"])  ?>
                    		</div>
                    	<div>
                             
                        <p><?php print $project_array[$row["StaffMypage"]["page_id"]]["memo"] ;?></p>
                    </div>
                       </div>

                        

                    </div>
                </a>
                </div>
                <!--プロジェクト-->
                <?php endif; ?>	


            	<?php if ($row["StaffMypage"]["mypage_type"] == MYPAGE_CLIENT): ?>
				<!--取引先-->            		
                <div class="bass_seccard_01 col-sm-2 bass_seccard_client">
	<a class="delete_btn" style ="display:none" href="/mypage/delete/<?php print $row["StaffMypage"]["id"] ;?>">DELETE</a>

               <a href="/client/detail/<?php print $row["StaffMypage"]["page_id"] ;?>"> 
                 <div class="inner">
                         	 <div class="name"><?php print $client_array[$row["StaffMypage"]["page_id"]]["name"] ;?></div>
                         	 
                	   <div class="twocol">
	                       <div class="icon">
					<?php echo $this->Util->getImageTag("client" , $row["StaffMypage"]["page_id"])  ?>
                    		</div>
                    	<div>
                             
                        <p><?php print mb_strimwidth((nl2br($client_array[$row["StaffMypage"]["page_id"]]["memo"])), 0, 10, "..") ;?></p>
                    </div>
                       </div>
                        <p></p>
                    </div></a>
                </div>
                <!--取引先-->
                <?php endif; ?>	


                
            <?php endforeach; ?>
			</div>

<!--ページネーション-->
	<!--<?php  echo $this->Paginator->counter(array('format' => '全%count%件' ));?>
	<?php echo $this->Paginator->counter(array('format' => '{:page}/{:pages}'));?>
	<br >
	
	<?php 
		if($this->Paginator->params()["prevPage"]){
			echo $this->Paginator->prev('< 前へ', array(), null, array('class' => 'prev disabled'));
		}
	?>
	<?php
	echo $this->Paginator->numbers(array('separator' => ''));
	?>
	<?php 
		if($this->Paginator->params()["nextPage"]){
			echo $this->Paginator->next('次へ >', array(), null, array('class' => 'next disabled'));
		}	
	?>-->
<!--ページネーション-->





         <!-- <div class="bass_sec_01">
             <div class="row">
                <div class="col-sm-12 bass_btn">
                    <a onClick="bass_pop_01()">ブックーマーク</a>
                </div>
            </div>
        </div> -->
        </div><!--class="container"-->
    </div>
    <!--class="bass_maincontents_01"-->

<?php echo $this->element('footer'); ?>

