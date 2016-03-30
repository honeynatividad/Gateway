<div class="row">
<ul class="list-group cal-event">
    
  <?php foreach($events as $e){?>
    <li class="list-group-item">
        <div class="datetext">
        <span><?php echo date('M',strtotime($e->Requestdate));?></span>
        <h4><?php echo date('d',strtotime($e->Requestdate));?></h4>
        </div>
        <span><?php 
        $prov = $e->APEType;
        echo (string)$prov;?></span> 
        <p><?php echo $e->RequestStatus ?></p>
        <p><?php echo $e->ProviderName ?></p>
    </li>  
   <?php }?>         
</ul>
</div>


