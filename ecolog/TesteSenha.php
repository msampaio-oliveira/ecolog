<?php
require_once './src/util/Bcrypt.php';
// Encriptando a senha
$senha = '1234';
$hash = Util\Bcrypt::hash($senha);


// $hash = $2a$08$MTgxNjQxOTEzMTUwMzY2OOc15r9yENLiaQqel/8A82XLdj.OwIHQm
// Salve $hash no banco de dados
// Verificando a senha
$senha = '1234';
$hash = '$2a$08$OTE1NTExODExNWM1MWEwO.G3MlibGlf5RyaHQurZ5WQ8NkqwBOEnm'; // Valor retirado do banco
if ( Util\Bcrypt::check($senha, $hash)) {
	echo 'Senha OK!';
} else {
	echo 'Senha incorreta!';
}
