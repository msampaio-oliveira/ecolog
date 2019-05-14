function criaXMLHttp(){
    Ajax = false;
        if(window.XMLHttpRequest) // mozilla
        {
                Ajax = new XMLHttpRequest();
        }
        else if(window.ActiveXObject) // ie
        {
                try
                {
                        Ajax = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch(e)
                {
                        try
                        {
                                Ajax = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        catch(ee)
                        {
                       }
                }
        }
return Ajax
}


function carregaConteudoXMl(caminho,dados){
    //caminho -> url da página que será carregada
    //dados -> dados que serão enviados à página via metodo post (recupera na p�gina com $_POST['']
    //formato dos dados a serem enviados -> nome=valor&end=valor
    //recuperando na outra página -> $_POST['nome'] $_POST['end']       
        var ajax = criaXMLHttp();
        ajax.open("POST",caminho, true);
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
        ajax.setRequestHeader("charset", "UTF-8");
        ajax.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate");
        ajax.setRequestHeader("Cache-Control", "post-check=0, pre-check=0");
        ajax.setRequestHeader("Pragma", "no-cache");
        ajax.onreadystatechange = function (){
            if(ajax.readyState==4){
                    if(ajax.status==200){
                        var xmlresposta = ajax.responseXML;
                        var rua = xmlresposta.getElementsByTagName('rua').item(0);
                        var bairro = xmlresposta.getElementsByTagName('bairro').item(0);
                        var cidade = xmlresposta.getElementsByTagName('cidade').item(0);
                        var uf = xmlresposta.getElementsByTagName('uf').item(0);
                            if( rua != null && rua.firstChild != null){
                                gId('txtRua').value = rua.firstChild.data;
                                gId('txtBairro').value = bairro.firstChild.data;
                                gId('txtCidade').value = cidade.firstChild.data;
                                gId('txtUf').value = uf.firstChild.data;                                
                            }else{
                                gId('txtRua').value = "";
                                gId('txtBairro').value = "";
                                gId('txtCidade').value = "";
                                gId('txtUf').value = "";
                                showErrorToast('Cep não encontrado!');
                            }

                    }
            }
        }
        ajax.send(dados);
}

function executaConteudo(caminho,dados,idAlvo){ 
    //caminho -> url da p�gina que será executada
    //dados -> dados que ser�o enviados à página via metodo post (recupera na p�gina com $_POST['']
    //formato dos dados a serem enviados -> nome=valor&end=valor
    //recuperando na outra página -> $_POST['nome'] $_POST['end']
    //idAlvo -> id do objeto que ser� atualizado
        var alvo = gId(idAlvo)
        alvo.innerHTML="";
       
        var ajax = criaXMLHttp()
        ajax.open("POST",caminho, true);
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded")
        ajax.setRequestHeader("charset", "ISO-8859-1")
        ajax.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate")
        ajax.setRequestHeader("Cache-Control", "post-check=0, pre-check=0")
        ajax.setRequestHeader("Pragma", "no-cache")
        ajax.onreadystatechange = function (){
            if(ajax.readyState==4){
                    if(ajax.status==200){
                        alvo.innerHTML = ajax.responseText;
                       
                    }
            }
        }
        ajax.send(dados)
}


function executaSQL(caminho,dados){ 
    //caminho -> url da p�gina que será executada
    //dados -> dados que ser�o enviados à página via metodo post (recupera na p�gina com $_POST['']
    //formato dos dados a serem enviados -> nome=valor&end=valor
    //recuperando na outra página -> $_POST['nome'] $_POST['end']
    //idAlvo -> id do objeto que ser� atualizado
       
        var ajax = criaXMLHttp()
        ajax.open("POST",caminho, true);
        ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded")
        ajax.setRequestHeader("charset", "ISO-8859-1")
        ajax.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate")
        ajax.setRequestHeader("Cache-Control", "post-check=0, pre-check=0")
        ajax.setRequestHeader("Pragma", "no-cache")
        ajax.onreadystatechange = function (){
            if(ajax.readyState==4){
                    if(ajax.status==200){
                        showSuccessToast("Dados Salvos!");
                        gId('acao').value = '2';
                        gId('idCliente').value = ajax.responseText;
                       
                    }
            }
        }
        ajax.send(dados)
}

function gId(ID) {
    return document.getElementById(ID);
}

