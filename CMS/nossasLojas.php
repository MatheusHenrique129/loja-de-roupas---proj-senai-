<?php
$action = "../DataBase/bd_Lojas/inserirLoja.php";

//Import do arquivo de Variaveis e Constantes
require_once('../modulos/config.php');

//Import do arquivo de função para conectar no BD
require_once('../DataBase/conexaoMysql.php');

//Chama a função que estabelece a conexão com o BD
if(!$conex = conexaoMysql())
{ 
    echo("<script> alert('".ERRO_CONEX_BD_MYSQL."') </script>");
}

    if(isset($_GET['modo']))
    {
        if(strtoupper($_GET['modo']) == "CONSULTAR")
        {
            if(isset($_GET['id']) && $_GET['id'] !="")
            {
                $id = $_GET['id'];

                session_start();

                $_SESSION['id'] = $id;

                $sql = "select * from tblnossaslojas where idLojas = ".$id;                 
                
                    $select = mysqli_query($conex, $sql);

                if($rsLojas = mysqli_fetch_assoc($select))
                {
                    $nome = $rsLojas['nome'];
                    $celular = $rsLojas['celular'];
                    $endereco = $rsLojas['endereco'];

                    $action = "../DataBase/bd_Lojas/atualizarLoja.php";    
                }
            }
        }        
    }
     
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS do Site</title>

    <link rel="icon" href="imagens/Logo.png">

    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@400;700;900&display=swap" rel="stylesheet">
    <script src="js/jquery.js"></script>

    <script>
        $(document).ready(function() {
            $(".pesquisar").click(function() {
                $(".modalContainer").fadeIn(3000);
            });
        });

        function visualizarLoja(id) {
            $.ajax({
                type: "POST",
                url: "../DataBase/bd_Lojas/visualizarLoja.php",
                data: {idLojas: id},
                success: function(dados) {
                    $(".modal").html(dados);
                }
            });
        }

    </script>

</head>

<body>
    <!--SEÇÃO MODAL-->
    <div class="modalContainer">
        <div class="modal">

        </div>
    </div>
    <div id="container" class="centerObject">
        <header id="header">
            <div id="container-logo">
                <div id="CMS-text">
                    <h1>CMS</h1>
                    <p>- Sistema de Gerenciamento do Site</p>
                </div>

                <div id="logo">
                    <img src="imagens/Logo.png">
                </div>

            </div>

            <!--SEÇÃO MENU-->
            <nav id=" container-menu">

                <!--SEÇÃO CARDS MENU-->
                <div id="container-cards-menu">

                    <div class="capsula-cards">
                        <a href="#">
                            <div class="imagem-cards-menu">
                                <img src="icone/conteudo.png">
                            </div>
                            <div class="text-cards-menu">
                                <p>Adm. Conteúdo</p>
                            </div>
                        </a>
                    </div>

                    <div class="capsula-cards" id="abaFale_conosco">
                        <a href="index.php">
                            <div class="imagem-cards-menu">
                                <img src="icone/icon_fale-conosco.png">
                            </div>
                            <div class="text-cards-menu">
                                <p>Adm. Fale Conosco</p>
                            </div>
                        </a>
                    </div>


                    <div class="capsula-cards">
                        <a href="nossasLojas.php">
                            <div class="imagem-cards-menu">
                                <img src="icone/protudos.png">
                            </div>
                            <div class="text-cards-menu">
                                <p>Adm. Produtos</p>
                            </div>
                        </a>
                    </div>


                    <div class="capsula-cards">
                        <a href="usuarios.php">
                            <div class="imagem-cards-menu">
                                <img src="icone/usuario.png">
                            </div>
                            <div class="text-cards-menu">
                                <p>Adm. Usuários</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!--SEÇÃO BOAS VINDAS-->
                <div id="container-logout">
                    <div id="bem-vindo">
                        <p>Bem-vindo(a), {xxxxxx}.</p>
                    </div>
                    <div id="logout">
                        <p>Logout</p>
                    </div>
                </div>
            </nav>
        </header>

        <!--SEÇÃO CONTEUDO-->
        <section id="conteudo">
            <div id="cadastroUsuarios" class="centerObject">
                <div id="cadastroTitulo">
                    <h1>Cadastros de Loja</h1>
                </div>
                <div id="cadastroInformacoes">
                    <form action="<?=$action?>" name="frmLojas" method="post" enctype="multipart/form-data">
                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <p> Nome da Loja: </p>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtNome" value="<?=@$nome?>" placeholder="Digite um nome*" required pattern="[a-z A-Z é-É]*">
                            </div>
                        </div>
                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <p> Celular: </p>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="tel" name="txtCelular" value="<?=@$celular?>" pattern="[(][0-9]{2}[)][0-9]{5}-[0-9]{4}" placeholder="(99)99999-9999">
                            </div>
                        </div>
                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <p> Endereço: </p>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="text" name="txtEndereco" value="<?=@$endereco?>" placeholder="Endereço, numero*" required pattern="[a-z A-Z é-É]*">
                            </div>
                        </div>
                        <div class="campos">
                            <div class="cadastroInformacoesPessoais">
                                <p> Escolha uma imagem: </p>
                            </div>
                            <div class="cadastroEntradaDeDados">
                                <input type="file" name="fleFoto" accept=".png, .jpg">
                            </div>
                        </div>
                        <div id="formEnviar">
                            <div class="enviarUsuarios">
                                <?php
                                       if(isset($_GET['modo']) && strtoupper($_GET['modo'])=="CONSULTAR")
                                       {
                                    ?>
                                <input type="submit" name="btnEnviar" value="Atualizar">
                                <?php
                                       }
                                       else
                                       {
                                    ?>
                                <input type="submit" name="btnEnviar" value="Salvar">
                                <?php
                                       }
                                    ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div id="consultaDeDados" class="centerObject">
                <table id="tblConsulta">
                    <tr>
                        <td id="tblTitulo" colspan="5">
                            <h1> Consulta de Usuários.</h1>
                        </td>
                    </tr>
                    <tr id="tblLinhas">
                        <td class="tblColunas">Nome</td>
                        <td class="tblColunas">Celular</td>
                        <td class="tblColunas">Endereço</td>
                        <td class="tblColunas">Imagem</td>
                        <td class="tblColunas">Opções</td>
                    </tr>

                    <?php
    
                        $sql = "select * from tblnossaslojas order by tblnossaslojas.idLojas desc;";
    
//                        $sql = " select tblcontatos.idContato, tblcontatos.nome, tblcontatos.celular, tblcontatos.email, tblcontatos.profissao, tblcontatos.statusContato"
                    
                        $select = mysqli_query($conex, $sql);
                          
                        while($rsLojas = mysqli_fetch_assoc($select))
                        {                    
                    ?>
                    <tr id="tblLinhas">
                        <td class="tblColunas"><?=@$rsLojas['nome']?></td>
                        <td class="tblColunas"><?=@$rsLojas['celular'];?></td>
                        <td class="tblColunas"><?=@$rsLojas['endereco']?></td>
                        <td class="tblColunas"><img src="../arquivos/<?=$rsLojas['foto']?>" class="foto"></td>
                        <td class="tblColunas">
                            <div class="cardsImagens">
                                <a href="../DataBase/bd_Lojas/excluirLoja.php?modo=excluir&id=<?=$rsLojas['idLojas']?>&foto=<?=$rsLojas['foto']?>" onclick="return confirm('Deseja realmente excluir esse Registro?')">
                                    <img src="icone/delete.png" alt="Excluir" title="Excluir" class="excluir">
                                </a>
                            </div>
                            <div class="cardsImagens">
                                <a href="nossasLojas.php?modo=consultar&id=<?=$rsLojas['idLojas']?>&foto=<?=$rsLojas['foto']?>">
                                    <img src="icone/edit.png" alt="Editar" title="Editar" class="editar">
                                </a>
                            </div>
                            <div class="cardsImagens">
                                <img src="icone/visualizar.png" alt="modal" title="Pesquisar" class="pesquisar" onclick="visualizarLoja(<?=$rsLojas['idLojas']?>);">
                            </div>
                            <div class="cardsImagens">
                                <a href="../DataBase/bd_Lojas/ativarDesativarLojas.php?modo=status&id=<?=$rsLojas['idLojas']?>&status=<?=$rsLojas['statusLoja']?>">
                                    <img src="icone/<?=$rsLojas['statusLoja']?>.png" alt="Status" title="Status" class="editar">
                                </a>
                            </div>
                            
                            <div class="cardsImagens">
                                <a href="../DataBase/bd_Lojas/ativarDesativarLojas.php?modo=status&id=<?=$rsLojas['idLojas']?>&status=<?=$rsLojas['statusLoja']?>">
                                    <img src="icone/<?=$rsLojas['statusLoja']?>.png" alt="Status" title="Status" class="editar">
                                </a>
                            </div>
                            
                        </td>
                    </tr>

                    <?php
                        }
                    ?>

                </table>
            </div>



        </section>

        <footer id="footer">
            <p>Desenvolvido por: Matheus Henrique Santos Da Silva</p>
        </footer>
    </div>
</body>

</html>
