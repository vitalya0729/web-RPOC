<?php
function replaceFormChangeNews()
{
	$result = file_get_contents("tpl/formChangeNews.tpl");
	include 'func/config_sql.php';
	$id = $_SESSION['id_edit'];

	$db_news = mysql_query("SELECT * FROM news WHERE id='$id'");
	$data_news = mysql_fetch_array($db_news);
	$result = preg_replace("/{DATA_NEWS->LINK_IMG}/Ui", $data_news[link_img], $result);
	$result = preg_replace("/{DATA_NEWS->TITLE}/Ui", $data_news[title], $result);
	$result = deleteTag($result,'<h3>');
	$result = deleteTag($result,'</h3>');
	$result = preg_replace("/{DATA_NEWS->REVIEW}/Ui", $data_news[review], $result);	
	$result = preg_replace("/{DATA_NEWS->CONTENT}/Ui", $data_news[content], $result);
		$result = deleteTag($result,'<p>');
	$result = deleteTag($result,'</p>');			
	return $result;
}
