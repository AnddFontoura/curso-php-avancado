
        <div class='row'>
            <div class='col-12'>
                <form action="../Category/save" method="POST" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <h1> Criar Categoria </h1>
                        </div>
                    
                        <div class="card-body">
                                <div class="col-6">
                                    <div class="form-group">
                                        <span> Categoria </span>
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
                                        <input type="file" class="form-control" name="image"> </input>
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
