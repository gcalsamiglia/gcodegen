

<?php echo validation_errors(); ?>

<?php echo form_open('index.php/document/create'); ?>

<h5>name</h5>
<input type="text" name="name" value="" size="50" />

<div><input type="submit" value="Submit" /></div>



</form>


<?php 
	foreach($source_code_list as $source_code){
		echo '<br>'.$source_code['sc_id'];
		echo '<br>'.$source_code['sc_name'];
	}
	echo '<br>';
?>

