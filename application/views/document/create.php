<script>
	$(document).ready((function() {
		$('#sc_id').change(function() {
			console.log( $('#sc_id option:selected').val() );
			$.get('getsourcecodekw/'+$('#sc_id option:selected').val(),function(data,status){
				var data_decoded = eval('(' + data + ')');
				var diiv = "";
				$('#div_doc_keywords').text("");
				$.each(data_decoded, function(key, val){
					diiv += "<h5>"+val+"</h5>";
					diiv += "<input type=\"text\" name=\"keyword[]\" value=\"\" size=\"50\" />";
				});
				$('#div_doc_keywords').prepend(diiv);
			});
		});
	}));
</script>
<!--
TODO : 
	- pour gérer la présaisie des keywords déjà saisis
		- générer les input avec javascript comme au dessus
		- créer une fonction javascript qui permet de rajouter la value dans un input
		- appeler dynamiquement la fonction en php pour remplir les bonnes values 
		
		<input type="text" name="options[]" value="<?php echo set_value('options[]'); ?>" size="50" />
!-->

<?php
	echo validation_errors();

	$attributes = array('id' => 'document_create'); 
	echo form_open('index.php/document/create',$attributes); 
?>

<h5>name</h5>
<input type="text" name="name" value="" size="50" />
<select name="sc_id" id="sc_id">

<?php
foreach($source_code_list as $source_code)
{
	echo '<option value="'.$source_code['sc_id'].'">'.$source_code['sc_name'].'</option>';
}
echo '<br>';
?>
</select> 
<div id="div_doc_keywords">
</div>
<div><input type="submit" value="Submit" /></div>
</form>

