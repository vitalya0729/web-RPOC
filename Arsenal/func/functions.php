<?php

function replaceTopLine()
{
	if (isset($_SESSION['user']))
	{
		$result = file_get_contents("tpl/lineUser.tpl");
		include_once 'func/config_sql.php';
		$login = $_SESSION['user'];
 		if (mysql_fetch_array(mysql_query("SELECT email FROM users WHERE login='$login'"))['email'] == NULL)
 		{
 			$result = str_replace("{EMAIL}", file_get_contents("tpl/lineAddEmail.tpl"), $result);
 		}
 		else 
 		{
 			$result = str_replace("{EMAIL}", '', $result);
		}
		return 	$result;
		
	}
	else
	{
		return file_get_contents("tpl/lineEnterRegister.tpl");
	}
}

function replaceDV($nameDV)
{		
switch ($nameDV) 
	{
		case 'MAIN_CONTENT':
			include 'func/mainFunctions.php';
			include 'func/paginatorFunctions.php';
			return replaceMainContent();
			break;		
		case 'RESULT_CONTENT':
			include 'func/resultFunctions.php';
			return replaceResultContent();
			break;
		case 'HISTORY_CONTENT':
			include 'func/historyFunctions.php';
			return replaceHistoryContent();
			break;
		case 'FOTO_CONTENT':
			include 'func/fotoFunctions.php';
			return replaceFotoContent();
			break;
		case 'REGISTRATION_CONTENT':
			include 'func/registrationFunctions.php';
			return replaceRegistrationContent();
			break;
		case 'ERROR_ENTER':
			include 'func/replaceErrorFunctions.php';
			return replaceErrorContent();
			break;
		case 'ERROR_REGISTRATION':
			include 'func/replaceErrorFunctions.php';
			return replaceErrorContent();
			break;
		case 'ERROR_ADD_EMAIL':
			include 'func/replaceErrorFunctions.php';
			return replaceErrorContent();
			break;
		case 'TOP_LINE':
			return replaceTopLine();
			break;
		case 'FORM_CHANGE_NEWS':
			include 'func/tagFunctions.php';
			include 'func/changeNewsFunctions.php';
			return replaceFormChangeNews();
			break;
		case 'FORM_CHANGE_RESULT':
			include 'func/changeResultFunctions.php';
			return replaceFormChangeResult();
			break;
		case 'FORM_CHANGE_FOTO':
			include 'func/changeFotoFunctions.php';
			return replaceFormChangeFoto();
			break;
		case 'SHOW_CONTENT':
			include 'func/showContentFunctions.php';
			return replaceShowContent();
			break;
		case 'ADD_EMAIL_CONTENT':
			include 'func/AddEmailContent.php';
			return replaceAddEmailContent();
			break;
	}
}

function replaceFile($path,$page_name)
{	
	if ($path == "TITLE")
	{
		return file_get_contents("tpl/title".$page_name.".tpl");
	}
	else
	{
		return file_get_contents($path);
	}
}

function replaceTitle($page_name)
{
	switch ($page_name) 
	{
		case 'Main':
			return 'Арсенал->Главная страница';
			break;
		case 'Result':
			return 'Арсенал->Конкуренты';
			break;
		case 'History':
			return 'Арсенал->История';
			break;
		case 'Foto':
			return 'Арсенал->Фото';
			break;
		case 'Registration':
			return 'Арсенал->Регистрация';
			break;
		case 'Rules':
			return 'Арсенал->Правила сайта';
			break;
		case 'Enter':
			return 'Арсенал->Вход';
			break;
		case 'ChangeNews':
			return 'Изменение новостей';
			break;
		case 'ChangeResult':
			return 'Изменение данных';
			break;
		case 'ChangeFoto':
			return 'Изменение фотогалереи';
			break;
		case 'ShowContent':
			return 'Арсенал';
			break;
		case 'ConfirmEmailT':
			return 'подтверждение E-mail';
			break;
		case 'ConfirmEmailF':
			return 'Додтверждение E-mail';
			break;
		case 'AddEmail':
			return 'Добавение E-mail';
			break;
	}
}


function replaceSubject($page_name)
{
	switch ($page_name) 
	{
		case 'Main':
			return 'НОВОСТИ';
			break;
		case 'Result':
			return 'Ассортимент';
			break;
		case 'History':
			return 'ИСТОРИЯ';
			break;
		case 'Foto':
			return 'ФОТОГАЛЕРЕЯ';
			break;
		case 'Registration':
			return 'РЕГИСТРАЦИЯ';
			break;
		case 'Rules':
			return 'ПРАВИЛА САЙТА';
			break;
		case 'Enter':
			return 'Вход';
			break;
		case 'ChangeNews':
			return 'Изменение новостей';
			break;
		case 'ChangeResult':
			return 'Изменение данных';
			break;
		case 'ChangeFoto':
			return 'Изменение фотогалереи';
			break;
		case 'ShowContent':
			return 'НОВОСТИ';
			break;
		case 'ConfirmEmailT':
			return 'E-mail подтверждён';
			break;
		case 'ConfirmEmailF':
			return 'E-mail не подтверждён';
			break;	
		case 'AddEmail':
			return 'Добавение E-mail';
			break;
	}
}

function replaceUser()
{
	if (isset($_SESSION['user']))
		return $_SESSION['user'];
	return '';
}

function replaceAdmin($type_change)
{
	if ((isset($_SESSION['user'])) && ($_SESSION['user']=='admin'))
	{
		return file_get_contents("tpl/".$type_change.".tpl");	
	}
	else return '';
}

function replaceActive($page_name,$id_active)
{
	if ($page_name===$id_active)
	{
		return 'id="active"';
	}
	return "";
}

function createPage($template,$page_name)
{
	ini_set('display_errors','Off');
	$page = file_get_contents($template);
	//for ($i=1;$i<9;$i++)
	while (preg_match("/{(.+)}/Ui", $page))
        {
        	if (preg_match("/{DV=\"(.+)\"}/Ui", $page, $nameDV))
        	{
            	$page = preg_replace("/{DV=\"(.+)\"}/Ui", replaceDV($nameDV[1]), $page);
            }
            if (preg_match("/{FILE=\"(.+)\"}/Ui", $page, $file_path))
            {
            	$page = preg_replace("/{FILE=\"(.+)\"}/Ui", replaceFile($file_path[1],$page_name), $page, 1);
            }
            if (preg_match("/{ADMIN=\"(.+)\"}/Ui", $page, $type_change))
            {
            	$page = preg_replace("/{ADMIN=\"(.+)\"}/Ui", replaceAdmin($type_change[1]), $page);
            }
            $page = preg_replace("/{TITLE}/Ui", replaceTitle($page_name), $page);
            $page = preg_replace("/{SUBJECT}/Ui", replaceSubject($page_name), $page);
            $page = preg_replace("/{USER}/Ui", replaceUser(), $page);
            if (preg_match("/{ACTIVE=\"(.+)\"}/Ui", $page, $id_active))
            {
            $page = preg_replace("/{ACTIVE=\"(.+)\"}/Ui", replaceActive($page_name,$id_active[1]), $page, 1);
        	}
        }
	return $page;
}
