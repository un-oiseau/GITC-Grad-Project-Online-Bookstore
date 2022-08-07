<?php include('connection.php');

$db = connect();

function getBooks(){
	try{
	global $db;
	$bk = $db->query("SELECT * FROM books");
	$result = $bk->fetchAll(PDO::FETCH_ASSOC);
	return $result;
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}

function getSlider(){
	try{
	global $db;
	$bk = $db->query("SELECT * FROM slider");
	$result = $bk->fetchAll(PDO::FETCH_ASSOC);
	return $result;
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}

function getCountries(){
	try{
	global $db;
	$cnt = $db->query("SELECT * FROM countries");
	$result = $cnt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}

function addUser($name,$lastName,$email,$city,$country_id,$password){
	try{
	global $db;

	$stmt = $db->prepare("INSERT INTO users (
	name,lastName,email,city,country_id,password)
	VALUES (:name,:lastName,:email,:city,:country_id,:password)");

	$stmt->bindValue(":name",$name,PDO::PARAM_STR);
	$stmt->bindValue(":lastName",$lastName,PDO::PARAM_STR);
	$stmt->bindValue(":email",$email,PDO::PARAM_STR);
	$stmt->bindValue(":city",$city,PDO::PARAM_STR);
	$stmt->bindValue(":country_id",$country_id,PDO::PARAM_INT);
	$stmt->bindValue(":password",$password,PDO::PARAM_STR);

	$stmt->execute();

	$id = $db->lastInsertId();

	return $id;

	}
	catch(PDOException $e){
		echo $e->getMessage();
	}

}

function checkMail($email){
	try{
	global $db;
	$stmt = $db->prepare("SELECT email FROM users WHERE email=:email");
	$stmt->bindValue(":email",$email,PDO::PARAM_STR);
    $stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}

function getUserById($id){
	try{
	global $db;
	$stmt = $db->prepare("SELECT *
	FROM users WHERE id=:id");
	$stmt->bindValue(":id",$id,PDO::PARAM_STR);
    $stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}

}
function login($username,$password){
	try{
	global $db;
	$stmt = $db->prepare("SELECT *
	FROM users WHERE email=:username AND password=:password");
	$stmt->bindValue(":username",$username,PDO::PARAM_STR);
	$stmt->bindValue(":password",$password,PDO::PARAM_STR);
    $stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}

function getGenres(){
	try{
	global $db;
	$cnt = $db->query("SELECT * FROM ganre");
	$result = $cnt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}

function getAuthors(){
	try{
	global $db;
	$cnt = $db->query("SELECT * FROM authors");
	$result = $cnt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}

function addAuthor($name,$lastName,$wiki_link){
	try{
	global $db;

	$stmt = $db->prepare("INSERT INTO authors (
	name,lastName,wiki_link)
	VALUES (:name,:lastName,:wiki_link)");
	$stmt->bindValue(":name",$name,PDO::PARAM_STR);
	$stmt->bindValue(":lastName",$lastName,PDO::PARAM_STR);
	$stmt->bindValue(":wiki_link",$wiki_link,PDO::PARAM_STR);

	$stmt->execute();
	$id = $db->lastInsertId();
	return $id;

	}
	catch(PDOException $e){
		echo $e->getMessage();
	}

}

function addBook($bookTitle,$genre_id,$publisher,$price,$image,$author_id,$user_id){
	try{
	global $db;

	$stmt = $db->prepare("INSERT INTO books (
	BookTitle,Genre_id,Publisher,Price,Image,author_id,user_id)
	VALUES (:BookTitle,:Genre_id,:Publisher,:Price,:Image,:author_id,:user_id)");
	$stmt->bindValue(":BookTitle",$bookTitle,PDO::PARAM_STR);
	$stmt->bindValue(":Genre_id",$genre_id,PDO::PARAM_INT);
	$stmt->bindValue(":Publisher",$publisher,PDO::PARAM_STR);
	$stmt->bindValue(":Price",$price,PDO::PARAM_STR);
	$stmt->bindValue(":Image",$image,PDO::PARAM_STR);
	$stmt->bindValue(":author_id",$author_id,PDO::PARAM_STR);
	$stmt->bindValue(":user_id",$user_id,PDO::PARAM_INT);
	$stmt->execute();


	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}

function getBooksByUserId($user_id){

try{
	global $db;
	$stmt = $db->prepare("SELECT b.*, CONCAT(a.name, '' ,a.lastName) AS author,   g.title AS genreTitle FROM books b
		LEFT JOIN authors a
		ON b.author_id = a.id
		LEFT JOIN ganre g
		ON b.Genre_id = g.id
		WHERE b.user_id = :user_id");
	$stmt->bindValue(":user_id",$user_id,PDO::PARAM_STR);
    $stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}

}

function getUserBookById($book_id,$user_id){

try{
	global $db;
	$stmt = $db->prepare("SELECT * FROM books
		WHERE user_id = :user_id AND id=:book_id");
	$stmt->bindValue(":book_id",$book_id,PDO::PARAM_INT);
	$stmt->bindValue(":user_id",$user_id,PDO::PARAM_INT);
    $stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $result;
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	}

function editBook($id,$bookTitle,$genre_id,$publisher,$price,$image,$author_id,$user_id){
	try{
	global $db;

	$stmt = $db->prepare("UPDATE books
	set BookTitle=:BookTitle, Genre_id=:Genre_id,
	Publisher=:Publisher,Price=:Price,Image=:Image,
	author_id=:author_id WHERE id=:id AND user_id=:user_id");

	$stmt->bindValue(":BookTitle",$bookTitle,PDO::PARAM_STR);
	$stmt->bindValue(":Genre_id",$genre_id,PDO::PARAM_INT);
	$stmt->bindValue(":Publisher",$publisher,PDO::PARAM_STR);
	$stmt->bindValue(":Price",$price,PDO::PARAM_STR);
	$stmt->bindValue(":Image",$image,PDO::PARAM_STR);
	$stmt->bindValue(":author_id",$author_id,PDO::PARAM_STR);
	$stmt->bindValue(":user_id",$user_id,PDO::PARAM_INT);
	$stmt->bindValue(":id",$id,PDO::PARAM_INT);
	$stmt->execute();

	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}

function removeBook($id,$user_id){

try{

	global $db;
	$db->beginTransaction();


	$stmt2 = $db->prepare("SELECT Image FROM books
		WHERE user_id = :user_id AND id=:id");
	$stmt2->bindValue(":id",$id,PDO::PARAM_INT);
	$stmt2->bindValue(":user_id",$user_id,PDO::PARAM_INT);
    $stmt2->execute();

	$result = $stmt2->fetchAll(PDO::FETCH_ASSOC);
	unlink("books/".$result[0]['Image']);

   $stmt1 = $db->prepare("DELETE FROM books
		WHERE user_id = :user_id AND id=:id");
	$stmt1->bindValue(":id",$id,PDO::PARAM_INT);
	$stmt1->bindValue(":user_id",$user_id,PDO::PARAM_INT);

	$stmt1->execute();

		$db->commit();
	}
	catch(PDOException $e){
		echo $e->getMessage();
		$db->rollback();
	}
	}

	function addSubscriber($email,$verification){
	try{
	global $db;

	$stmt = $db->prepare("INSERT INTO subscribers (
	email,verification) VALUES (:email,:verification)");
	$stmt->bindValue(":email",$email,PDO::PARAM_STR);
	$stmt->bindValue(":verification",$verification,PDO::PARAM_STR);
	$stmt->execute();
    $id = $db->lastInsertId();
	return $id;
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}

function sendSubscribeEmail($email,$url){

$subject = "Message From Book Store";
$from = "achemyankaren@gmail.com";
$msg =
'Email:'. $from.'<br/>'.
"Message:  Please Click Link below to verify it's You"."<a href=".$url.">"." Click Here</a>";

$headers = "From: achemyankaren@gmail.com\nContent-Type: text/html;charset=utf-8\n";
try{
mail($email,$subject,$msg,$headers);
	echo "Message Sent <br>";
}
catch(Exception $e) {

	echo $e;

}
}

function verifySubscriber($id,$verification){
	try{
	global $db;

	$stmt = $db->prepare("UPDATE subscribers
	set verification=:verification WHERE id=:id");

	$stmt->bindValue(":verification",$verification,PDO::PARAM_STR);
	$stmt->bindValue(":id",$id,PDO::PARAM_INT);
	$stmt->execute();

	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}

function editProfile($id,$name,$lastName,$email,$city,$country_id,$password){
	try{
	global $db;

	$stmt = $db->prepare("UPDATE users
	set name=:name, lastName=:lastName,
	email=:email,city=:city,country_id=:country_id,
	password=:password WHERE id=:id");

	$stmt->bindValue(":name",$name,PDO::PARAM_STR);
	$stmt->bindValue(":lastName",$lastName,PDO::PARAM_INT);
	$stmt->bindValue(":email",$email,PDO::PARAM_STR);
	$stmt->bindValue(":city",$city,PDO::PARAM_STR);
	$stmt->bindValue(":country_id",$country_id,PDO::PARAM_INT);
	$stmt->bindValue(":password",$password,PDO::PARAM_STR);
	$stmt->bindValue(":id",$id,PDO::PARAM_INT);
	$stmt->execute();

	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}



function sendMessage($name,$email,$message){
	try{
	global $db;
	$stmt = $db->prepare("INSERT INTO messages (
	name,email,message)
	VALUES (:name,:email,:message)");
	$stmt->bindValue(":name",$name,PDO::PARAM_STR);
	$stmt->bindValue(":email",$email,PDO::PARAM_STR);
	$stmt->bindValue(":message",$message,PDO::PARAM_STR);
	$stmt->execute();
	$id = $db->lastInsertId();
	return $id;
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
}

?>
