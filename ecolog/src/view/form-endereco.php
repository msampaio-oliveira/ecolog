<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Endereço</title>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="../../public/js/LocationManager.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD0jIDGCxroPfUVdJzAGqKgnSGzy55jleg"
        async defer></script>
    </head>
    <body>
        <form action="" method="POST">
            CEP <input type="text" name="cep" id="cep" onblur="getAddress()" />
            Estado <input type="text" name="estado" id="estado" />
            Cidade <input type="text" name="cidade" id="cidade" />
            Bairro <input type="text" name="bairro" id="bairro" />
            Endereço <input type="text" name="endereco" id="endereco" /> 
            Número <input type="text" name="numero " id="numero" /> 
            Complemento<input type="text" name="complemento" id="complemento" /> 
            <br><br>
            Longitude <input type="text" name="longitude" id="longitude" />
            Latitude <input type="text" name="latitude" id="latitude" />

        </form>
        <?php
        // put your code here
        ?>
    </body>
</html>
