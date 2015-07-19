<?php
	$targetdirectory = $_GET[directory];
	//echo $targetdirectory + "<br>";
	$filecontent = simplexml_load_file($targetdirectory);
	
	$result = $filecontent->xpath("//*[@s='false']");///responseData
	//$result = $filecontent->xpath("//*[@s='false']/responseData|//*[@s='false']/java.net.URL");///responseData
	
?>
<a href="qualityreport.php">&lt;&lt;BACK</a>
<table border="1" width="100%">
<tr><td colspan="3"><center><b><H1>Error filter</H1></b></center></td></tr>
<tr>
<td>
<center><b>Test URL</b></center>
</td>
<td>
<center><b>Request message</b></center>
</td>
<td>
<center><b>Error response message</b></center>
</td>
</tr>
<?php
	//while(list( , $node) = each($result)) {
	foreach($result as $node) {//queryString
		echo "<tr>";
		echo "<td>";
		echo $node->{'java.net.URL'};
		echo "</td>";
		echo "<td>";
		echo htmlentities($node->queryString);
		echo "</td>";
		echo "<td>";
		echo htmlentities($node->responseData);
		echo "</td>";
		echo "</tr>";
	}
?>	
</table>
