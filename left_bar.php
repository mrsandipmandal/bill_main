      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Main Navigation</li>
		
			<?php
					$mdtl  = new Init_Table();
					$mdtl->set_table("main_menu","sl");
					$menus=$mdtl->search(array('rmsl'=>'0','stat'=>'0'),array('ordr' => 'ASC'));	
					foreach($menus as $menu) {
					$msl['rmsl']= $menu["sl"];
					$msl['stat']= 0;	
					$smenus=$mdtl->search($msl,array('ordr' => 'ASC'));	
					if(sizeof($smenus)>0)
					{
						$eurl="?pnm=".base64_encode($menu["mnm"]);
						if($menu["adlvl"]!="")
						{
							$eurl.="&vl=".base64_encode($menu["adlvl"]);
						}
					?>
		
        <li class="treeview">
          <a href="#">
            <i class="fa <?php echo $menu['icon'];?>"></i> <span><?php echo $menu["mnm"];?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
		  <?php
						
					foreach($smenus as $smenu) {
						$seurl="?pnm=".base64_encode($smenu["mnm"]);
						if($smenu["adlvl"]!="")
						{
							$seurl.="&vl=".base64_encode($smenu["adlvl"]);
						}
					?>
            
			
			
            <li><a href="<?php echo $smenu["page"].$seurl;?>"><i class="fa fa-circle-o"></i> <?php echo $smenu["mnm"];?></a></li>
			<?php			
					}
					?>
					
				
          </ul>
        </li>
		
		
		
		
		<?php			
					}
					else
					{
						$eurl="?pnm=".base64_encode($menu["mnm"]);
						if($menu["adlvl"]!="")
						{
							$eurl.="&vl=".base64_encode($menu["adlvl"]);
						}
						if($menu["ordr"]==1)
						{
							$cls="active";
						}
						else
						{
							$cls="";
						}
					?>				
					
		
        <li class=" <?php echo $cls;?>">
          <a href="<?php echo $menu["page"].$eurl;?>">
            <i class="fa <?php echo $menu['icon'];?>"></i> <span><?php echo $menu["mnm"];?></span>
         
          </a>
        </li>
		<?php
					}
						
					}
				 
				 ?>
      </ul>