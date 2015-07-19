<html>
<body>
	<h1>Config Dashboard</h1>
	<div>
		<table>
			<colgroup>
				<col width="70%">
				<col width="30%">
			</colgroup>
			<tbody>
			
			<tr>
				<td>
				
				</td>

			</tr>
			<tr>
			 <form name="form" method="GET" action="process.php">
        <p>Config Guage Limit<br/>
        <?php
        	error_reporting(E_ERROR);
        	$ffile = "data.txt";
        	if(!file_exists($ffile)){
        	$ffile = fopen($ffile, 'w');
        	}else {
        	}
        	$lines = file($ffile);
        	if(is_null($lines[0])){
				  fwrite($ffile, 10);
				  fclose($fh);
        	}
        ?>

        <?php $lines = file("data.txt"); ?>
        	
          	<select name="select">
          	<?php
          		$array = array(2,3,4,5,6,7,8,9,10,11,12,13,14);
          		foreach ($array as $value) {
					echo '<option value="'.$value.'"';
					if ($lines[0] == $value) {echo ' selected="selected"';}
					echo '>'.$value.'</option>' ;
				}
			?>
			</select>

        </p>

        <p> 
          <input type="submit" name="Submit" value="Submit"/>
        </p>

      </form>
			</tr>
			</tbody>
		</table>
	</div>
</body>
</html>

