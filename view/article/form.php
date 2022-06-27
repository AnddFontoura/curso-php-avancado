<!DOCTYPE html>
    <head>
        <title> Formulário de envio de arquivo </title> 
        <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    </head>

    <body class='container'>
        <div class='row'>
            <div class='col-12'>
                <form action="../Article/save" method="POST" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <h1> Criar Artigo </h1>
                        </div>
                    
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <span> Sub Categorias </span>
                                        <select name="subcategory_id" class="form-control">
                                            <?php
                                                if(isset($subCategories) && count($subCategories) > 0) {
                                                    foreach($subCategories as $subCategory) {
                                                        echo "<option value='{$subCategory['id']}'> {$subCategory['name']} </option>";
                                                    }
                                                } else {
                                                    echo "<div class='alert alert-danger'> Não existem sub categorias </div>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <span> Nome </span>
                                        <input type="text" class="form-control" name="name"> </input>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <span> Arquivo </span>
                                        <input type="file" class="form-control" name="path" multiple> </input>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit"> Incluir </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    <script src="../public/js/jquery.min.js"></script>
    <script src="../public/js/bootstrap.min.js"></script>
</body>