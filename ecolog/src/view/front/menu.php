<?php 
//carregamento do arquivo de configuração

require_once 'config/config.php';

$valor = isset($_SESSION['usuarioLogado']) ? true : false;
 ?>


<nav id="menu">
    <div id="icones_menu">
        <a href="index.php?area=home"><img id="iHome" src="<?php echo _URLBASE_; ?>public/img/icone_menu_home768.png" alt=""/></a>    
        <a><img id="iVendas" src="<?php echo _URLBASE_; ?>public/img/icone_menu_vendas768.png" alt=""/></a>
        <a><img id="iDicas" src="<?php echo _URLBASE_; ?>public/img/icone_menu_dicas768.png" alt=""/></a>
        <a><img id="iBolsa" src="<?php echo _URLBASE_; ?>public/img/icone_menu_bolsa768.png" alt=""/></a>
        <a><img id="iEcolog" src="<?php echo _URLBASE_; ?>public/img/icone_menu_ecolog768.png" alt=""/></a>
        <a><img id="iRotas" src="<?php echo _URLBASE_; ?>public/img/icone_menu_rotas768.png" alt=""/></a>
        <?php
        if (!$valor) {

            echo "<a href='" . _URLBASE_ . "index.php?mensagem=login'><img id='iUser' src='" . _URLBASE_ . "public/img/icone_menu_user768.png' alt=''/></a>";
        } else {
            echo "<a href='" . _URLBASE_ . "index.php?acao=sair'><img id='iUser' src='" . _URLBASE_ . "public/img/logo-out.png' alt=''/></a>";
        }
        ?>
    </div>
</nav>