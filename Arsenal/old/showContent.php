<?php
include 'header.php';
include 'config_sql.php';


echo '<div class="titleHistory">';
echo '	<div class="story">';

$id=$_GET['id'];
$db_news=mysql_query("SELECT content,title,link_img FROM news WHERE id='$id'");
$data_news=mysql_fetch_array($db_news);

echo '		<div class="news">';
echo '			<div class="row">';
echo '				<div class="col-md-3">';
echo ' 					<h4> Фото:</h4>';


$db_foto=mysql_query("SELECT id FROM foto");
$count_foto=mysql_num_rows($db_foto);
$id_picture[1]=($id+2) % $count_foto;
$id_picture[2]=($id+4) % $count_foto;
$id_picture[3]=($id+6) % $count_foto;
$id_picture[4]=($id+8) % $count_foto;
$db_foto=mysql_query("SELECT link_img FROM foto WHERE id='$id_picture[1]' OR id='$id_picture[2]' OR id='$id_picture[3]' OR id='$id_picture[4]'");
while ($data_foto=mysql_fetch_array($db_foto))
{
echo '<img  class="img-responsive" src="'.$data_foto[link_img].'">';
}
echo '</div>';
echo '<div class="col-md-6">';
echo'<div class="one_news">'.$data_news['title'].'<img src="'.$data_news['link_img'].'" class="img-responsive" >'.$data_news['content'].'</div>';
echo '</div>';
$db_other_news=mysql_query("SELECT * FROM news WHERE id<>'$id' ORDER BY id DESC");
echo '<div class="col-md-3">';
echo ' <h4> Другие новости:</h4>';
echo '<div class="mini_news">';
for ($i=1; $i<4; $i++)
{
	$data_other_news=mysql_fetch_array($db_other_news);
	echo'<div class="one_news">';
	echo'<a  href="showContent.php?id='.$data_other_news[id].'">'.$data_other_news[title].'</a>';
	echo'<img href=# src="'.$data_other_news[link_img].'" class="img-responsive">';	
	echo'<p>'.$data_other_news[review].'</p>';
	echo'</div>';
}
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
mysql_close($dbcnx);


include 'footer.php';