
    		<ul>
    		<li><?=anchor('/', 'home')?></li>
                <li><?=anchor('/products', 'products')?></li>
                  <li><?=anchor('/about', 'about us')?></li>
               
                    <li><?=anchor('/jobs', 'jobs')?></li>
                  <li><?=anchor('/contact', 'contact')?></li>
                  
            
                  <?php $is_logged_in = $this->session->userdata('is_logged_in');
		$role = $this->session->userdata('role');
		if($is_logged_in != 0 || $role == 1)
		{
		
                    echo "<li>".anchor('/admin/list_products', 'Admin')."</li>";
                       echo "<li>".anchor('https://www.pivotaltracker.com/projects/446901', 'Support')."</li>";
                       
		}
                
                ?>
                   
    		</ul>

