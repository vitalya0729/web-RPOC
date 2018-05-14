<br>
<br>
<form name="comment" action="comment.php" method="post">
	<p>
		<label>Добавить комментарий:</label>
		<br />
		<textarea class ="comment" name="text_comment" cols="30" rows="50"></textarea>
	</p>
	<p>
		<input type="hidden" name="page_id" value="{PAGE_ID}"/>
		<input type="submit" value="Отправить" />
	</p>
</form>
