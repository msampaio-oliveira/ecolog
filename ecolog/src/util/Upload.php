<?php

namespace Util;

class Upload {

    //Atributos 
    //Local de armazenamento
    protected $caminhoArmazenamento = null;
    //Lista de tipos de arquivo permitidos
    protected $extensoesPermitidas = array();

    //Método construtor

    public function __construct($local, $listaPermitidos) {
        $this->caminhoArmazenamento = $local;
        $this->extensoesPermitidas = $listaPermitidos;
    }

    //Métodos GET e SET
    public function getCaminhoArmazenamento() {
        return $this->caminhoArmazenamento;
    }

    public function setCaminhoArmazenamento($caminho) {
        $this->caminhoArmazenamento = $caminho;
    }

    public function getExtensoesPermitidas() {
        return $this->extensoesPermitidas;
    }

    public function setExtensoesPermitidas($lista) {
        $this->extensoesPermitidas = $lista;
    }

    //Métodos
    public function upload() {
        //responsável por realizar o upload --> mover o arquivo para o local desejado 
        $arquivo = $_FILES['arquivo'];
        if ($this->validaDados() === true) {
            $diretorioLocal = getcwd();
            $diretorioLocal = str_replace('\\src\\View', '', $diretorioLocal ); 
            $pastaDestino = $diretorioLocal . DIRECTORY_SEPARATOR . $this->caminhoArmazenamento;
            //representa o caminho completo do arquivo até a pasta de destino
            $arquivoUpload = $pastaDestino . DIRECTORY_SEPARATOR . $arquivo["name"];
            if (move_uploaded_file($arquivo["tmp_name"], $arquivoUpload)) {
                return true;
            } else {
                return 11;
            }
        }else{
            return $this->validaDados(); 
        }
    }

    public function validaDados() {
        //validar 
        // se o arquivo realmente foi upado - ok
        // se já existe arquivo com o mesmo nome - ok
        // o tipo de arquivo - ok
        // $_FILES -- erros
        $arquivo = $_FILES['arquivo'];

        if ($arquivo['error'] == 0) {
            //não tem erro arquivo upado com sucesso
            //montar o caminho até a pasta de destino do upload
            $diretorioLocal = getcwd();
            //montando caminho harcoded 
            // $pastaDestino = $diretorioLocal . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "upload";
            //montar caminho  utilizando o atributo;
            $pastaDestino = $diretorioLocal . DIRECTORY_SEPARATOR . $this->caminhoArmazenamento;

            //representa o caminho completo do arquivo até a pasta de destino
            $arquivoUpload = $pastaDestino . DIRECTORY_SEPARATOR . $arquivo["name"];

            if (!file_exists($arquivoUpload)) {
                //não existe arquivo com o mesmo nome

                if (in_array($arquivo['type'], $this->extensoesPermitidas)) {
                    //extensao permitida                
                    return true;
                } else {
                    //extensão proibida
                    return 10;
                }
            } else {
                return 9;
            }
        } else {
            //Arquivo não chegou ao servidor com sucesso ver codigos de erro abaixo
            return $arquivo['error'];
        }
    }

}

