<?php
    $nome = $_POST  ["caixa1"];
    $cidades = $_POST ["cidades"];
    $usuario = $_POST ["user"];
    
    
    if(empty($nome)) {
        echo"O Campo deve ser preenchido!" . "<br />";
    } else {
        echo "Nome => <strong>$nome</strong>" . "<br />";

    }// final do if

    echo "Cidade => $cidades" . "<br />";
    echo "Usuário => $usuario" . "<br />";

    if(isset( $_POST ["opc"])) {
        echo "As leituras de preferência são:" . "<br />";
        foreach( $_POST ["opc"] as $n) {
            echo "* " . "$n" . "<br />" ; //Percorrendo o Array
        }
    }
    else {
        echo "Nenhum selecionado" . "<br />"; // se vazio
    }

    if(isset( $_POST ["livros"])) {
        echo "Livros preferidos são:" . "<br />";
        foreach( $_POST ["livros"] as $o) {
            echo "* " . "$o" . "<br />" ; //Percorrendo o Array
        }
    }
    else {
        echo "Nenhum selecionado" . "<br />"; // se vazio
    }



?>