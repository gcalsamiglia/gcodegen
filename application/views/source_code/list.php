<div class="simple_frame">
<?php
foreach($sc_array as $sc)
{
	echo "<div class=\"row_tab_doc\">";
		echo "<div class=\"cell_tab_doc\">";
		echo $sc['sc_id'];
		echo "</div>";
		echo "<div class=\"cell_tab_doc\">";
		echo "<a href=\"/index.php/source_code/view/".$sc['sc_id']."\">".$sc['sc_name']."</a>";
		echo "</div>";
	echo "</div>";
}
?>
</div>
