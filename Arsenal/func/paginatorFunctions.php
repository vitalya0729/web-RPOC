<?php
function PaginatorPages($num_pages,$page)
{
	return pages(file_get_contents("tpl/paginatorPages.tpl"),$num_pages,$page);	
}

function pages($paginator, $num_pages,$page)
{
	$pages = '';
	for($i=1;$i<=$num_pages;$i++) 
	{
	if ($i == $page) 
	{
		$pages = $pages.file_get_contents("tpl/pagesLiActive.tpl");
		$pages = preg_replace("/{PAGE}/Ui", $i, $pages);
		$previous = $i-1;
		$next = $i+1;
	}
  	else 
  	{
  		$pages = $pages.file_get_contents("tpl/pagesLiHref.tpl");
  		$pages = preg_replace("/{PAGE}/Ui", $i, $pages);
  	}
	}
	if ($previous>=1) 
	{
		$pages = file_get_contents("tpl/pagesPrevious.tpl").$pages;
		$pages = preg_replace("/{PAGE}/Ui", $previous, $pages);
	}
	if ($next<=$num_pages) 
	{
		$pages = $pages.file_get_contents("tpl/pagesNext.tpl");
		$pages = preg_replace("/{PAGE}/Ui", $next, $pages);
	}
	$paginator = preg_replace("/{PAGES}/Ui", $pages, $paginator);
	return $paginator;
}
