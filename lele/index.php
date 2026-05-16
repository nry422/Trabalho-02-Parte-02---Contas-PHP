<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <title>Contas a pagar - com AJAX e JSON</title>
</head>

<body>
    <div class="container mt-4" style="max-width: 1200px">
        <h1 class="my-4 text-center">Contas com AJAX</h1>        
        
        <div class="row">
            
            <!-- Formulário 4/12 -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm p-3">
                    <form>            
                        <div class="mb-3">
                            <label class="form-label" for="cod">Código:</label>
                            <input type="text" class="form-control" id="cod" name="cod" placeholder="Código" required autofocus>
                        </div>    
                        <div class="mb-3">
                            <label class="form-label" for="favorecido">Favorecido:</label>
                            <input type="text" class="form-control" id="favorecido" name="favorecido" placeholder="Favorecido" required>
                        </div>    
                        <div class="mb-3">
                            <label class="form-label" for="valor">Valor:</label>
                            <input type="text" class="form-control" id="valor" name="valor" placeholder="00.00" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="venc">Vencimento:</label>
                            <input type="date" class="form-control" id="venc" name="venc" required>
                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <button type="button" onclick="inserirConta()" class="btn btn-primary" id="botao-adicionar">Adicionar</button>
                            <button type="button" onclick="atualizarConta()" class="btn btn-primary d-none" id="botao-atualizar">Atualizar</button>                        
                            <button type="button" onclick="limparFormulario()" class="btn btn-secondary d-none" id="botao-limpar">Limpar</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- tabela 8/12 -->
            <div class="col-lg-8">
                <div class="table-responsive">
                    <table class="table table-hover" id="tabela-toda"> 
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Favorecido</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Vencimento</th>
                                <th scope="col">Ações</th>                    
                            </tr>
                        </thead>
                        <tbody id="tabelaContas">          
                        </tbody>
                    </table>
                </div>   
            </div> 
        </div> 
    </div> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
    <script src="ajax.js"></script>        
</body>
</html>