<?php
$servername = "172.17.0.3"; // Nome do container MySQL
$username = "root";
$password = "6283";
$dbname = "sre_desafio";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

echo "<h2>Lista de Usuários</h2>";
echo "<table border='1'><tr><th>ID</th><th>Nome</th><th>Email</th></tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["nome"] . "</td><td>" . $row["email"] . "</td></tr>";
    }
} else {
    echo "<tr><td colspan='3'>Nenhum usuário encontrado</td></tr>";
}
echo "</table>";

$conn->close();
?>
