const botaoAtualizar = $("#botao-atualizar");

function listarcontas() {
    $.getJSON("api.php", { acao: "listar" }, function(contas) {   // $.get por $.getJSON para forçar o formato correto

        let linhas = "";
        for (let cod in contas) {
            let c = contas[cod];
            linhas += "<tr>";
            linhas += "<td>" + cod + "</td>";
            linhas += "<td>" + c.favorecido + "</td>";
            linhas += "<td>" + c.valor + "</td>";
            linhas += "<td>" + c.venc + "</td>";
            linhas += "<td>";
            linhas += "<button type='button' onclick='preencherFormulario(\"" + cod + "\", \"" + c.favorecido + "\", \"" + c.valor + "\", \"" + c.venc + "\")' class='btn btn-primary btn-sm me-1'>Editar</button> ";
            linhas += "<button type='button' onclick='excluirConta(\"" + cod + "\")' class='btn btn-danger btn-sm'>Excluir</button>";
            linhas += "</td>";
            linhas += "</tr>";
        }
        
        $("#tabelaContas").html(linhas); 
    });
}

$("form").on("keypress", function(e) { //para poder usar enter para tivar o botao adicionar se cod estiver vazio, ou para atualizar se cod escondcodo tiver valor
    if (e.key === "Enter") {
        if (!botaoAtualizar.hasClass("d-none")) {
            atualizarConta(); 
        } else {
            inserirConta();  
        }
    }
});

function inserirConta() {
    const cod = $("#cod").val(); // captura o cod digitado
    const favorecido = $("#favorecido").val();
    const valor = $("#valor").val();
    const venc = $("#venc").val();

    if (!cod || !favorecido || !valor || !venc) {
        alert("Preencha todos os campos!");
        return; // para a função se campos estiverem vazios
    }

    $.post("api.php", {
        acao: "inserir",
        cod: cod, // envia o cod para o PHP
        favorecido: favorecido,
        valor: valor,
        venc: venc
    }, function(resposta) {
        if (resposta.status == "ok") {
            alert("Conta salva!");
            limparFormulario();
            listarcontas();
        }
    });
}

function atualizarConta() {
    const cod = $("#cod").val();
    const favorecido = $("#favorecido").val();
    const valor = $("#valor").val();
    const venc = $("#venc").val();

    if (!favorecido || !valor || !venc) {
        alert("Preencha todos os campos!");
        return; // para a função se campos estiverem vazios
    }

    $.post("api.php", {
        acao: "atualizar",
        cod: cod,
        favorecido: favorecido,
        valor: valor,
        venc: venc
    }, function(resposta) {
        if (resposta.status == "ok") {
            alert("Conta atualizada!");
            limparFormulario();
            listarcontas();
        }
    });
}

function excluirConta(cod) {
    if(confirm("Tem certeza que deseja excluir esta conta?")) {
        $.post("api.php", {
            acao: "excluir",
            cod: cod
        }, function(resposta) {
            if (resposta.status == "ok") {
                alert("Conta excluída!");
                listarcontas();
            }
        });
    }
}

function preencherFormulario(cod, favorecido, valor, venc) {
    $("#cod").val(cod).prop("readonly", true); // bloqueia a edição do código na atualização
    $("#favorecido").val(favorecido);
    $("#valor").val(valor);
    $("#venc").val(venc);

    //para o botao aparecer e sumir com ele
    botaoAtualizar.removeClass('d-none');
    $("#botao-adicionar").addClass('d-none'); // esconde o botao adicionar quando esta editando para evitar duplicar
    verificarCampos();
}

function limparFormulario() {
    $("#cod").val("").prop("readonly", false); // desbloqueia o código
    $("#favorecido").val("");
    $("#valor").val("");
    $("#venc").val("");
    $("#cod").focus();

    botaoAtualizar.addClass('d-none');
    $("#botao-limpar").addClass('d-none');
    $("#botao-adicionar").removeClass('d-none'); //mostra adicionar
}

//verifica se você digitou algo e mostra o botao limpar
function verificarCampos() {
    if ($("#cod").val() || $("#favorecido").val() || $("#valor").val() || $("#venc").val()) {
        $("#botao-limpar").removeClass('d-none');
    } else {
        $("#botao-limpar").addClass('d-none');
    }
}

$("#cod, #favorecido, #valor, #venc").on("input", verificarCampos);

function limparBusca() {
    $("#busca").val("");
    $("#botao-limpar-busca").addClass('d-none');
    listarcontas();
}

listarcontas();