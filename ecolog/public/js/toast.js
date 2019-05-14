function toastSuccess(titulo, mensagem) {
    $.toast({
        heading: titulo,
        text: mensagem,
        showHideTransition: 'slide', // Pode ser plain, fade or slide
        bgColor: 'rgba(74, 161, 82, 1)', // Cor de fundo do toast #7FFFD4
        textColor: 'white', // Cor padrão do texto
        allowToastClose: true, // Mortat o botão fechar ou não
        hideAfter: 7000, // Tempo em milisegundos para que o toast se feche, se 'false' o toast não fecha
        stack: 5, // Define o número de toasts que podem aparecer de uma só vez
        textAlign: 'top-left', // Em que posição o texto deve ficar dentro do toast
        position: 'top-right', // bottom-left ou bottom-right ou bottom-center ou top-left ou top-right ou top-center
        loader: false, // False esconde a barra de carregamento indicando que a toast vai fechar
        icon: 'success'                     // Qual ícone vai aparecer dentro do Toast
    });
}

function toastInformation(titulo, mensagem) {
    $.toast({
        heading: titulo,
        text: mensagem,
        showHideTransition: 'slide', // Pode ser plain, fade or slide
        bgColor: 'rgba(0, 139, 139, 0.8)', // Cor de fundo do toast #7FFFD4
        textColor: 'white', // Cor padrão do texto
        allowToastClose: true, // Mortat o botão fechar ou não
        hideAfter: 7000, // Tempo em milisegundos para que o toast se feche, se 'false' o toast não fecha
        stack: 5, // Define o número de toasts que podem aparecer de uma só vez
        textAlign: 'top-left', // Em que posição o texto deve ficar dentro do toast
        position: 'top-right', // bottom-left ou bottom-right ou bottom-center ou top-left ou top-right ou top-center
        loader: false, // False esconde a barra de carregamento indicando que a toast vai fechar
        icon: 'info'                        // Qual ícone vai aparecer dentro do Toast
    });
}

function toastError(titulo, mensagem) {
    $.toast({
        heading: titulo,
        text: mensagem,
        showHideTransition: 'slide', // Pode ser plain, fade or slide
        bgColor: 'rgba(195, 55, 40, 1)', // Cor de fundo do toast #7FFFD4
        textColor: 'white', // Cor padrão do texto
        allowToastClose: true, // Mortat o botão fechar ou não
        hideAfter: 7000, // Tempo em milisegundos para que o toast se feche, se 'false' o toast não fecha
        stack: 5, // Define o número de toasts que podem aparecer de uma só vez
        textAlign: 'top-left', // Em que posição o texto deve ficar dentro do toast
        position: 'top-right', // bottom-left ou bottom-right ou bottom-center ou top-left ou top-right ou top-center
        loader: false, // False esconde a barra de carregamento indicando que a toast vai fechar
        icon: 'error'                     // Qual ícone vai aparecer dentro do Toast
    });
}

// DOCUMENTAÇÃO -> https://kamranahmed.info/toast
// BIBLIOTECA   -> https://github.com/kamranahmedse/jquery-toast-plugin/https://github.com/kamranahmedse/jquery-toast-plugin/


function toastSuccessFront(titulo, mensagem) {
    toastSuccess(titulo, mensagem)
    var elementos = document.getElementsByClassName('jq-toast-single jq-has-icon');
    elementos[0].classList.add('toast-position');
}

function toastrErrorFront(titulo, mensagem) {
    toastError(titulo, mensagem)
    var elementos = document.getElementsByClassName('jq-toast-single jq-has-icon');
    elementos[0].classList.add('toast-position');
}

function toastrInformationFront(titulo, mensagem) {
    toastInformation(titulo, mensagem)
    var elementos = document.getElementsByClassName('jq-toast-single jq-has-icon');
    elementos[0].classList.add('toast-position');
}

// CONFIRMAÇÂO
function confirm() {
    $.confirm({
        title: 'Deseja realmente excluir a sua conta?',
        content: 'Ao excluir a sua conta todos os seus dados serão perdidos permanentemente!',
        type: 'red',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Sim',
                btnClass: 'btn-red',
                action: function () {
                    var xmlHttp = new XMLHttpRequest();
                    xmlHttp.onreadystatechange = function () {
                        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
                            window.location.href = "index.php";
                    }
                    var cod = document.getElementById('txtCodUsuario').value;
                    xmlHttp.open("GET", "index.php?area=adm&folder=cadastro&page=cadastroUsuario&acao=6&id=" + cod, true); // true for asynchronous 
                    xmlHttp.send(null);
                }

            },
            nao: function () {
            }
        }
    });
    setTimeout(function () {
        var element = document.getElementsByClassName('jconfirm-box jconfirm-hilight-shake jconfirm-type-red jconfirm-type-animated')
        element[0].classList.add('confirm-position');
    }, 500);

}