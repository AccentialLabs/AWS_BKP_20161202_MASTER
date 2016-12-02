<table class="table table-hover" id="serviceByNameTb">
        
	<?php 
            foreach($services as $service){ ?>
		<tr>
			<td onclick="clickInSearch('<?php echo utf8_encode($service['subclasses']['name']);?>')" ><?php echo utf8_encode($service['subclasses']['name']);?></td>
		<tr>
            <?php }?>
</table>