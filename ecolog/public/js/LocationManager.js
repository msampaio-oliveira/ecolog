function limpa_formulário_cep() {
    // Limpa valores do formulário de cep.
    $("#txtEndereco").val("");
    $("#txtBairro").val("");
    $("#txtCidade").val("");
    $("#txtEstado").val("");
    $("#txtLatitude").val("");
    $("#txtLongitude").val("");
    $("#txtCep").val("");
}

function getLatitudeLongitude() {
    var geocoder = new google.maps.Geocoder();
    var cep = $("#txtCep").val().replace(/\D/g, '');
    if (cep != null && validaCep(cep)) {
        geocoder.geocode({'address': cep}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                $("#txtLongitude").prop('readonly', true);
                $("#txtLatitude").prop('readonly', true);
                $("#txtLatitude").val(results[0].geometry.location.lat());
                $("#txtLongitude").val(results[0].geometry.location.lng());
            } else {
                if ($("#txtLatitude").val() == "" && $("#txtLongitude").val() == "") {
                    $("#txtLatitude").prop('readonly', false);
                    $("#txtLongitude").prop('readonly', false);
                    toastError("Não foi possivel obter Longitude e Latitude!", "Por favor, insira sua latitude e longitude.");
                }
            }
        });
    }
}

function validaCep(cep) {
    //Expressão regular para validar o CEP.F
    var validacep = /^[0-9]{8}$/;
    return validacep.test(cep);
}

function getAddress() {
    //Nova variável "cep" somente com dígitos.
    var cep = $("#txtCep").val().replace(/\D/g, '');
    //Verifica se campo cep possui valor informado.
    if (cep != "") {
        //Valida o formato do CEP.
        if (validaCep(cep)) {
            //Preenche os campos com "..." enquanto consulta webservice.
            $("#txtEndereco").val("...");
            $("#txtBairro").val("...");
            $("#txtCidade").val("...");
            $("#txtEstado").val("...");
            
            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                if (!("erro" in dados)) {
                    getLatitudeLongitude();
                    //Atualiza os campos com os valores da consulta.
                    $("#txtEndereco").val(dados.logradouro);
                    $("#txtBairro").val(dados.bairro);
                    $("#txtCidade").val(dados.localidade);
                    $("#txtEstado").val(dados.uf);
                    $("#txtNumero").focus();
                    $("#txtEndereco").prop('disabled', true);
                    $("#txtBairro").prop('disabled', true);
                    $("#txtCidade").prop('disabled', true);
                    $("#txtEstado").prop('disabled', true);
                } else {
                    //CEP pesquisado não foi encontrado.
                    limpa_formulário_cep();
                    toastrErrorFront("CEP não encontrado.", "Por favor, informe suas informações.");
                }
            });
        } else {
            //cep é inválido.
            limpa_formulário_cep();
            toastrErrorFront("CEP inválido.", "Formato de CEP inválido, tente novamente.");
            $("#txtCep").focus();
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
}

function preecheFormulario() {
    var cep = $("#txtCep").val().length;
    if (!cep < 8) {
        getAddress();
    }

}