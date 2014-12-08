

<?php echo validation_errors(); ?>

<?php echo form_open('index.php/document/create'); ?>

<h5>name</h5>
<input type="text" name="name" value="" size="50" />
<select name="sc_id">

<?php
foreach($source_code_list as $source_code){
	echo '<option value="'.$source_code['sc_id'].'">'.$source_code['sc_name'].'</option>';
}
echo '<br>';
?>

</select> 
<div><input type="submit" value="Submit" /></div>
</form>

