<?php
header('Content-Type: application/json');
$data = $_POST;

$function = $_POST['funcion'];

unset($data['funcion']);
$function($data);

function getHeaders($data)
{
    foreach ($data['Alternative1'] as $keycol => $valuecol) {
        $headers[] = $keycol;
    }
    return $headers;
}

function encontrarMayores($data)
{
    $data_mayor = $data['data'];
    $datost = " ";
    $datostr = " ";

    $headers = getHeaders($data_mayor);

    $datostr .= "<br>";
    $datost = '
    <div class="table-responsive">
    <table class="table table-striped">';

    $datost .= '<thead h4 class="bg-secondary text-white"><tr>';
    $datost .= "<td><h4><center>Alternatives Decision</center></h3></td>";
    foreach ($headers as $key => $value) {
        $datost .= ' <th scope="col" class="text-center"><h4>' . $value . ' </h3></th>';
    }
    $datost .= ' <th scope="col" class="text-center"><h3>Maximum</h3></th>';
    $datost .= '</tr></thead><tbody>';

    foreach ($data_mayor as $key => $value) {
        $datost .= "<tr>";
        $datost .= "<td><h4><center>$key</center></h4></td>";
        foreach ($value as $keycol => $valuecol) {
            //echo" ";
            $datost .= "<td><h5><center>$valuecol</center></h5></td>";
           
        }
        $maximo = max($value);
        $maximos[$key] = $maximo;
        $datost .= "<td><h6><center>$maximo</center></h6></td>";
        $datost .= '</tr>';
    }

    $datost .= '
        </tbody>
       
    </table>                                                                                                                                                                                                                    
    </div>';
    $maximo_maximos = max($maximos);
    foreach ($maximos as $key => $value) {
        if($maximo_maximos == $value){
            $result_maximos[] = $key; 
        }
    }
    echo json_encode(['datost'=>$datost,'maximos'=>$result_maximos]);
}

function matrixRegreat($mayor_a, $mayor_b, $a, $b)
{
    $matrix_regreat = [];
    $cont = 0;
    foreach ($a as $key => $value) {
        $valueA = $mayor_a - $value;
        $valueB = $mayor_b - $b[$key];
        $matrix_regreat[$key][] = $valueA;
        $matrix_regreat[$key][] = $valueB;
        $cont++;
    }
    echo json_encode($matrix_regreat);
}

function PayOffMatrix($data)
{
    if (!empty($data['alternative'])) {
        $alternatives_name = $data['alternative'];
    }
    $rows = $data['num_alterns'];
    $colums = $data['num_uncerts'];
    $table_form = '
    <script>
    $("#form_payoff_data").submit(function (event) {
        event.preventDefault();
        $.ajax({
            method: "POST",
            url: "controllers/maximaxController.php",
            data: $(this).serialize()
        }).done(function (data) {
            console.log(data);
            $("#matrix_max").html(data.datost);
            let cadena = "";
            $.each(data.maximos, function (keyarr, value) {
                cadena += "<p>" + value + "</p>";
            });
            $("#maximo").html(cadena); 
        });
    });
    </script>
    
    <form action="controllers/maximaxcontroller.php" method="POST" id="form_payoff_data">
    <input type="hidden" name="funcion" value="encontrarMayores">
    <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col" class="text-center bg-secondary text-white"><h3>Alternatives Desicion</h3></th>';

    for ($j = 1; $j < $colums + 1; $j++) {
        $table_form .= '
            <th scope="col" class="bg-secondary text-white">
                <h3 class="text-center">Event' . $j . '</h3>
            </th>';
    }
    $table_form .= "</tr></thead><tbody>";


    for ($i = 1; $i < $rows + 1; $i++) {
        $table_form .= "
        <tr> 
            <td class='text-center'>";
        if (!empty($data['alternative'])) {
            $alternatives_name = $data['alternative'];
            $table_form .= "<h3>" . $alternatives_name[$i - 1] . "</h3></td>";
        } else {
            $table_form .= "<h3>Alternative" . $i . "</h3></td>";
        }
        for ($j = 1; $j < $colums + 1; $j++) {
            $table_form .= "
            <td>
                <div class='form-group'>
                    <input type='text' class='form-control' id='Alternative" . $i . "[U" . $j . "]' placeholder='Enter Number' name='data[Alternative" . $i . "][U" . $j . "]'>";
            if (!empty($data['alternative'])) {
                $table_form .= "<input type='hidden' class='form-control' id='name_alternative[Alternative" . $i . "]' name='name_alternative[Alternative" . $i . "]' value='" . $alternatives_name[$i - 1] . "'>";
            }
            $table_form .= "</div></td>";
        }
        $table_form .= "</tr>";
    }

    $table_form .= "
            </tbody>
        </table>
        </div>
        <div class='form-group'>
            <button type='submit' class='btn btn-primary' id='btn_submit_payoff'>Calculate</button>
        </div>
    </form>";
    echo json_encode($table_form);
}
    
