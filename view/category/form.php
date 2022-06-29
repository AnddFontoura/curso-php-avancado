

        <div class='row'>
            <div class='col-12'>
                <form action="../Category/save" method="POST" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <h1> Criar Categoria </h1>
                        </div>
                    
                        <div class="card-body">
                            <div class="row">
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
