<?php
	$SRStatus = array("OK", "DOWN", "OUT");
	$SRStatusColor = array("#00ff00", "#FFC200", "#FF1919");
	$SR1Status = 0;
	$SR2Status = 2;
	$BedStatusColor= array("#00ff00", "#FFC200", "#FF1919");
	$BedStatus = array(0, 1, 2);

	echo "<table class = \"myTable\" style = \"padding: 5px;float:left;width:8%\">
		  <tr>
			<th>Stacker Reclaimer</th>
			<th>Status</th>
			
		  </tr>
		  <tr>
			<td>1</td>
			<td bgcolor = $SRStatusColor[$SR1Status]>$SRStatus[$SR1Status]</td>
		  </tr>
		  <tr>
			<td>2</td>
			<td bgcolor = $SRStatusColor[$SR2Status]>$SRStatus[$SR2Status]</td>
		  </tr>
			</table>";
	
	echo "<table  style = \"text-align: center;float:left; width:10%\ class= \"myTable\">
			
		<tr>
			<th>Coal Bed</th>
			<th>       </th>
		  </tr>
		  <tr>
			<td bgcolor = $BedStatusColor[2]> 1 </td>
		  </tr>
		  <tr>
			<td bgcolor = $BedStatusColor[1]> 2 </td>
		  </tr>
		  <tr>
			<td bgcolor = $BedStatusColor[0]> 3 </td>
		  </tr>
	</table><br />";

?>
