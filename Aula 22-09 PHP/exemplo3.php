<?php
    $valores = array(6,1,8,10,5);

    //mostrar os valores do array

    foreach($valores as &$i){
        echo "$i". " ";
    }

    // somar os elementos do Array
    $soma = array_sum($valores);
    echo "<br />" . "Soma => $soma"; 

    // Sortear o valor do array
    $sorteio = array_rand($valores,1);
    echo "<br />" . "Sorteado => $valores[$sorteio]";

    //ordenar o array
    rsort($valores); 
    echo "<br /> Ordem decrescente <br/>";
        foreach($valores as &$i){
            echo "$i" . " ";
        }
    
    //ordenar o array
    sort($valores);
    echo "<br /> Ordem crescente <br/>";
        foreach($valores as &$i){
            echo "$i" . " ";
        }

    //nº elementos do array
    $t = count($valores);
    echo "<br /> Nº elementos do array: $t";


?>