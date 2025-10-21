<?php
    $valorCompra = 118.25;
    if($valorCompra > 100){
        $desconto = $valorCompra * 10/100;
        $str_desconto = "10%";
    }
    else if ($valorCompra > 50 && $valorCompra < 100){
        $desconto = $valorCompra * 5/100;
        $str_desconto = "5%";
    }
    else {
        $desconto = 0;
        $str_desconto = "0%";
    }

    echo "Total da compra..: R$ " . number_format ($valorCompra, 2, ',', ' ') . "<br />";
    echo "(-) Desconto " . $str_desconto . ": R$" . number_format ($desconto, 2, ',', ' ') . "<br />";
    echo "Total a pagar........: R$ " . number_format ($valorCompra-$desconto, 2, ',', ' ') . "<br />";

?>