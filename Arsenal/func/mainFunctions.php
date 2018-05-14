<?php
function replaceMainContent()
{
	$count_news_on_page = 5;
	if (isset($_GET['page']))
	{
		$page = $_GET['page'];
	}
	else
	{
		$page = 1;
	}
	include 'func/config_sql.php';
	$db=mysql_query("SELECT count(*) FROM news");
	$count_news=mysql_fetch_array($db)['0'];
	$num_pages=ceil($count_news/$count_news_on_page);
	$first_news=($page-1)*$count_news_on_page;
	$db_news=mysql_query("SELECT * FROM news  ORDER BY id DESC LIMIT $first_news, $count_news_on_page");
	$result = '';
	while ($data_news=mysql_fetch_array($db_news))
	{
		$result = $result.file_get_contents("tpl/oneNews.tpl");
		while (preg_match("/{ADMIN=\"(.+)\"}/Ui", $result, $type_change))
        {
           	$result = preg_replace("/{ADMIN=\"(.+)\"}/Ui", replaceAdmin($type_change[1]), $result,1);
   			$result = preg_replace("/{DATA_NEWS->ID}/Ui", $data_news['id'], $result);
        }
		$result = preg_replace("/{DATA_NEWS->LINK_IMG}/Ui", $data_news['link_img'], $result);
		$result = preg_replace("/{DATA_NEWS->TITLE}/Ui", $data_news['title'], $result);
		$result = preg_replace("/{DATA_NEWS->REVIEW}/Ui", $data_news['review'], $result);	
	}

	$result = $result.paginatorPages($num_pages,$page);
	return $result;
}

