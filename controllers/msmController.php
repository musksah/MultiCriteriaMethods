<?php
header('Content-Type: application/json');
$data = $_POST;

$function = $_POST['funcion'];

unset($data['funcion']);
$function($data);

function multicriteria_scoring_model($data)
{ }

function PayOffMatrix($data)
{
    $rows = $data['criterians'];
    $colums = $data['alternatives'];
    $table_form = '
    <script>
    $("#form_multicriterion_msm").submit(function (event) {
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "controllers/sensitivityController.php",
            data: $(this).serialize()
        }).done(function (data) {
            console.log(data);
            var layout = {};
            Plotly.newPlot("myDiv", data, layout, { showSendToCloud: true });
        });
    });
    </script>
    
    <form action="controllers/maximaxcontroller.php" method="POST" id="form_multicriterion_msm">
    <input type="hidden" name="funcion" value="multicriteria_scoring_model">
    <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col" class="text-center"><h3>Criterion</h3></th>';

    for ($j = 1; $j < $colums + 1; $j++) {
        $table_form .= '
            <th scope="col">
                <h3 class="text-center">Alternativa' . $j . '</h3>
            </th>';
    }
    $table_form .= '<th scope="col"><h3 class="text-center"> Weights </h3></th>';
    $table_form .= "</thead><tbody>";


    for ($i = 1; $i < $rows + 1; $i++) {
        $table_form .= "
        <tr> 
            <td class='text-center'>
                <h3>Criterion" . $i . "</h3>
                </td>";
        for ($j = 1; $j < $colums + 1; $j++) {
            $table_form .= "
            <td>
                <div class='form-group'>
                    <input type='text' class='form-control' id='criterion" . $i . "[A" . $j . "]' placeholder='Enter Number' name='criterion" . $i . "[A" . $j . "]'>
                </div>
            </td>";
        }
        $table_form .= "<td>
        <div class='form-group'>
            <input type='text' class='form-control' id='weight" . $i . "' placeholder='enter weight' name='weight" . $i . "'>
        </div>
        </td>";
        $table_form .= "
        </tr>";
    }
    $table_form .= "</tr>";
    $table_form .= "</tbody>";

    $table_form .= '<tfoot> <tr><th scope="col" class="text-center"><h3>Score</h3></th>';
    for ($j = 1; $j < $colums + 1; $j++) {
        $table_form .= '
            <th scope="col">
                <input type="text" class="form-control" name="score'.$j.'" readonly>
            </th>';
    }
    $table_form .= "</tfoot>";
    
    $table_form .= "
        </table>
        </div>
        <div class='form-group text-center' style='margin-top:10px;'>
            <button type='submit' class='btn btn-primary' id='btn_submit_payoff'>Calcular Score</button>
            <button type='submit' class='btn btn-primary' id='btn_submit_payoff'>Tomar Desición</button>
        </div>
    </form>";
    echo json_encode($table_form);
}

function mayor($data)
{
    $mayor = 0;
    foreach ($data as $key => $value) {
        if ($mayor < $value) {
            $mayor = $value;
        }
    }
    return $mayor;
}

function minor($data)
{
    $menor = 0;
    foreach ($data as $key => $value) {
        if ($menor < $value) {
            $menor = $value;
        }
    }
    return $menor;
}
