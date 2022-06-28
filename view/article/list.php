<!DOCTYPE html>
    <head>
        <title> Aula PHP Avançado </title> 
        <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    </head>

    <body class='container'>
        <div class='row'>
            <div class='col-12'>
                <form action="../Article/list" method="GET">
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

                                    foreach($listResults as $article) {
                                        echo "
                                            <tr>
                                                <td> {$article['id']} </td>
                                                <td> {$article['name']}</td>
                                                <td> <img src='../upload/category/{$article['image']}'></img> </td>
                                                <td> <p class='btn btn-danger btnDelete' data-id='{$article['id']}'> Deletar </p> </td>
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
    <script src="../public/js/jquery-ui.min.js"></script>
    <script src="../public/js/bootstrap.min.js"></script>

    <script>

        $('.btnDelete').on('click', function() {
            var idArticle = $(this).data('id');
        
            var request = $.ajax({
                url: "../Article/delete",
                method: "POST",
                data: {
                    id: idArticle
                },
                dataType: "json"
            });

            request.done(function (data) {
                console.log(data);
                alert(data.message);
            });
            
            request.fail(function (data) {
                var response = $.parseJSON(data.responseText);
                alert(response.message);
            });
        });

    </script>
</body>