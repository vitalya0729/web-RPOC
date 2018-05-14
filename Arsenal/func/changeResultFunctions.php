<?php
function replaceFormChangeResult()
{
	$result = file_get_contents("tpl/formChangeResult.tpl");
	include 'func/config_sql.php';
	$id = $_SESSION['id_edit'];

	$db_news = mysql_query("SELECT * FROM result WHERE id='$id'");
	$data_news = mysql_fetch_array($db_news);
	$result = preg_replace("/{DATA_RESULT->TEAM}/Ui", $data_news[team], $result);
	$result = preg_replace("/{DATA_RESULT->NUM_GAMES}/Ui", $data_news[num_games], $result);
	$result = preg_replace("/{DATA_RESULT->NUM_POINTS}/Ui", $data_news[num_points], $result);	
	$result = preg_replace("/{DATA_RESULT->TOURNEY}/Ui", $data_news[tourney], $result);			
	return $result;
}


