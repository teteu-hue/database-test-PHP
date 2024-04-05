<?php

$servername = "localhost";
$username = "root";
$password = "root";
$database = "database";

// create connection
$mysqli = new mysqli($servername, $username, $password, $database);

// check connection
if(!$mysqli){
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";

echo "<br>";

// rodando uma query SQL
// criando uma tabela "user"
$mysqli->query("CREATE TABLE user(id INT, nome VARCHAR(40))");

// colocando valores na tabela "user"
$mysqli->query("INSERT INTO user VALUES(1,'Matheus'), (2, 'Jefferson'), (3,'Stella')");
echo "<pre>";

echo "<br>";

echo "Ordem reversa...\n";
// rodando uma query SELECT
$result = $mysqli->query("SELECT id, nome FROM user");

// a função "query" retorna um array
var_dump($result);

echo " ================ <br>";

// fetch_array -> vai acessar sempre o primeiro elemento da função.

echo "num_row <br>";
$num_row = $result->fetch_array(MYSQLI_NUM);
echo " id: " . $num_row[0] . " Name: " . $num_row[1] . "<br>";

var_dump($num_row);

// na segunda chamada ele ajusta o ponteiro interno e chama a proxima linha
echo "num_assoc <br>";
$num_assoc = $result->fetch_array(MYSQLI_ASSOC);

var_dump($num_assoc);

// na terceira chamada ele ajusta novamente o ponteiro inteiro e chama a proxima linha
echo "num_both <br>";
$num_both = $result->fetch_array(MYSQLI_BOTH);

var_dump($num_both);

// interando sobre o array retornado começando pela última posição para exibi-lo de maneira decrescente na tela
for($row_no = $result->num_rows -1 ; $row_no >= 0; $row_no--){
    // data_seek -> Busca o resultado no array apartir do id passado
    $result->data_seek($row_no);
    echo "<br>";
    // fetch_assoc -> retorna a linha do banco em forma de array
    $row = $result->fetch_assoc();
    // var_dump($row); // retirar o comentário para obter informações de como a informação retorna
    echo " id: " . $row['id'] . " Name: " . $row['nome'] . "\n";
}

echo "<br>";

echo "Ordem do conjunto de resultados...\n";
// interando sobre o array retornado começando da primeira posição até a última
foreach($result as $row){
    echo " id: " . $row['id'] . " Name: " . $row['nome'] . "\n" ;
}

// rodando uma query DROP TABLE
$mysqli->query("DROP TABLE user");

// fechando conexão com o banco de dados
$mysqli->close();
?>
