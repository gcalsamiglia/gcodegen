<?php
	echo "<script>";
	echo "$(document).ready((function() {";
		if (isset($selected_sc_value)){
			echo "preSelectSC('".$selected_sc_value."');";
		}

	echo "}));";	
	echo "</script>";
?>

<script>
	// create the keywords input list
	function createKWSelect(){
		$.get('getsourcecodekw/'+$('#sc_id option:selected').val(),function(data,status){
			var data_decoded = eval('(' + data + ')');
			var diiv = "";
			$('#div_doc_keywords').text("");
			$.each(data_decoded, function(key, val){
				diiv += "<h5>"+val+"</h5>";
				diiv += "<input type=\"text\" class=\"keyword["+key+"]\" id=\"keyword["+key+"]\" name=\"keyword["+key+"]\" value=\"\" size=\"50\" />";
			});
			$('#div_doc_keywords').prepend(diiv);
			populateKWListCallBack();
		});
	}

	$(document).ready((function() {
		$('#sc_id').change(function() {
			createKWSelect();
		});
		createKWSelect();	
	}));

	// Populate the keyword input with already 
	// inputed values
	function populateKWList(input_name, input_value){		
		input_name = input_name.replace("[","\\[");
		input_name = input_name.replace("]","\\]");
		console.log($(".div_doc_keywords").find("."+input_name));
		$(".div_doc_keywords").find("."+input_name).val(input_value);
	}

	function preSelectSC(sc_select_value){
		//$('#sc_id').selected(sc_select_value);
		$('#sc_id option[value='+sc_select_value+']').attr("selected", "selected");
	}



</script>

<?php
	echo "<script>";
	echo "function populateKWListCallBack(){";
		if (isset($keywords_input)){
			echo "\n";
			foreach ($keywords_input as $key => $value) {
				echo "\n";
				//echo "console.log('".$value."');";
				echo "populateKWList('keyword[".$key."]','".$value."');";
			}			
		}
	echo "};";
	echo "</script>";
?>
<!--
TODO :
	- refaire selectionner le source code dans le select 
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
<div class="div_doc_keywords" id="div_doc_keywords">
</div>
<div><input type="submit" value="Submit" /></div>
</form>

