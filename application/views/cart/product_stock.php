<?php
$is_logged_in = $this->session->userdata('is_logged_in');
$user_id = $this->session->userdata('user_id');
$role = $this->session->userdata('role');
if ($is_logged_in != NULL && $role < 5) {
    ?>
<table id="attributes" width=100%>
         <thead>
            <tr>
                <td>Cat</td>
                <td>Option</td>
                <td>Stock</td>
                <td>Action</td>
            <td>in Cart</td>
            </tr>

        </thead>
        <tbody>
    <?php foreach($attributes as $row):?>
    <tr>
   <td> <?= $row->option_category ?></td>
  <td>  <?= $row->option ?></td>
<td id="stock_<?=$row->option_id?>"><?= $row->stock_level ?>   </td>
      <td>   
         <span  style="width:18px; float:left;" class="ui-icon ui-icon-circle-minus spanlink" onclick="lowerstock('<?=$user_id?>', '<?=$row->option_id?>')" ></span>  
          
        <span  style="width:18px; float:left;" class="ui-icon ui-icon-circle-plus spanlink" onclick="raisestock('<?=$user_id?>', '<?=$row->option_id?>')" ></span>  
      </td>
      
      <td id="cart_<?=$row->option_id?>">
      
      <?php
      $cart_value = 0;
       if($cart != NULL) { foreach($cart as $row2):
      
          if($row2->cart_option_id == $row->option_id) { 
          
                
                
                $cart_value = $row2->quantity; 
               
          
           } 
           
         
           
           ?>
          
      <?php endforeach; }
     
        
      echo $cart_value;
        
      
       ?>
      
      
      
      </td>
    </tr>
    <?php endforeach; ?>
    </table>

<?php } ?>
