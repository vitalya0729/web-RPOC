<?php
include 'config_sql.php';
$db_foto=mysql_query("SELECT link_img FROM foto");
echo'
<div class="titleFoto">
	<p class="subject">ФОТОГАЛЕРЕЯ</p>
	<div class="row">
';
while ($data_foto=mysql_fetch_array($db_foto))
{
echo '<img class="col-md-3 col-sm-6" src="'.$data_foto[link_img].'">';
}
echo '
	</div>
</div>
';
