<?php
header('Content-Type: application/json');
$data = $_POST;

$function = $_POST['funcion'];
$probability = false;


unset($data['funcion']);
$function($data);

function emvExpectedValue($data)
{
    if (!empty($data['name_alternative'])) {
        $names = $data['name_alternative'];
    } else {
        $emvMatrix = calcEMV($data['data'], $data['probability']);
        $maximo_emv = max($emvMatrix['emv']);
        foreach ($emvMatrix['emv'] as $key => $value) {
            if ($maximo_emv == $value) {
                $solutions[] = $key;
            }
        }
        foreach ($solutions as $key => $value) {
            $solutions[] = $value;
            unset($solutions[$key]);
        }
        $table = tableEmv($emvMatrix['matrix']);
    }
    echo json_encode(['table' => $table,'solutions'=>$solutions]);
}

function calcEMV($data, $probability)
{
    foreach ($data as $key => $value) {
        $sum = 0;
        foreach ($value as $key_col => $value_col) {
            $result = (float) $value_col * $probability[$key_col];
            $sum = $sum + $result;
        }
        $emv[$key] = $sum;
        $data[$key]['EMV'] = $sum;
    }
    return ['emv' => $emv, 'matrix' => $data];
}

function getNamesAlternatives($name_alternatives, $data_graphic)
{
    $balanced = $data_graphic['balanced'];
    for ($i = 0; $i < count($balanced); $i++) {
        foreach ($name_alternatives as $key => $value) {
            $new_balanced[$i] = $name_alternatives[$balanced[$i]];
        }
    }
    $data_graphic['balanced'] = $new_balanced;
    return $data_graphic;
}

function tableEmv($data)
{
    $headers_col = getHeaders($data['Alternative1']);
    $table = "<table class='table table-striped'>";
    $table .= "<thead>";
    $table .= "<th class='bg-secondary text-white'><center><h3>Alternatives Desicion</h3></center></th>";
    foreach ($headers_col as $key => $value) {
        $table .= "<th class='bg-secondary text-white'> <h3> $value </h3> </th>";
    }
    $table .= "</thead>";
    foreach ($data as $key => $value) {
        $table .= "<tr>";
        $table .= "<td> $key </td>";
        foreach ($value as $key_col => $value_col) {
            $table .= "<td> $value_col </td>";
        }
        $table .= "</tr>";
    }
    $table .= "<table>";
    return $table;
}



function init0Array($data)
{
    $ceros = [];
    foreach ($data as $key => $value) {
        $ceros[$key] = 0;
    }
    return $ceros;
}


function getHeaders($data)
{
    foreach ($data as $key => $value) {
        $headers[] = $key;
    }
    return $headers;
}

function encontrarMayores($data)
{
    $mayores = [];
    $index = [];
    foreach ($data as $key => $value_index) {
        foreach ($value_index as $key => $value) {
            $index[$key] = $key;
        }
    }
    foreach ($index as $key => $value) {
        $mayores_arr[$key] = array_column($data, $value);
    }
    foreach ($mayores_arr as $key => $value) {
        $mayores[$key] = mayor($value);
    }

    foreach ($data as $key => $value) {
        foreach ($value as $key_col => $value_col) {
            $result[$key][] = $mayores[$key_col] - $value_col;
        }
    }
    $table = "<div class='table-responsive'><table class='table'>";
    foreach ($result as $key => $value) {
        $table .= "<tr>";
        foreach ($value as $key_col => $value_col) {
            $table .= "<td>" . $value_col . "</td>";
        }
        $table .= "</tr>";
    }
    $table .= "</table></div>";
    echo json_encode($table);
}

function generateMatrixRegreat($data, $names = false)
{
    $columns = getColumns($data['Alternative1']);

    foreach ($columns as $key => $value) {
        $array_col[$value] = array_column($data, $value);
    }

    foreach ($array_col as $key => $value) {
        $maximos[$key] = max($value);
    }

    foreach ($data as $key => $value) {
        foreach ($value as $keycol => $valuecol) {
            $data[$key][$keycol] = $maximos[$keycol] - $valuecol;
        }
    }

    foreach ($data as $key => $value) {
        $maximo_regreat[$key] = max($value);
        foreach ($value as $keycol => $valuecol) {
            $data[$key]['Maximum'] = $maximo_regreat[$key];
        }
    }
    $min = min($maximo_regreat);
    foreach ($maximo_regreat as $key => $value) {
        if ($min == $value) {
            $solutions[$key] = $key;
        }
    }
    if ($names !== false) {
        return generateTableMatrixRegreat($data, $solutions, $names);
    } else {
        return generateTableMatrixRegreat($data, $solutions);
    }
}

function getColumns($data)
{
    foreach ($data as $key => $value) {
        $columns[] = $key;
    }
    return $columns;
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
            url: "controllers/expectedvalueController.php",
            data: $(this).serialize()
        }).done(function (data) {
            console.log(data);
            $("#emv_desicion_matrix").html(data.table);
            let cadena = "";
            $.each(data.solutions, function (keyarr, value) {
               cadena += "<p>" + value + "</p><br>";
            });
            $("#alternatives_emv").html(cadena);
        });
    });
    </script>
    
    <form action="controllers/expectedvalueController.php" method="POST" id="form_payoff_data">
    <input type="hidden" name="funcion" value="emvExpectedValue">
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
    $table_form .= "<tr><td><center><h3>Probability</h3></center></td>";

    for ($j = 1; $j < $colums + 1; $j++) {
        $table_form .= '
        <td scope="col">
        <h3 class="text-center"><input type="text" name="probability[U' . $j . ']" id="probability' . $j . '" class="form-control"></h3>
        </td>';
    }
    $table_form .= "</tr>";
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
