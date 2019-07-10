<?php
    require_once('conexao.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="node_modules/tabulator-tables/dist/css/tabulator.min.css" rel="stylesheet">
    <link href="node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="http://oss.sheetjs.com/js-xlsx/xlsx.full.min.js"></script>
        <script type="text/javascript" src="node_modules/tabulator-tables/dist/js/tabulator.min.js"></script>
        <script type="text/javascript" src="node_modules/moment/min/moment.min.js"></script>
        <script type="text/javascript" src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
        <script type="text/javascript" src="node_modules/apexcharts/dist/apexcharts.min.js"></script>
        <script src=""></script>
    <title>Document</title>
</head>
<body>
    <div id="chart"></div>
   
    <script type="text/javascript">
            var options = {
            chart: {
                type: 'bar'
            },
            series: [{
                
                name: 'MAtriculas',
                
                data:[
                <?php
                $sql = 'SELECT *
                    FROM rascunho_cm WHERE datanova != " "
                    ORDER BY matricula_id LIMIT 50';
                $data = $conn->query($sql);
                $data->setFetchMode(PDO::FETCH_ASSOC);
                
                while ($r = $data->fetch()): ?>

                <?php echo $r['matricula_id']; ?>,
            
                <?php endwhile; ?>]
            }],
            xaxis: {
                
                categories: [
                <?php
                $sql = 'SELECT *
                    FROM rascunho_cm WHERE datanova != " "
                    ORDER BY matricula_id LIMIT 50';
                $data = $conn->query($sql);
                $data->setFetchMode(PDO::FETCH_ASSOC);
                
                while ($r = $data->fetch()): ?>

                <?php echo $r['datanova']; ?>,
                
                <?php endwhile; ?>]
                
            }
        }

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>
</body>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</html>