function validarDocumento(documento) {

    $.ajax({
        method: "GET",
        url: "src/controller/UsuarioController.php?acao=4&documento=" + documento,
        success: function (data, textStatus, jqXHR) {
            if (data) {
                toastInformation("Documento de identificação já cadastrado!");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toastError(textStatus + " error " + errorThrown + " " + jqXHR.toString());
        }
    });
}

function validarLogin(login) {

    $.ajax({
        method: "GET",
        url: "src/controller/UsuarioController.php?acao=5&login=" + login,
        success: function (data, textStatus, jqXHR) {
            if (data) {
                toastInformation("Login já utilizado!");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toastError("Status: " + textStatus + " erro: " + errorThrown);
        }
    });
}

function validarLogin(txtLogin) {
    
}
//var formatText = string = > string.replace(/([A-Z])(\w+)/g, ($0, $1, $2) = > $1 + $2.toLocaleLowerCase());