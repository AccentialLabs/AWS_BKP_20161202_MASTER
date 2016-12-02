<?php
if(!empty($providers)){
?>
<table class="table table-hover" id="serviceByNameTb">
	<?php foreach($providers as $provider){
            $fancyname = utf8_encode($provider['providers']['fancy_name'])
                    ?>
		<tr>
			<td onclick="clickInSearchBrand('<?php echo addslashes($fancyname);?>')" ><?php echo $fancyname;?></td>
		<tr>
        <?php }?>
</table>
<?php
}
?>