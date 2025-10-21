<?php
    //Exemplos de funções

    //não recebe parâmetro e não retorna dados - f1
    function f_mensagem(){
        echo "ADS - UPF";
    }

    //recebe parâmetro e não retorna dados - f2
    function f_boasVindas($a){
        echo "Oi $a";
    }

    //não recebe parâmetros e retorna dados - f3
    function f_conteudo(){
        $c ="Linguagem PHP";
        return $c;
    }

    //recebe parâmetros e retorna dados - f4
    function f_soma($v1,$v2){
        return $v1 + $v2;
    }

   










?>