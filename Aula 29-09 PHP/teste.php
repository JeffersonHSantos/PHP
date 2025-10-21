<?php
include_once ('funcoes.php');

    f_mensagem(); //- f1
    echo "<br />";

    $nome = "Ana Eduarda"; //- f2
    f_boasVindas($nome);

    echo "<br />";//- f3
    $dados = f_conteudo();
    echo "$dados";

    echo "<br />";//- f4
    $soma = f_soma(84,90);
    echo "Resultado: $soma";






?>