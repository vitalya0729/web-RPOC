<?php
//const
$count_news_on_page=5;

include 'config_sql.php';

if ($_GET['page'])
{
	$page = $_GET['page'];
}
else
{
	$page = 1;
}


$res=mysql_query("SELECT id FROM news");
$count_news=mysql_num_rows($res);
$first_news=$count_news-($page*$count_news_on_page)+1;
$last_news=$first_news+$count_news_on_page-1;

//echo $first_news;
//echo $last_news;

$db_news=mysql_query("SELECT * FROM news WHERE id>='$first_news' AND id<='$last_news' ORDER BY id DESC ");



if($_SESSION['admin'])
{
	echo '<ahref="editNews.php?add=true"><p class="subject">ДОБАВИТЬ НОВОСТЬ</p></a>';
}
else
{
	echo '<p class="subject">НОВОСТИ</p>';
}
echo '<div class="titleMain">';
for ($i=1;$i<6;$i++)
{
	$data_news=mysql_fetch_array($db_news);
	if ($data_news)
	{
		echo'<div class="news">';
		echo'<div class="one_news">';
		echo'	<div class="row">';
		echo'		<div class="col-md-4">';
		echo'			<img href=# src="'.$data_news[link_img].'" class="img-responsive">';
		echo'		</div>';
		echo'		<div class="col-md-8">';
		echo'			<a href="showContent.php?id='.$data_news[id].'">'.$data_news[title].'</a>';
		echo'			<p>'.$data_news[review].'</p>';
		if($_SESSION['admin'])
		{
			echo'			<br/>';
			echo'			<br/>';
			echo'<p><a href="editNews.php?id='.$data_news[id].'">Edit</a></p>';
			echo'<p><a href="editNews.php?delete='.$data_news[id].'">Detele</a></p>';
		}
		echo'		</div>';
		echo'	</div>';
		echo'</div>';
		echo'</div>';
	}
}
echo '</div>';

//first_news<last_news
//$num_news=$count_news;
$news_right=$first_news-1;
//$news_left=$last_news;
// echo ($num_news-$news_right).'<br/>';
// echo $news_right.'<br/>';
// echo $news_left.'<br/>';

echo '<div class="pages">';
echo '		<ul>';
if ($page > 3) {echo '<li>...</li>';}
if ($page >2) {echo '<li><a href="main.php?page='.($page-2).'">'.($page-2).'</a></li>';}
if ($page >1) {echo '<li><a href="main.php?page='.($page-1).'">'.($page-1).'</a></li>';}
echo '<li><a class = "active" href="main.php?page='.($page).'">'.($page).'</a></li>';
if (($news_right)>0) {echo '			<li><a href="main.php?page='.($page+1).'">'.($page+1).'</a></li>';}

if (($news_right-$count_news_on_page)>0) 
	{
	echo '			<li><a href="main.php?page='.($page+2).'">'.($page+2).'</a></li>';
 	}
if (($news_right-2*$count_news_on_page)>0) 
{
	echo '			<li><a href="main.php?page='.($page+2).'">'.($page+2).'</a></li>';
	if ($page == 1) 
 		{
 			echo '			<li><a href="main.php?page='.($page+3).'">'.($page+3).'</a></li>';
 		}
 	
}
if (($news_right-3*$count_news_on_page)>0) 
{
echo '			<li>...</li>';
}
echo '		</ul>';
echo '</div>';

mysql_close($dbcnx);