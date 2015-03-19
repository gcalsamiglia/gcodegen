<?php
	/*
	if (isset($selected_sc_value)){
		echo "<script>";
		echo "$(document).ready((function() {";
		echo "preSelectSC('".$selected_sc_value."');";
		echo "}));";	
		echo "</script>";
	}*/
?>
<?php
	echo validation_errors();
	$attributes = array('id' => 'source_code_create'); 
	echo form_open('source_code/create',$attributes); 
?>
<h5>Nom du nouveau source_code :</h5>
<input type="text" name="name" value="" size="50" />
<h5>Code source</h5>
<input type="textarea" name="value" value="" size="50" />
<?php
	foreach($active_source_code as $ligne_source_code){
		echo "<BR>";
		echo $ligne_source_code['sc_id'];
		echo "<BR>";
		echo $ligne_source_code['sc_name'];
	}
?>
<div>
	<input type="submit" value="Create" />
</div>
</form>