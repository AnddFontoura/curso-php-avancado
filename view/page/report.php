<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

    var data = google.visualization.arrayToDataTable([
        ['Data de Criação', 'Quantidade de Páginas' ],
        <?php
            if(isset($results) && count($results) > 0) {
                $var = "";
                foreach($results as $result) {
                    $var .= "['{$result->date}', {$result->count_id}], \n";
                }

                echo $var;
            }
        ?>
    ]);

    var options = {
        title: 'Relatório de criação de páginas',
        colors: ['#e0440e', '#e6693e', '#ec8f6e', '#f3b49f', '#f6c7b6'],
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
    }
</script>

<div id="piechart" style="width: 900px; height: 500px;"></div>