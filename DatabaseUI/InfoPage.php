<?php

	$sql = "SELECT * FROM `stock` WHERE 1";	
	$tableHeader = "<body><center><div><table id=\"infoTable\" class=\"myTable \"><tr><th>SortCode</th><th>Stock</th><th>Imported</th><th>Burned</th></tr>";	
	$r_query = mysql_query($sql); 


	//To Table Details
	if(mysql_num_rows($r_query) > 0){
		//prints StackerReclaimer_StatusTable;
		include("SR_TableStatus.php");
		// output data of each row
		echo $tableHeader;

		while ($row = mysql_fetch_array($r_query)){ 
				if($row["stock"] < 50000)
					$bgVal = "#FF000";
				else if($row["stock"] < 100000)
					$bgVal = "#FFF100";
				else $bgVal = "#00FF00";
				echo "<tr><td class=\"t-hover\">".$row["sortcode"]."</td><td bgcolor = $bgVal style=\"font-weight:bold\">".$row["stock"]."</td><td>".$row["imported"]."</td><td>".$row["burned"]."</td></tr>";
			}
			//echo $row;
			}
		echo "</table></div></body></center>";

		//include("InfoPage.php");
			
?>
<!-- This script allows user to click on table rows to direct user to More info for that Coal -->
<script>
		function addRowHandlers() {
		var table = document.getElementById("infoTable");
		var rows = table.getElementsByTagName("tr");
		for (i = 0; i < rows.length; i++)
			
			{
        var currentRow = table.rows[i];
        var createClickHandler = 
            function(row) 
            {
                return function() { 
                  var cell = row.getElementsByTagName("td")[0];
                  var rowVal = cell.innerHTML;
                  document.getElementById("searchBox").value = rowVal;
                  document.getElementById("searchButton").click();
                };
            };

			currentRow.onclick = createClickHandler(currentRow);
			}
		}
		window.onload = addRowHandlers();
</script>