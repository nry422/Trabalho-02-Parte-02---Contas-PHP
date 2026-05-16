<?php
header('Content-Type: application/json'); //informa que o tipo de conteudo é json, em pura js funcionou sem isso, com jquery requeriu isso! 

$dados = 'contas.json'; //arquivo json onde os dados ficam
$contas = json_decode(file_get_contents($dados), true) ?? []; //decodifica para formato que array q o php usa

$acao = $_POST['acao'] ?? $_GET['acao'] ?? ''; //pode usar get ou post para acao, ou vazio

if ($acao == 'listar') { //se acao for listar mostra os contas
    echo json_encode($contas); 
} else if ($acao == 'inserir') {  //se acao for inserir
    $cod = $_POST['cod']; //pega o codigo digitado
     $contas[$cod] = [ //codigo é a chave do objeto        
        "favorecido"   => $_POST['favorecido'],
        "valor"        => $_POST['valor'],
        "venc"         => $_POST['venc']
    ];
    file_put_contents($dados, json_encode($contas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo json_encode(["status" => "ok"]); //avisa o ajax que esta ok...

} else if ($acao == 'atualizar') { //se acao for atualizar
    $cod = $_POST['cod'];  //esse retorna e continua o mesmo
    $contas[$cod]['favorecido']     = $_POST['favorecido'];
    $contas[$cod]['valor']    = $_POST['valor'];                
    $contas[$cod]['venc'] = $_POST['venc'];
    file_put_contents($dados, json_encode($contas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo json_encode(["status" => "ok"]);

} else if ($acao == 'excluir') { //se for excluir
    $cod = $_POST['cod']; //recebe o codigo da contaque vai ser exclucodo
    unset($contas[$cod]); //remove conta
    file_put_contents($dados, json_encode($contas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo json_encode(["status" => "ok"]);
}