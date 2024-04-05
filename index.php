<?php

$servername = "localhost";
$username = "root";
$password = "root";
$database = "teste";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if(!$mysqli){
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";

echo "<br>";

$mysqli->query("CREATE TABLE user(id INT, nome VARCHAR(40))");

// Run a SQL query
$mysqli->query("INSERT INTO user VALUES(1,'Matheus'), (2, 'Jefferson'), (3,'Stella')");
echo "<pre>";
//$result = $mysqli->query($sql);
//var_dump($result);
echo "<br>";
echo "Ordem reversa...\n";
$result = $mysqli->query("SELECT id, nome FROM user ORDER BY id ASC");
for($row_no = $result->num_rows - 1; $row_no >= 0; $row_no--){
    $result->data_seek($row_no);
    $row = $result->fetch_assoc();
    echo " id: " . $row['id'] . " Name: " . $row['nome'] . "\n";
}

echo "<br>";

echo "Ordem do conjunto de resultados...\n";
foreach($result as $row){
    echo " id: " . $row['id'] . " Name: " . $row['nome'] . "\n" ;
}

$mysqli->query("DROP TABLE user");

$mysqli->close();
?>
