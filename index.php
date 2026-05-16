<!-- a parte do json fica dentro do index agora e retorna php não ajax/js AINDA ESTOU ADAPTANDO!!!!!!!!!!!!!!!!11! -->
    <?php    
$dados = 'contas.json'; //arquivo json onde os dados ficam
$contas = json_decode(file_get_contents($dados), true) ?? []; //decodifica para formato que array q o php usa

$acao = $_POST['acao'] ?? $_GET['acao'] ?? ''; //pode usar get ou post para acao, ou vazio

if ($acao == 'inserir') {  //se acao for inserir
    $adicionarId = empty($contas) ? 1 : max(array_keys($contas)) + 1; //se for vazio começa de 1, se tiver id adiciona mais 1
     $contas[$adicionarId] = [ //id é chave do objeto    
        "codigo"     => $_POST['codigo'],
        "favorecido"     => $_POST['favorecido'],
        "vencimento" => $_POST['vencimento'],
        "valor"    => $_POST['valor']
    ];
    file_put_contents($dados, json_encode($contas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    header("Location: index.php?status=sucesso");
    exit;

} else if ($acao == 'atualizar') { //se acao for atualizar
    $id = $_POST['id'];  //esse retorna e continua o mesmo
    $contas[$id]['codigo']     = $_POST['codigo'];
    $contas[$id]['favorecido']     = $_POST['favorecido'];
    $contas[$id]['vencimento'] = $_POST['vencimento'];
    $contas[$id]['valor']    = $_POST['valor'];                
    file_put_contents($dados, json_encode($contas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    header("Location: index.php?status=atualizado");
    exit;

} else if ($acao == 'remover') { 
    $id = $_GET['id']; //recebe o id do contato que vai ser excluido
    unset($contas[$id]); //remove contato
    file_put_contents($dados, json_encode($contas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    header("Location: index.php?status=removido");
    exit;
}
    
    
    ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>Contas a pagar</title>
</head>
<body>

<div class="container" style="max-width: 900px">
<h1 class="my-4"> Registro de contas a pagar</h1> 

<form method="post" action="index.php">
    <input type="hidden" name="acao" value="inserir" id="campo-acao">
    <input type="hidden" name="id" id="campo-id">           
        <!--form para inserir e atualizar a tabela-->
        <div class="card shadow-sm p-3 mb-4">                 
                    <div class="row g-2 align-items-end">
                    <div class="col-12 col-md">
                        <label for="codigo">Código:</label>
                        <input type="text" name="codigo" id="codigo" class="form-control" required autofocus>
                    </div> 
                    <div class="col-12 col-md">
                        <label for="favorecido">Favorecido:</label>
                        <input type="text" name="favorecido" id="favorecido" class="form-control" required>
                    </div>    
                    <div class="col-12 col-md">
                        <label for="vencimento">Vencimento:</label>
                        <input type="text" name="vencimento" id="vencimento" class="form-control" required>
                    </div>
                    <div class="col-12 col-md">
                        <label for="valor">Valor:</label>
                        <input type="text" name="valor" id="valor" class="form-control" required>
                    </div>
                    <div class="col-12 col-md-auto">
                        <button type="submit" class="btn btn-success">Salvar Conta</button>                                              
                    </div>                    
        </div>
        </div>
        </form>


<!-- Tabela que mostra contas, falta deixar bonitnha com bootstrap!!!!!!!!!!!!!!!!-->
    <div class="table-responsive">
        <table class="table mt-4" id="tabela-toda"> 
            <thead class="table-light">
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Favorecido</th>
                    <th scope="col">Vencimento</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Ações</th>                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contas as $id => $conta): ?>
        <tr>
            <td><?= $conta['codigo'] ?></td>
            <td><?= $conta['favorecido'] ?></td>
            <td><?= $conta['vencimento'] ?></td>
            <td><?= $conta['valor'] ?></td>
            <td>
                <a href="?acao=modificar&id=<?= $id ?>">Modificar</a>
                <a href="?acao=remover&id=<?= $id ?>" onclick="return confirm('Deseja remover?')">Remover</a>
            </td>
        </tr>
    <?php endforeach; ?>                       
            </tbody>
            <?php
            $total = array_sum(array_column($contas, 'valor'));
            ?>
            <tfoot>
                <tr>
                 <td colspan="3">Total devido:</td>
                <td><?= number_format($total, 2, ',', '.') ?></td>
                </tr>
            </tfoot>
        </table>
    </div>    





    
</body>
</html>

