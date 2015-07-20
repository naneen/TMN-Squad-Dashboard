<?php
	function computeColumnSize($numberOfTeam) {
		if($numberOfTeam <= 4) {
			return $numberOfTeam;
		}
		else if($numberOfTeam <= 12) { # 4cols * 3rows
			return 4;
		}
		else if($numberOfTeam <= 24) { # 6cols * 4rows
			return 6;
		}
		else return 12;
	}
	function computeColumnSmall($columnLarge) {
		switch($columnLarge) {
			case 1: return 2;
			case 2: return 3;
			case 3: return 6;
			case 4: return 6;
			case 6: return 6;
			case 12: return 12;
		}
	}

	function getTeam() {
		global $con;
		$sql = "SELECT * FROM TEST_SQUAD ORDER BY SQUAD_NAME";
		$result = $GLOBALS['con']->query($sql);
		
		return $result;
	}
?>