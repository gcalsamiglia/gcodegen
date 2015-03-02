<div class="simple_frame">
<?php
foreach($doc_array as $doc)
{
	echo "<div class=\"row_tab_doc\">";
		echo "<div class=\"cell_tab_doc\">";
		echo $doc['doc_id'];
		echo "</div>";

		echo "<div class=\"cell_tab_doc\">";
		echo "<a href=\"/index.php/document/view/".$doc['doc_id']."\">".$doc['doc_name']."</a>";
		echo "</div>";

	echo "</div>";

}
?>
</div>

