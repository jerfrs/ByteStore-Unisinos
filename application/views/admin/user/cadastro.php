<?php

extract($_POST);

echo 'Usuário cadastrado com sucesso:<br />';

echo "Nome: $nome<br />";
echo "Login: $login<br />";

if (!strstr($email, '@')){
    echo "E-mail invalido. <br />";
} else {
    echo "E-mail valido. <br />";
}

echo "E-mail: $email<br />";
echo "E-mail: $nivel<br />";

?>
