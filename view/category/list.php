<!DOCTYPE html>
    <head>
        <title> Aula PHP Avançado </title> 
        <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    </head>

    <body class='container'>
        <div class='row'>
            <div class='col-12'>
                <form action="../Category/list" method="GET">
                    <div class="card">
                        <div class="card-header">
                            <h1> Filtros </h1>
                        </div>
                    
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <span> Id </span>
                                        <input type="int" class="form-control" name="id"> </input>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <span> Nome </span>
                                        <input type="text" class="form-control" name="name"> </input>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit"> Filtrar </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class='col-12 mt-3'>
                <form action="" method="">
                    <div class="card">
                        <div class="card-header">
                            <h1> Resultados </h1>
                        </div>
                    
                        <div class="card-body">
                            <?php
                                if (count($listResults) == 0)
                                    echo "<div class='alert alert-danger'> Não temos resultados para sua pesquisa </div>";
                                else {
                                    echo '<table class="table table-striped">';

                                    foreach($listResults as $category) {
                                        echo "
                                            <tr>
                                                <td> {$category['id']} </td>
                                                <td> {$category['name']}</td>
                                                <td> {$category['description']}</td>
                                            </tr>
                                        ";
                                    }

                                    echo '<table>';
                                }
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    <script src="../public/js/jquery.min.js"></script>
    <script src="../public/js/bootstrap.min.js"></script>
</body>