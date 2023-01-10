<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="container">
    <h5><i class="fa fa-user-plus"></i> Novo Usuário</h5>
    <hr>
    <form method="post">
        input hidden id_cliente e value casa existam
        <div class="row">
            <div class="col-md-4 col-12">
                <div class="mb-2">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome">
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="mb-2">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
            </div>
            <div class="col-md-4 col-12">
                <div class="mb-2">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-6">
                <div class="mb-2">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="cep" aria-describedby="cepHint" name="cep">
                    <div id="cepHint" class="form-text">Ex.: 00000-000</div>
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="mb-2">
                    <label for="logradouro" class="form-label">Logradouro</label>
                    <input type="logradouro" class="form-control" id="logradouro" name="logradouro">
                </div>
            </div>
            <div class="col-md-2 col-6">
                <div class="mb-2">
                    <label for="numero" class="form-label">Número</label>
                    <input type="numero" class="form-control" id="numero" name="numero">
                </div>
            </div>
            <div class="col-md-4 col-6">
                <div class="mb-2">
                    <label for="complemento" class="form-label">Complemento</label>
                    <input type="complemento" class="form-control" id="complemento" name="complemento">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="mb-2">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="bairro" class="form-control" id="bairro" name="bairro">
                </div>
            </div>
            <div class="col-4">
                <div class="mb-2">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="cidade" class="form-control" id="cidade" name="cidade">
                </div>
            </div>
            <div class="col-4">
                <div class="mb-2">
                    <label for="uf" class="form-label">Estado</label>
                    <input type="uf" class="form-control" id="uf" name="uf">
                </div>
            </div>
        </div>
        <div class="mt-2">
            <button type="submit" class="btn btn-success">Cadastrar Usuário</button>
        </div>
    </form>
</div>
<hr>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h5><i class="fa fa-users"></i> Usuários</h5>
            <hr>
            <?php $counter1=-1;  if( isset($clients) && ( is_array($clients) || $clients instanceof Traversable ) && sizeof($clients) ) foreach( $clients as $key1 => $value1 ){ $counter1++; ?>

                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo htmlspecialchars( $value1["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h6>
                    <p class="card-text">
                        Telefone: <?php echo htmlspecialchars( $value1["telefone"], ENT_COMPAT, 'UTF-8', FALSE ); ?><br>
                        Endereço: <?php echo htmlspecialchars( $value1["logradouro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $value1["numero"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $value1["complemento"], ENT_COMPAT, 'UTF-8', FALSE ); ?>. <?php echo htmlspecialchars( $value1["bairro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>, <?php echo htmlspecialchars( $value1["cidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $value1["uf"], ENT_COMPAT, 'UTF-8', FALSE ); ?><br>
                        Login: <?php echo htmlspecialchars( $value1["login"], ENT_COMPAT, 'UTF-8', FALSE ); ?><br>
                    </p>

                    <a href="/<?php echo htmlspecialchars( $value1["id_cliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-outline-info">Editar</a>
                    <a href="/delete/<?php echo htmlspecialchars( $value1["id_cliente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-outline-danger">Excluir</a>
                    </div>
                </div>
                <br>
            <?php } ?>

        </div>
    </div>
</div>