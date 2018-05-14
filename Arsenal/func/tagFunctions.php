<?php
function deleteTag($text, $tag)
{
	return  str_replace ($tag, '' ,$text);
}
