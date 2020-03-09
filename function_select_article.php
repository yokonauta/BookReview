<?php

//require_once("function_select_article.php");
;

/*------------------------------------------------
 call
	$total = get_total_count($db_file,"article")
--------------------------------------------------*/
function get_total_count($db_file,$table)
{
    $file_db = new PDO($db_file);
    $sql = "SELECT count(*) FROM ";
	$sql = $sql . $table;
    $stmt = $file_db->prepare($sql);
    $stmt->execute();
    $total = $stmt->fetchColumn();
    $file_db = null;
	return $total;
}

/*------------------------------------------------
 call 
	$result = select_article($db_file,2);
--------------------------------------------------*/

function select_article_firstpage($db_file,$limit)
{
	//=== ARTICLE ===
    $file_db = new PDO($db_file);
    $sql = "SELECT article.id,title,intro,body,author.first_name,author.last_name,genre.name,pub_date,state,image1";
    $sql = $sql . " FROM article";
    $sql = $sql . " INNER JOIN author ON article.author_id = author.id";
    $sql = $sql . " INNER JOIN genre  ON article.genre_id  = genre.id";
    $sql = $sql . " ORDER BY pub_date DESC LIMIT ";
	$sql = $sql . $limit;
    $stmt = $file_db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $file_db = null;
    return $result;
}

function select_article_one_page($db_file,$range,$cursor)
{
    $db = new PDO($db_file);
    $sql = "SELECT article.id,title,intro,body,author.first_name,author.last_name,genre.name,pub_date,state,image1";
    $sql = $sql . " FROM article";
    $sql = $sql . " INNER JOIN author ON article.author_id = author.id";
    $sql = $sql . " INNER JOIN genre ON article.genre_id = genre.id";
    $sql = $sql . " ORDER BY article.pub_date DESC";
    $sql = $sql . " LIMIT " . $range . " OFFSET " . $cursor; 
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $db = null;
    return $result;
}	
	
function select_article_by_genre($db_file,$genre)
{
	//=== ARTICLE ===
    $file_db = new PDO($db_file);
    $sql = "SELECT article.id,title,intro,body,author.first_name,author.last_name,pub_date,state,image1";
    $sql = $sql . " FROM article";
    $sql = $sql . " INNER JOIN author ON article.author_id = author.id";
    $sql = $sql . " where genre_id = $genre";
    $stmt = $file_db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $file_db = null;
	return $result;
}

function select_article_by_id($db_file,$id)
{
    //=== ARTICLE ===
    $file_db = new PDO($db_file);
    $sql = "SELECT article.id,title,intro,body,author.first_name,author.last_name,genre.name,pub_date,state,image1";
    $sql = $sql . " FROM article";
    $sql = $sql . " INNER JOIN author ON article.author_id = author.id";
    $sql = $sql . " INNER JOIN genre ON article.genre_id = genre.id";
    $sql = $sql . " where article.id = $id";
    $stmt = $file_db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $file_db = null;
	return $result;
}

function select_article_by_genre_for_list($db_file,$filter,$range,$cursor)
{
    //=== ARTICLE ===
    $db = new PDO($db_file);
    $sql = "SELECT article.id,title,intro,body,author.first_name,author.last_name,genre.name,pub_date,state,image1";
    $sql = $sql . " FROM article";
    $sql = $sql . " INNER JOIN author ON article.author_id = author.id";
    $sql = $sql . " INNER JOIN genre ON article.genre_id = genre.id";
    $sql = $sql . " WHERE article.genre_id = " . $filter;
    $sql = $sql . " ORDER BY article.pub_date DESC";
    $sql = $sql . " LIMIT " . $range . " OFFSET " . $cursor; 
    //print($sql);
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $file_db = null;
	return $result;
}

function total_count_by_genre($db_file,$filter)
{
    // total rows by genre
    $db = new PDO($db_file);
    $sql = "SELECT COUNT(*) from article";
	if ($filter) $sql = $sql . " WHERE article.genre_id = " . $filter;
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $total = $stmt->fetchColumn();
    $file_db = null;
	return $total;
}

function total_count_genre($db_file)
{
    //=== GENRE ===
    $genre_db = new PDO($db_file);
    $stmt = $genre_db->prepare("SELECT * FROM genre");
    $stmt->execute();
    $genre_result = $stmt->fetchAll();
    $genre_db = null;
    $genre_list_cnt = count($genre_result);
	return $genre_result;
}	



?>









