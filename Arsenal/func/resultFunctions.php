<?php
function replaceTeam($team)
{
	if ($team == 'Арсенал')
		return 'class="tr_arsenal"';
	return '';
}

function replaceResultContent()
{
	include 'config_sql.php';
	$db_result=mysql_query("SELECT * FROM result ORDER BY num_points DESC");
	$team_position=0;
	$result = '';
	while	($data_result=mysql_fetch_array($db_result)) 
	{
		$team_position++;
		$result = $result.file_get_contents("tpl/oneResult.tpl");
		while (preg_match("/{ADMIN=\"(.+)\"}/Ui", $result, $type_change))
        {
           	$result = preg_replace("/{ADMIN=\"(.+)\"}/Ui", replaceAdmin($type_change[1]), $result,1);
           	$result = preg_replace("/{DATA_RESULT->ID}/Ui", $data_result['id'], $result);
        }
		$result = preg_replace("/{TEAM}/Ui", replaceTeam($data_result['team']), $result);
		$result = preg_replace("/{TEAM_POSITION}/Ui", $team_position, $result);
		$result = preg_replace("/{DATA_RESULT->TEAM}/Ui", $data_result['team'], $result);
		$result = preg_replace("/{DATA_RESULT->NUM_GAMES}/Ui", $data_result['num_games'], $result);
		$result = preg_replace("/{DATA_RESULT->NUM_POINTS}/Ui", $data_result['num_points'], $result);
	}

	return $result;
}
