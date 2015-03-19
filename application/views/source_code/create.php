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

<script>
	$(function() {
		$( "#sortable" ).sortable();
		$( "#sortable" ).disableSelection();
	});
</script>

<?php
	echo validation_errors();
	$attributes = array('id' => 'sour<_create'); 
	echo form_open('source_code/create',$attributes); 
?>
<h5>Nom du nouveau source_code :</h5>
<input type="text" name="name" value="" size="50" />
<h5>Code source</h5>
<input type="textarea" name="value" value="" size="50" />
<?php
	echo "<ul id=\"sortable\">";
	$indice = 0;
	foreach($active_source_code as $ligne_source_code){
		$indice++;
		echo "<li class=\"ui-state-default list-dragable\" >";
		echo $ligne_source_code['sc_id'];
		echo $ligne_source_code['sc_name'];	
		echo "<input type=\"checkbox\" name=\"checked_sc".$ligne_source_code['sc_id']."\" value=\"".$ligne_source_code['sc_id']."\">";
		echo "</li>";
	}
	echo "</ul>";
?>
<div>
	<input type="submit" value="Create" />
</div>
</form>