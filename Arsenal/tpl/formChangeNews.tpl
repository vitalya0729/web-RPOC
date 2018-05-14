<form method="post" enctype = 'multipart/form-data'>
	Title: <textarea class="changeTextareaTitle" name="title" required >{DATA_NEWS->TITLE}</textarea><br/>
	link_img: <input class="changeInputLink" type="file" name="link_img" value="{DATA_NEWS->LINK_IMG}"/>
	review: <textarea class="changeTextareaReview" name="review" required >{DATA_NEWS->REVIEW}</textarea><br />
	content: <textarea class="changeTextareaContent" name="content" required >{DATA_NEWS->CONTENT}</textarea><br />
	<input class="changeButton" type="submit" name="submit" value="Сохранить" />
</form>
