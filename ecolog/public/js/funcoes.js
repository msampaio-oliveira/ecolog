//AJAX - Asynchronous Javascript And Xml
//Referencia:
//https://www.w3schools.com/js/js_ajax_http.asp

function criaXMLHttp() {
    Ajax = false;
    if (window.XMLHttpRequest) // navegadores modernos
    {
        Ajax = new XMLHttpRequest();
    } else if (window.ActiveXObject) // navegadores antigos - MS ie
    {
        try {
            Ajax = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                Ajax = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (ee) {
            }
        }
    }
    return Ajax
}

function criaAjax(caminho) {
    var ajax = criaXMLHttp();
    ajax.open("POST", caminho, true);
    //true envia a requisão de forma assincrona, ou seja, o script continua sendo executado
    // enquanto a requisaão é tratada
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); //Form HTML
    ajax.setRequestHeader("charset", "UTF-8");
    ajax.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate");
    ajax.setRequestHeader("Cache-Control", "post-check=0, pre-check=0");
    ajax.setRequestHeader("Pragma", "no-cache");
    return ajax;
}

function recuperarCategoria(caminho, dados) {
//caminho -> url da página que será carregada
//dados -> dados que serão enviados à página via metodo post (recupera na p�gina com $_POST['']
//formato dos dados a serem enviados -> nome=valor&end=valor
//recuperando na outra página -> $_POST['nome'] $_POST['end']       
    var ajax = criaAjax(caminho);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                //Aqui vai o código que manipula o retorno do servidor
                var resultadoAjax = ajax.responseText; // conteúdo em string
                var resultadoAjaxJson = JSON.parse(resultadoAjax); // convertido em JSON
                var categoria = document.getElementById('txtNomeCategoria');
                categoria.value = resultadoAjaxJson['nomeCategoria'];
            }
        }
    }
    ajax.send(dados);
}

function verificaCategoria(caminho, dados) {
    var cod = document.getElementById('txtCodCategoria').value;
    if (cod != "") {
        return;
    }
    var ajax = criaAjax(caminho);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                //Aqui vai o código que manipula o retorno do servidor
                var resultadoAjax = ajax.responseText; // conteúdo em string
                if (resultadoAjax !== null && resultadoAjax !== "") {
                    var resultadoAjaxJson = JSON.parse(resultadoAjax); // convertido em JSON

                    if (resultadoAjaxJson[1] !== "false") {
                        toastInformation("Categoria já cadastrada", "Por favor, insira outra categoria.");
                        var categoria = document.getElementById("txtNomeCategoria");
                        categoria.value = "";
                        categoria.focus();
                    }
                }
            }
        }
    };
    ajax.send(dados);
}

function verificaContato(caminho, dados) {
    var cod = document.getElementById('txtCodContato').value;
    if (cod != "") {
        return;
    }
    var ajax = criaAjax(caminho);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                //Aqui vai o código que manipula o retorno do servidor
                var resultadoAjax = ajax.responseText; // conteúdo em string
                if (resultadoAjax !== null && resultadoAjax !== "") {
                    var resultadoAjaxJson = JSON.parse(resultadoAjax); // convertido em JSON
                    if (resultadoAjaxJson[1] != "false") {
                        toastInformation("Contato já cadastrado", "Por favor, insira outro contato.");
                        var contato = document.getElementById("txtContato");
                        contato.value = "";
                        contato.focus();
                    }
                }
            }
        }
    };
    ajax.send(dados);
}

function verificaMaterial(caminho, dados) {
    var cod = document.getElementById('txtCodMaterial').value;
    if (cod != "") {
        return;
    }
    var ajax = criaAjax(caminho);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                //Aqui vai o código que manipula o retorno do servidor
                var resultadoAjax = ajax.responseText; // conteúdo em string    
                if (resultadoAjax !== null && resultadoAjax !== "") {
                    var resultadoAjaxJson = JSON.parse(resultadoAjax); // convertido em JSON
                    if (resultadoAjaxJson[1] != "false") {
                        toastInformation("Material já cadastrado", "Por favor, insira outro material.");
                        var material = document.getElementById("txtNomeMaterial");
                        material.value = "";
                        material.focus();
                    }
                }
            }
        }
    };
    ajax.send(dados);
}

function verificaTipoContato(caminho, dados) {
    var cod = document.getElementById('txtCodTipoContato').value;
    if (cod != "") {
        return;
    }
    var ajax = criaAjax(caminho);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                //Aqui vai o código que manipula o retorno do servidor
                var resultadoAjax = ajax.responseText; // conteúdo em string   
                if (resultadoAjax !== null && resultadoAjax !== "") {
                    var resultadoAjaxJson = JSON.parse(resultadoAjax); // convertido em JSON
                    if (resultadoAjaxJson[1] != "false") {
                        toastInformation("Tipo Contato já cadastrado", "Por favor, insira outra opção de contato.");
                        var tipoContato = document.getElementById("txtDescTipoContato");
                        tipoContato.value = "";
                        tipoContato.focus();
                    }
                }
            }
        }
    };
    ajax.send(dados);
}

function verificaTipoUsuario(caminho, dados) {
    var cod = document.getElementById('txtCodTipoUsuario').value;
    if (cod != "") {
        return;
    }
    var ajax = criaAjax(caminho);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                //Aqui vai o código que manipula o retorno do servidor
                var resultadoAjax = ajax.responseText; // conteúdo em string   
                if (resultadoAjax !== null && resultadoAjax !== "") {
                    var resultadoAjaxJson = JSON.parse(resultadoAjax); // convertido em JSON
                    if (resultadoAjaxJson[1] != "false") {
                        toastInformation("Tipo Usuário já cadastrado", "Por favor, insira outra opção de tipo usuário.");
                        var tipoUsuario = document.getElementById("txtNomeTipoUsuario");
                        tipoUsuario.value = "";
                        tipoUsuario.focus();
                    }
                }
            }
        }
    };
    ajax.send(dados);
}

function verificaLogin(caminho, dados) {
    var cod = document.getElementById('txtCodUsuario').value;
    var login = document.getElementById('txtLoginUsuario');
    if (cod != "") {
        return;
    }

    if (login.value == "") {
        return;
    }

    if (!/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}/.test(login.value)) {
        toastrInformationFront('E-mail incorreto!', 'O e-mail fornecido é inválido!');
        login.value = "";
        login.focus();
        return;
    }

    var ajax = criaAjax(caminho);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                //Aqui vai o código que manipula o retorno do servidor
                var resultadoAjax = ajax.responseText; // conteúdo em string   
                if (resultadoAjax !== null && resultadoAjax !== "") {
                    var resultadoAjaxJson = JSON.parse(resultadoAjax); // convertido em JSON
                    if (resultadoAjaxJson == 1) {
                        toastInformation("Login já utilizado", "Por favor, insira outro login.");
                        var login = document.getElementById("txtLoginUsuario");
                        login.value = "";
                        login.focus();
                    }
                }
            }
        }
    };
    ajax.send(dados);
}

function verificaDocumento(caminho, dados) {
    var cod = document.getElementById('txtCodUsuario').value;
    if (cod != "") {
        return;
    }
    var ajax = criaAjax(caminho);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                //Aqui vai o código que manipula o retorno do servidor
                var resultadoAjax = ajax.responseText; // conteúdo em string   

                if (resultadoAjax !== null && resultadoAjax !== "") {
                    var resultadoAjaxJson = JSON.parse(resultadoAjax); // convertido em JSON
                    if (resultadoAjaxJson == 1) {
                        toastrInformationFront("Documento já utilizado", "Por favor, insira outro documento de identificação.");
                        var documento = document.getElementById("txtDocUsuario");
                        documento.value = "";
                        documento.focus();
                    }
                }
            }
        }
    };
    ajax.send(dados);
}

function efetuarLogin(caminho, dados) {
    var ajax = criaAjax(caminho);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                //Aqui vai o código que manipula o retorno do servidor
                alert(ajax.responseText);
                var resultadoAjax = ajax.responseText; // conteúdo em string   
                if (resultadoAjax.includes("window.location")) {
                    var ini = resultadoAjax.indexOf("=") + 3;
                    var fin = resultadoAjax.indexOf("home") + 4;
                    window.location = resultadoAjax.substring(ini, fin);
                }


//                if (resultadoAjax !== null && resultadoAjax !== "") {
//                    var resultadoAjaxJson = JSON.parse(resultadoAjax); // convertido em JSON
//                    if (resultadoAjaxJson == 1) {
//                        toastInformation("Documento já utilizado", "Por favor, insira outro documento de identificação.");
//                        var documento = document.getElementById("txtDocUsuario");
//                        documento.value = "";
//                        documento.focus();
//                    }
//                }
            }
        }
    };
    ajax.send(dados);
}

function verificaSenha() {

    var senha = document.getElementById('txtSenhaUsuarioNova').value;
    var senhaConfirmacao = document.getElementById('txtSenhaUsuarioNovaConfirmacao').value;
    if (senha !== senhaConfirmacao) {
        document.getElementById('txtSenhaUsuarioNova').value = "";
        document.getElementById('txtSenhaUsuarioNovaConfirmacao').value = "";
        toastrErrorFront('Senha incorreta!', 'Essas senhas não coincidem. Tentar novamente.');
    }

}

function sair() {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            window.location.href = "index.php?area=home";
    }
    xmlHttp.open("GET", "index.php", true); // true for asynchronous 
    xmlHttp.send(null);
}

function recuperarEcopontoMaterial(caminho, dados, cod, name) {
//caminho -> url da página que será carregada
//dados -> dados que serão enviados à página via metodo post (recupera na p�gina com $_POST['']
//formato dos dados a serem enviados -> nome=valor&end=valor
//recuperando na outra página -> $_POST['nome'] $_POST['end']       
    var ajax = criaAjax(caminho);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4) {
            if (ajax.status == 200) {
                if (dados.includes('codEcoponto=0')) {
                    return;
                }

                if (dados.includes('codEcopontoRelacional')) {
                    // pegando o select
                    var select = document.getElementById('txtCodMaterial');
                    //Limpando o conteúdo para atualizar 
                    var quantidadeSelect = select.length;
                    for (var i = 1; i <= quantidadeSelect; i++) {
                        // depois de excluído o componente assume a posição do outro
                        select.remove(1);
                    }

                    //pegando os dados do banco e transformando em json
                    var resultadoAjax = ajax.responseText;
                    var resultadoAjaxJson = JSON.parse(resultadoAjax); // convertido em JSON


                    for (var material in resultadoAjaxJson) {
                        // montando o option
                        var option = new Option(resultadoAjaxJson[material][1], resultadoAjaxJson[material][0]);
                        //adicionando o option
                        select.add(option);
                    }
                    return;
                }

                //Aqui vai o código que manipula o retorno do servidor
                if (dados.includes('codEcoponto')) {
                    var resultadoAjax = ajax.responseText; // conteúdo em string
                    var resultadoAjaxJson = JSON.parse(resultadoAjax); // convertido em JSON
                    document.getElementById(cod).value = resultadoAjaxJson['codEcoponto'];
                    document.getElementById(name).value = resultadoAjaxJson['nomeEcoponto'];
                    recuperarEcopontoMaterial('http://localhost/ecolog/src/util/selecionarEcopontoMaterialAjax.php', 'codEcopontoRelacional=' + resultadoAjaxJson['codEcoponto'], '', '');
                }

                if (dados.includes('codMaterial')) {
                    var resultadoAjax = ajax.responseText; // conteúdo em string
                    var resultadoAjaxJson = JSON.parse(resultadoAjax); // convertido em JSON
                    document.getElementById(cod).value = resultadoAjaxJson['codMaterial'];
                    document.getElementById(name).value = resultadoAjaxJson['nomeMaterial'];
                }

            }
        }
    }
    ajax.send(dados);
}

function verificaSituacao(idInput) {

    var input = document.getElementById(idInput);
    if (input.value == 0) {
        input.focus();
        toastInformation('Aviso', 'Por favor, selecione um ecoponto para fazer a selecão do material que ele receberá.');
    }

}

function criaFunc() {
    window.documento = document.getElementById('txtDocUsuario');
    window.value = "";
    window.funcCpf = function () {
        mascara(window.documento, mcpf);
    };
    
    window.funcRg = function () {
        mascara(window.documento, mrg);
    };
}

function adicionaValidacao() {

    window.documento.value = "";
    var select = document.getElementById('txtCodTipoDocumento');
    var selecionado = select.options[select.selectedIndex].text;
    if (selecionado === "CPF" || selecionado === "cpf" || selecionado === "Cpf") {
        window.documento.setAttribute('maxlength', 14);
        window.documento.addEventListener('keyup', window.funcCpf);
    } else if (selecionado === "RG" || selecionado === "rg" || selecionado === "Rg") {
        window.documento.setAttribute('maxlength', 12);
        window.documento.addEventListener('keyup', window.funcRg);
    } else {
        window.documento.removeAttribute('maxlength', 35);
        window.documento.removeEventListener('keyup', window.funcCpf);
        window.documento.removeEventListener('keyup', window.funcRg);
    }
}

function validaEmail(id) {
     var login = document.getElementById(id);
   
    if (login.value == "") {
        return;
    }

    if (!/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}/.test(login.value)) {
        toastrInformationFront('E-mail incorreto!', 'O e-mail fornecido é inválido!');
        login.value = "";
        login.focus();
        return;
    }
}

function validaSenha(id) {
     var senha = document.getElementById(id);
   
    if (senha.value == "") {
        return;
    }

    if (!/(?=^.{8,}$)((=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/.test(senha.value)) {
        toastrInformationFront('Sinto muito!', 'Sua senha precisa conter letras maiúsculas, minúsculas, número / caractere especial e minímo de 8 caracteres.');
        senha.value = "";
        senha.focus();
        return;
    }
}