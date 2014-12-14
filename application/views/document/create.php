<?php
	if (isset($selected_sc_value)){
		echo "<script>";
		echo "$(document).ready((function() {";
		echo "preSelectSC('".$selected_sc_value."');";
		echo "}));";	
		echo "</script>";
	}
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
				diiv += "<input type=\"text\" class=\"<?php echo $this->config->item('keyword_input_prefix');?>"+val+"\" id=\""+val+"\" name=\"<?php echo $this->config->item('keyword_input_prefix');?>"+val+"\" value=\"\" size=\"50\" />";
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
		$(".div_doc_keywords").find("."+input_name).val(input_value);
	}

	// select the user selected source code 
	function preSelectSC(sc_select_value){
		$('#sc_id option[value='+sc_select_value+']').attr("selected", "selected");
	}



</script>

<?php
	/* Update values of keyword list according
	*  to user inputs
	*/
	echo "<script>";
	echo "function populateKWListCallBack(){";
		if (isset($keywords_input)){
			echo "\n";
			//var_dump($keywords_input);
			foreach ($keywords_input as $key => $value) {
				echo "populateKWList('".$key."','".$value."');";					
			}			
		}
	echo "};";
	echo "</script>";
?>

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

