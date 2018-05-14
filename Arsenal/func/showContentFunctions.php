<?php
function replaceShowContent()
{
	include 'func/config_sql.php';
	$result = file_get_contents("tpl/contentShow.tpl");
	$id=$_GET['id'];
	$_SESSION['page'] = "showContent.php?id=$id";
	$result = preg_replace("/{SHOW_CONTENT_PICTURES}/Ui", replacePictures($id), $result);
	$result = preg_replace("/{SHOW_CONTENT_NEWS}/Ui", replaceNews($id), $result);
	$result = preg_replace("/{SHOW_CONTENT_OTHER_NEWS}/Ui", replaceOtherNews($id), $result);
	$result = preg_replace("/{COMMENTS}/Ui", replaceComments($id), $result);
	return $result;
}

function replaceOtherNews($id)
{
	$result = file_get_contents("tpl/contentShowOtherNews.tpl");

	$db_other_news=mysql_query("SELECT * FROM news WHERE id<>'$id' ORDER BY id DESC LIMIT 0,3");

	$mini_news = '';
	while ($data_other_news = mysql_fetch_array($db_other_news))
	{
		$mini_news = $mini_news.file_get_contents("tpl/CVShowOtherNews.tpl");
		$mini_news =  preg_replace("/{DATA_OTHER_NEWS->ID}/Ui", $data_other_news['id'], $mini_news);
		$mini_news =  preg_replace("/{DATA_OTHER_NEWS->TITLE}/Ui", $data_other_news['title'], $mini_news);
		$mini_news =  preg_replace("/{DATA_OTHER_NEWS->LINK_IMG}/Ui", $data_other_news['link_img'], $mini_news);
		$mini_news =  preg_replace("/{DATA_OTHER_NEWS->REVIEW}/Ui", $data_other_news['review'], $mini_news);
	}

	$result = preg_replace("/{MINI_NEWS}/Ui", $mini_news, $result);
	return $result;
}

function replaceNews($id)
{
	$result = file_get_contents("tpl/contentShowNews.tpl");
	$db_news=mysql_query("SELECT content,title,link_img FROM news WHERE id='$id'");
	$data_news=mysql_fetch_array($db_news);
	$result = preg_replace("/{DATA_NEWS->TITLE}/Ui", $data_news['title'], $result);
	$result = preg_replace("/{DATA_NEWS->CONTENT}/Ui", $data_news['content'], $result);
	$result = preg_replace("/{DATA_NEWS->LINK_IMG}/Ui", $data_news['link_img'], $result);
	return $result;
}

function replacePictures($id)
{
	$result = file_get_contents("tpl/contentShowPicture.tpl");

	$db_foto=mysql_query("SELECT id FROM foto");
	$count_foto=mysql_num_rows($db_foto);
	$id_picture[1]=($id+2) % $count_foto;
	$id_picture[2]=($id+4) % $count_foto;
	$id_picture[3]=($id+6) % $count_foto;
	$id_picture[4]=($id+8) % $count_foto;
	$db_foto=mysql_query("SELECT link_img FROM foto WHERE id='$id_picture[1]' OR id='$id_picture[2]' OR id='$id_picture[3]' OR id='$id_picture[4]'");
	$pictures = '';
	while ($data_foto=mysql_fetch_array($db_foto))
	{
		$pictures = $pictures.file_get_contents("tpl/CVShowPictures.tpl");
		$pictures = preg_replace("/{DATA_FOTO->LING_IMG}/Ui", $data_foto['link_img'], $pictures);
	}
	$result = preg_replace("/{PICTURES}/Ui", $pictures, $result);
	return $result;
}

function replaceComments($id)
{
	$result = '';
	$db_comments = mysql_query("SELECT * FROM comments WHERE page = '$id' ORDER BY id DESC");
	while ($data_comments = mysql_fetch_array($db_comments))
	{
		$result = $result.file_get_contents("tpl/comments.tpl");
		$result = preg_replace("/{TEXT_COMMENT}/Ui", $data_comments['comment'], $result);
		$result = preg_replace("/{USER}/Ui", $data_comments['user'], $result);
		if (preg_match("/{ADMIN=\"(.+)\"}/Ui", $result, $type_change))
        {
           	$result = preg_replace("/{ADMIN=\"(.+)\"}/Ui", replaceAdmin($type_change[1]), $result,1);
   			$result = preg_replace("/{DATA_COMMENTS->ID}/Ui", $data_comments['id'], $result);
        }
	if ((!(empty($_SESSION['user']))) && ($_SESSION['user'] == $data_comments['user']))		
		{
			$result = str_replace("{USER=\"deleteComment\"}", file_get_contents("tpl/deleteComment.tpl"), $result);
			$result = preg_replace("/{DATA_COMMENTS->ID}/Ui", $data_comments['id'], $result);	
		}
		else $result = str_replace("{USER=\"deleteComment\"}", "", $result);;

	}
	if (isset($_SESSION['user']))
	{
		$result = $result.file_get_contents("tpl/addComment.tpl");
		$result = preg_replace("/{PAGE_ID}/Ui", $id, $result);
	}
	else $result = $result.'<p>Чтобы оставлять комментарии, необходимо зарегестрироваться</p>';
	return $result;
}
