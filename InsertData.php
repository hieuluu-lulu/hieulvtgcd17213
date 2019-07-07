<!DOCTYPE html>
<html>
    <head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
    body{
      background: pink;
</style>
</head>
<body>
<h1>INSERT DATA TO DATABASE</h1>
<form>
         <button type="submit" formaction="index.php">HOME</button>
</form>
<h2>Enter data into employee table:</h2>
<ul>
    <form name="InsertData" action="InsertData.php" method="POST" >
<li><strong>Employee ID:</strong></li>  <li><input type="text" name="empid" /></li>
<li><strong>Full name:</strong></li>    <li><input type="text" name="empname" /></li>
<li><strong>Email:</strong></li><li>    <input type="text" name="empemail" /></li>
<li><strong>Phone number:</strong></li>    <li><input type="text" name="empphone" /></li>
<li><input type="submit" value="INSERT" /></li>
</form>
</ul>
<?php
if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=d1p4s9tn317skt', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-107-21-216-112.compute-1.amazonaws.com;user=vqoyrrfrdqcuqi;password=ca37d91a3471218b790955172b4d5eee9751e43e6bc194243211ce7c44bda3bf;dbname=d1p4s9tn317skt",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  
if($pdo === false){
     echo "ERROR: Could not connect Database";
}
$sql = "INSERT INTO employee(empid, empname, empemail, empphone)"
        . " VALUES('$_POST[empid]','$_POST[empname]','$_POST[empemail]','$_POST[empphone]')";
$stmt = $pdo->prepare($sql);
//$stmt->execute();
 if (is_null($_POST[empid])) {
   echo "Employee must be not null";
 }
 else
 {
    if($stmt->execute() == TRUE){
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record: ";
    }
 }
?>
</body>
</html>