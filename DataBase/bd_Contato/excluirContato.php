<?php
if(isset($_GET['modo']))
{
    if(strtoupper($_GET['modo']) == 'EXCLUIR')
    {
        if(isset($_GET['id']) && $_GET['id'] != "")
        {            
            require_once('../../modulos/config.php');

            require_once('../conexaoMysql.php');
            
            if(!$conex = conexaoMysql())
            {
                echo("<script> alert('".ERRO_CONEX_BD_MYSQL."'); </script>");
            }
        
            $idContato = $_GET['id'];

            $sql = "delete from tblcontatos 
                    where idContato = " . $idContato;

            //Executa no BD o Script SQL
            if (mysqli_query($conex, $sql))
            {
                echo("
                        <script>
                            alert('".REGITRO_EXCLUIDO_SUCESSO."');
                            location.href = '../../CMS/index.php';
                        </script>
                ");
            }
            else
                echo("
                        <script>
                            alert('".ERRO_EXCLUIR_DADOS."');
                            window.history.back();
                        </script>

                    ");
            
        }else 
            echo("
            <script>
                alert('".NENHUM_REGISTRO_INFORMADO."');
                location.href = '../../CMS/index.php';
            </script>
    
        ");
        
    }else 
        echo("
            <script>
                alert('".REQUISI_INVALIDA."');
                location.href = '../../CMS/index.php';
            </script>
    
        ");
    
}else
    echo("
            <script>
                alert('".ACESSO_INVALIDO."');
                location.href = '../../CMS/index.php';
            </script>
    
        ");

?>