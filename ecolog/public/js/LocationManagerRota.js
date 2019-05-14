function limpa_formulário_cep(idEndereco, idBairro, idCidade, idEstado, idLatitude, idLongitude) {
    // Limpa valores do formulário de cep.
    $(idEndereco).val("");
    $(idBairro).val("");
    $(idCidade).val("");
    $(idEstado).val("");
    $(idLatitude).val("");
    $(idLongitude).val("");
}

function getLatitudeLongitude(idCep, idLatitude, idLongitude) {
    var geocoder = new google.maps.Geocoder();
    var cep = $(idCep).val().replace(/\D/g, '');
    if (cep != null && validaCep(cep)) {
        geocoder.geocode({'address': cep}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                $(idLatitude).val(results[0].geometry.location.lat());
                $(idLongitude).val(results[0].geometry.location.lng());
            } else {

                if ($(idLatitude) == "" && $(idLongitude) == "") {
                    $(idLongitude).prop('readonly', false);
                    $(idLatitude).prop('readonly', false);
                    toastError("Não foi possivel obter Longitude e Latitude!");
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


function getAddress(idCep, idEndereco, idBairro, idCidade, idEstado, idLatitude, idLongitude, idNumero) {
    //Nova variável "cep" somente com dígitos.
    var cep = $(idCep).val().replace(/\D/g, '');
    //Verifica se campo cep possui valor informado.
    if (cep != "") {
        //Valida o formato do CEP.
        if (validaCep(cep)) {
            //Preenche os campos com "..." enquanto consulta webservice.
            $(idEndereco).val("...");
            $(idBairro).val("...");
            $(idCidade).val("...");
            $(idEstado).val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                if (!("erro" in dados)) {
                    getLatitudeLongitude(idCep, idLatitude, idLongitude);
                    //Atualiza os campos com os valores da consulta.
                    $(idEndereco).val(dados.logradouro);
                    $(idBairro).val(dados.bairro);
                    $(idCidade).val(dados.localidade);
                    $(idEstado).val(dados.uf);
                    $(idLongitude).prop('readonly', true);
                    $(idLatitude).prop('readonly', true);
                    $(idEndereco).prop('disabled', true);
                    $(idBairro).prop('disabled', true);
                    $(idCidade).prop('disabled', true);
                    $(idEstado).prop('disabled', true);
                    if (idNumero != null) {
                        $(idNumero).focus();
                    }
                } else {
                    //CEP pesquisado não foi encontrado.
                    limpa_formulário_cep();
                    toastError()("CEP não encontrado.");
                }
            });
        } else {
            //cep é inválido.
            limpa_formulário_cep();
            toastError("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
}

function preecheFormularioRota() {

    var objEndInicial = getObjEnderecoInicial();
    var objEndFinal = getObjEnderecoFinal();

    var cepInicial = $(objEndInicial.cep).val().length;
    var cepFinal = $(objEndFinal.cep).val().length;


    if (cepInicial >= 8 && cepFinal >= 8) {
        // Preenchendo os campos do CEP Inicial
        getAddress(objEndInicial.cep, objEndInicial.endereco, objEndInicial.bairro, objEndInicial.cidade,
                objEndInicial.estado, objEndInicial.latitude, objEndInicial.longitude, null);

        // Preenchendo os campos do CEP Final
        getAddress(objEndFinal.cep, objEndFinal.endereco, objEndFinal.bairro, objEndFinal.cidade,
                objEndFinal.estado, objEndFinal.latitude, objEndFinal.longitude, null);
    }
}

function getAddressInicial() {

    var objEndInicial = getObjEnderecoInicial();
    var idCep = objEndInicial.cep;
    var idEndereco = objEndInicial.endereco;
    var idBairro = objEndInicial.bairro;
    var idCidade = objEndInicial.cidade;
    var idEstado = objEndInicial.estado;
    var idLatitude = objEndInicial.latitude;
    var idLongitude = objEndInicial.longitude;

    getAddress(idCep, idEndereco, idBairro, idCidade, idEstado, idLatitude, idLongitude, null);
}

function getAddressFinal() {

    var objEndFinal = getObjEnderecoFinal();
    var idCep = objEndFinal.cep;
    var idEndereco = objEndFinal.endereco;
    var idBairro = objEndFinal.bairro;
    var idCidade = objEndFinal.cidade;
    var idEstado = objEndFinal.estado;
    var idLatitude = objEndFinal.latitude;
    var idLongitude = objEndFinal.longitude;

    getAddress(idCep, idEndereco, idBairro, idCidade, idEstado, idLatitude, idLongitude, null);
}

function getObjEnderecoInicial() {
    var endereco = {};
    endereco.cep = "#txtCepInicialRota";
    endereco.endereco = "#txtEnderecoInicial";
    endereco.bairro = "#txtBairroInicial";
    endereco.cidade = "#txtCidadeInicial";
    endereco.estado = "#txtEstadoInicial";
    endereco.latitude = "#txtLatitudeInicialRota";
    endereco.longitude = "#txtLongitudeInicialRota";

    return endereco;
}

function getObjEnderecoFinal() {
    var endereco = {};
    endereco.cep = "#txtCepFinalRota";
    endereco.endereco = "#txtEnderecoFinal";
    endereco.bairro = "#txtBairroFinal";
    endereco.cidade = "#txtCidadeFinal";
    endereco.estado = "#txtEstadoFinal";
    endereco.latitude = "#txtLatitudeFinalRota";
    endereco.longitude = "#txtLongitudeFinalRota";

    return endereco;
}