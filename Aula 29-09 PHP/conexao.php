
<?php
function conectarBD(){

    $conexao= mysqli_connect("localhost", "root", "", "baseTeste");
        if(!$conexao){
            die("Conexão falhou! ".mysqli_connect_error());
        }else{
            //echo "Conexão realizada!";
        }
        return ($conexao);

} // final da função

function desconectarBD($con){

    mysqli_close($con);

}// final da função

?>