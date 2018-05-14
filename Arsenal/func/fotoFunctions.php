<?php
function replaceFotoContent()
{	
	include 'config_sql.php';
	$db_foto=mysql_query("SELECT * FROM foto ORDER BY id DESC");
	$result = '';
	while	($data_foto=mysql_fetch_array($db_foto)) 
	{
		$result = $result.file_get_contents("tpl/contentFoto.tpl");
		while (preg_match("/{ADMIN=\"(.+)\"}/Ui", $result, $type_change))
        {
           	$result = preg_replace("/{ADMIN=\"(.+)\"}/Ui", replaceAdmin($type_change[1]), $result,1);
        }
		$result = preg_replace("/{DATA_FOTO->LINK_IMG}/Ui", $data_foto['link_img'], $result);
	}
	return $result;
}
