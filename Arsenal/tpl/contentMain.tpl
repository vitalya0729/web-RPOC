<div class="news">
{ADMIN="add_news"}
	<div class="one_news">
		<div class="row">
			<div class="col-md-4">
				<a href="showContent.php?id={DATA_NEWS->ID}"><img src="{DATA_NEWS->LINK_IMG}" class="img-responsive"></a>
			</div>
			<div class="col-md-8">
				<a href="showContent.php?id={DATA_NEWS->ID}">{DATA_NEWS->TITLE}</a>
				<p>{DATA_NEWS->REVIEW}</p>
			</div>
			{ADMIN="edit_news"}
			{ADMIN="delete_news"}
		</div>
	</div>
</div>
