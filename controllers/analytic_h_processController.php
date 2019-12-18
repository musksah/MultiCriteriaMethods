<?php
header('Content-Type: application/json');
$data = $_POST;

$function = $_POST['funcion'];
$probability = false;


unset($data['funcion']);
$function($data);

function sensitivityAnalisis($data)
{
    $data_matrix = $data['data'];
    if (!empty($data['name_alternative'])) {
        $names = $data['name_alternative'];
        $data_graphic = dataGraphic($data_matrix, $names);
        $data_graphic = getNamesAlternatives($names, $data_graphic);
    } else {
        $data_graphic = dataGraphic($data_matrix);
    }
    // print_r($data_graphic);
    // die;
    echo json_encode($data_graphic);
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
    return $emv;
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
    $headers_col = getHeaders($data['A1']);
    $table = "<table class='table'>";

    $table .= "<tr>";
    $table .= "<td> Alternatives Desicion </td>";
    foreach ($headers_col as $key => $value) {
        $table .= "<td> <h3> $value </h3> </td>";
    }
    $table .= "</tr>";
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

function dataGraphic($data, $names = false)
{
    $headers_col = getHeaders($data['Alternative1']);
    unset($headers_col['EMV']);
    $prob = [];
    $probalities = [];
    for ($i = 0; $i < 11; $i++) {
        $pro = array();
        $prob1 = $i / 10;
        $probalities[] = $i / 10;
        $pro[] = $prob1;
        $pro[] = 1 - $prob1;
        foreach ($headers_col as $key_col => $value_col) {
            $prob[$value_col] = $pro[$key_col];
        }
        $emv_arr[] = calcEMV($data, $prob);
    }
    $arr_balanced = getAlternativeOver0($emv_arr);
    $cont = 0;
    foreach ($data as $key => $value) {
        $plot[$cont]['y'] = array_column($emv_arr, $key);
        $plot[$cont]['x'] = $probalities;
        $plot[$cont]['mode'] = "lines+markers";
        if ($names !== false) {
            $plot[$cont]['name'] = $names[$key];
        } else {
            $plot[$cont]['name'] = $key;
        }
        $cont++;
    }

    return ['plot' => $plot, 'balanced' => $arr_balanced['balanced_alternatives']];
}

function init0Array($data)
{
    $ceros = [];
    foreach ($data as $key => $value) {
        $ceros[$key] = 0;
    }
    return $ceros;
}
function getAlternativeOver0($data)
{
    $positive_arr = init0Array($data[0]);
    $negative_arr = init0Array($data[0]);
    foreach ($data as $key => $value) {
        foreach ($value as $key_col => $value_col) {
            if ($value_col > 0) {
                $positive_arr[$key_col] = $positive_arr[$key_col] + 1;
            }
            if ($value_col < 0) {
                $negative_arr[$key_col] = $negative_arr[$key_col] + 1;
            }
        }
    }
    $mayor_positive = max($positive_arr);
    foreach ($positive_arr as $key => $value) {
        if ($value == $mayor_positive) {
            $balanced_alternatives[] = $key;
        }
    }
    return ['positive' => $mayor_positive, 'negative' => $negative_arr, 'balanced_alternatives' => $balanced_alternatives];
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

function generateMatrixVarCriterions($data){
    // print_r($data);
    // die;
    $var1 = $data['explain_var'];
    $var2 = $data['explain_var2'];
    $variable1_criters = $data['num_criters1'];
    $variable2_criters = $data['num_criters2'];
    $variable1_alternative1 = $data['alternative'];
    $variable1_alternative2 = $data['alternative2'];
    //print_r($variable1_alternative);
    //die;
    for ($w = 0; $w < $variable1_criters ; $w++) { 
        $table_pair_w_criterions = "
        <div class='col-md-12'>
            <div class='card mb-4'>
                <div class='card-header'>
                    <h6 class='m-0 font-weight-bold text-primary'>Ponderación de Variables de ". $var1."</h6>
                </div>
                <div class='card-body'>
                    <div class='table-responsive'>
                    <table class='table table-striped'>
                        <thead class='bg-warning' style='color:white;'>
                            <th></th>";
                            for ($i=0; $i < $variable1_criters ; $i++) { 
                                $table_pair_w_criterions .= "
                                <th><center>".$variable1_alternative1[$i]."</center></th>";
                            }
                    $table_pair_w_criterions .="
                            <th><center>Vector Propio</center></th>
                        </thead>
                        <tbody>";  
                            for ($i = 0; $i < $variable1_criters ; $i++) { 
                            $table_pair_w_criterions .= "
                            <tr>
                                <td>".$variable1_alternative1[$i]."</td>";
                            for ($j = 0; $j < $variable1_criters; $j++) { 
                                if($i == $j){
                                    $table_pair_w_criterions .= "
                                <td><input type='number' class='form-control input_vars' name='cell_1_".$i.$j."' id='cell_1_".$i.$j."' value='1' data-row='$i' data-col='$j' data-prefijo='cell_1_' readonly></td>";
                                }elseif($j>$i){
                                    $table_pair_w_criterions .= "
                                <td><input type='number' class='form-control input_vars' name='cell_1_".$i.$j."' id='cell_1_".$i.$j."' data-row='$i' data-col='$j' data-prefijo='cell_1_'></td>";
                                }else{
                                    $table_pair_w_criterions .= "
                                <td><input type='number' class='form-control input_vars' name='cell_1_".$i.$j."' id='cell_1_".$i.$j."' data-row='$i' data-col='$j' data-prefijo='cell_1_' readonly></td>";
                                }
                            }
                            $table_pair_w_criterions .= "
                                <td><input type='number' class='form-control input_vars' name='cellvp_1_".$i."' id='cellvp_1_".$i."' data-row='$i' readonly><td>
                            </tr>";
                            }     
                    $table_pair_w_criterions .= "            
                        </tbody>
                    </table>
                    </div>
                </div>   
            </div>
        </div>
        <script>
        $('.input_vars').on('change', function () {
            let element = $(this)
            let col = element.data('col');
            let row = element.data('row');
            let prefijo = element.data('prefijo');
            let value = parseFloat(element.val());
            let selector = '#'+prefijo+''+col+''+row;
            $(selector).val(1/value)
        });
        </script>";
    }
    $tables[]=$table_pair_w_criterions;



    for ($w = 0; $w < $variable2_criters ; $w++) { 
        $table_pair_w_criterions = "
        <div class='col-md-12'>
            <div class='card mb-4'>
                <div class='card-header'>
                    <h6 class='m-0 font-weight-bold text-primary'>Ponderación de Variables de ". $var1."</h6>
                </div>
                <div class='card-body'>
                    <div class='table-responsive'>
                    <table class='table table-striped'>
                        <thead class='bg-warning' style='color:white;'>
                            <th></th>";
                            for ($i=0; $i < $variable2_criters ; $i++) { 
                                $table_pair_w_criterions .= "
                                <th><center>".$variable1_alternative2[$i]."</center></th>";
                            }
                    $table_pair_w_criterions .="
                            <th><center>Vector Propio</center></th>
                        </thead>
                        <tbody>";  
                            for ($i = 0; $i < $variable2_criters ; $i++) { 
                            $table_pair_w_criterions .= "
                            <tr>
                                <td>".$variable1_alternative2[$i]."</td>";
                            for ($j = 0; $j < $variable2_criters; $j++) { 
                                if($i == $j){
                                    $table_pair_w_criterions .= "
                                <td><input type='number' class='form-control input_vars' name='cell_2_".$i.$j."' id='cell_2_".$i.$j."' value='1' data-row='$i' data-col='$j' data-prefijo='cell_2_' readonly></td>";
                                }elseif($j>$i){
                                    $table_pair_w_criterions .= "
                                <td><input type='number' class='form-control input_vars' name='cell_2_".$i.$j."' id='cell_2_".$i.$j."' data-row='$i' data-col='$j' data-prefijo='cell_2_'></td>";
                                }else{
                                    $table_pair_w_criterions .= "
                                <td><input type='number' class='form-control input_vars' name='cell_2_".$i.$j."' id='cell_2_".$i.$j."' data-row='$i' data-col='$j' data-prefijo='cell_2_' readonly></td>";
                                }
                            }
                            $table_pair_w_criterions .= "
                                <td><input type='number' class='form-control input_vars' name='cellvp_2_".$i."' id='cellvp_".$i."' data-row='$i' readonly><td>
                            </tr>";
                            }     
                    $table_pair_w_criterions .= "            
                        </tbody>
                    </table>
                    </div>
                </div>   
            </div>
        </div>";
    }
    $tables[]=$table_pair_w_criterions;
    // print_r($tables);
    // die;
    return $tables;
}

function pairwiseComparisonMatrix($data)
{
    $explain_var = $data['explain_var'];
    $explain_var2 = $data['explain_var2'];
    $table_pair_w_main ='
    <script>
    $("#v1xv2").on("change", function() {
        var table_alternatives = "";
        let valVar1 = $("#v1xv2").val();
        let invvalVar1 = 1/valVar1; 
        $("#v2xv1").val(invvalVar1)
        let c_0_0 = parseFloat($("#v1xv1").val())
        let c_0_1 = parseFloat($("#v1xv2").val())
        let c_1_0 = parseFloat($("#v2xv1").val())
        let c_1_1 = parseFloat($("#v2xv2").val())
        let sumc1 = (c_0_0 + c_1_0);
        let sumc2 = (c_0_1 + c_1_1);
        let nC_0_0 = c_0_0/sumc1;
        let nC_0_1 = c_0_1/sumc2;
        let nC_1_0 = c_1_0/sumc1;
        let nC_1_1 = c_1_1/sumc2;
        f1Prom = (nC_0_0+nC_0_1)/2
        f2Prom = (nC_1_0+nC_1_1)/2
        $("#v1vp").val(f1Prom)
        $("#v2vp").val(f2Prom)
    });
    </script>';
    $table_pair_w_main .= "
    <div class='table-responsive'>
    <table class='table table-striped'>
        <thead class='bg-primary' style='color:white;'>
            <th></th>
            <th><center>$explain_var</center></th>
            <th><center>$explain_var2</center></th>
            <th><center>Vector Propio</center></th>
        </thead>
        <tbody>
            <tr>
                <td>$explain_var</td>
                <td><input name='v1xv1' id='v1xv1' type='number' min='1' max='9' class='form-control' value='1' readonly></td>
                <td><input name='v1xv2' id='v1xv2' type='number' min='1' max='9' class='form-control'></td>
                <td><input name='v1vp' id='v1vp' type='number' class='form-control' readonly></td>
            </tr>
            <tr>
                <td>$explain_var2</td>
                <td><input name='v2xv1' id='v2xv1' type='number' min='1' max='9' class='form-control' readonly></td>
                <td><input name='v2xv2' id='v2xv2' type='number' min='1' max='9' class='form-control' value='1' readonly></td>
                <td><input name='v2vp' id='v2vp' type='number' class='form-control' readonly></td>
            </tr>
        </tbody>
    </table>
    </div>";

    $table_critetions = generateMatrixVarCriterions($data);

    echo json_encode([
        'table_main'=>$table_pair_w_main,
        'table_criterion'=>$table_critetions
    ]);
    // if (!empty($data['alternative'])) {
    //     $alternatives_name = $data['alternative'];
    // }
    // $rows = $data['num_alterns'];
    // $criterions = $data['num_criters'];

    // $table_form = '
    // <script>
    // $("#form_payoff_data").submit(function (event) {
    //     event.preventDefault();
    //     $.ajax({
    //         method: "POST",
    //         url: "controllers/sensitivityController.php",
    //         data: $(this).serialize()
    //     }).done(function (data) {
    //         console.log(data);
    //         var layout = {};
    //         Plotly.newPlot("myDiv", data.plot, layout, { showSendToCloud: true });
    //         let texthtml = "";
    //         $.each( data.balanced, function( key, value ) {
    //             texthtml = texthtml + "<p>"+ value +"</p>";
    //         });
    //         $("#balanced_analisys").html(texthtml)
    //     });
    // });
    // </script>
    
    // <form action="controllers/maximaxcontroller.php" method="POST" id="form_payoff_data">
    // <input type="hidden" name="funcion" value="sensitivityAnalisis">
    // <div class="table-responsive">
    // <table class="table table-striped">
    //   <thead class="bg-secondary text-white">
    //     <tr>
    //       <th scope="col" class="text-center"><h4>Alternatives Desicion</h4></th>';

    // for ($j = 1; $j < $colums + 1; $j++) {
    //     $table_form .= '
    //         <th scope="col">
    //             <h4 class="text-center">Event' . $j . '</h4>
    //         </th>';
    // }
    // $table_form .= "</thead><tbody>";


    // for ($i = 1; $i < $rows + 1; $i++) {
    //     $table_form .= "
    //     <tr> 
    //         <td class='text-center'>";
    //     if (!empty($data['alternative'])) {
    //         $alternatives_name = $data['alternative'];
    //         $table_form .= "<h3>" . $alternatives_name[$i - 1] . "</h3></td>";
    //     } else {
    //         $table_form .= "<h4>Alternative" . $i . "</h4></td>";
    //     }
    //     for ($j = 1; $j < $colums + 1; $j++) {
    //         $table_form .= "
    //         <td>
    //             <div class='form-group'>
    //                 <input type='text' class='form-control' id='Alternative" . $i . "[U" . $j . "]' placeholder='Enter Number' name='data[Alternative" . $i . "][U" . $j . "]'>";
    //         if (!empty($data['alternative'])) {
    //             $table_form .= "<input type='hidden' class='form-control' id='name_alternative[Alternative" . $i . "]' name='name_alternative[Alternative" . $i . "]' value='" . $alternatives_name[$i - 1] . "'>";
    //         }
    //         $table_form .= "</div></td>";
    //     }
    //     $table_form .= "</tr>";
    // }

    // $table_form .= "
    //         </tbody>
    //     </table>
    //     </div>
    //     <div class='form-group'>
    //         <button type='submit' class='btn btn-primary' id='btn_submit_payoff'>Calculate</button>
    //     </div>
    // </form>";
}
