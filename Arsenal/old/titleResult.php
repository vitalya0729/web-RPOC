<?php
include 'config_sql.php';

$db_result=mysql_query("SELECT * FROM result ORDER BY num_points DESC");

echo'<div class="titleResult">';

if($_SESSION['admin'])
{
	echo '<a  href="editResult.php?add=true"><p class="subject">ДОБАВИТЬ РЕЗУЛЬТАТ</p></a>';
}
else
{
	echo '<p class="subject">РЕЗУЛЬТАТЫ</p>';
}

if ($data_result=mysql_fetch_array($db_result))
{
echo '<div class="result">';
echo '		<table border="1" class="res_table">';
echo '
   <caption class="res_caption"><p>'.$data_result[tourney].'</p></caption>
   <tr class="column_name">
    <th><p>№</p></th>
    <th><p>Команда</p></th>
    <th><p>Игры</p></th>
    <th><p>Очки</p></th>
   </tr>
   ';
$team_position=0;
do 
{
	$team_position++;
	echo '<tr '; if ($data_result[team]=="Арсенал") echo 'class="tr_arsenal"'; echo' >';
	echo '<td><p>'.$team_position.'</p></td>'.'<td><p>'.$data_result[team].'</p></td>'.'<td><p>'.$data_result[num_games].'</p></td>'.'<td><p>'.$data_result[num_points].'</p></td>';	
	echo '</tr>';

}while	($data_result=mysql_fetch_array($db_result));	

echo '	</table>';

echo '</div>';
}