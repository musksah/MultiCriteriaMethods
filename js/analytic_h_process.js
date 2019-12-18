// IIFE - Immediately Invoked Function Expression
(function (yourcode) {

    // The global jQuery object is passed as a parameter
    yourcode(window.jQuery, window, document);

}(function ($, window, document) {

    // The $ is now locally scoped 

    // Listen for the jQuery ready event on the document
    $(function () {

        // $('#input_vars').on('change', function () {
        //     debugger
        //     let element = $(this)
        //     let col = element.data('col');
        //     let row = element.data('row');
        //     let prefijo = element.data('row');
        //     let value = parseFloat(element.val());
        //     let selector = '#'+prefijo+''+col+''+row;
        //     $(selector).val(1/value)
        // });

        $("#customized_criterion").on('change', function () {
            var table_alternatives = "";
            if (this.checked) {
                let alternatives = parseInt($("#num_criters1").val());
                table_alternatives = '<h4 class="text-center text-primary" style="text-decoration:underline; margin-bottom: 25px; margin-top: 20px;">Customize Criterions </h4>';
                for (let index = 0; index < alternatives; index++) {
                    let criterion = "criterion"+index;
                    table_alternatives = table_alternatives + '' +
                        '<div class="row">' +
                        '   <div class="col-md-4"></div> '+
                        '   <div class="col-md-4">' +
                        '       <input class="form-control" type="text" name="alternative[]" placeholder="Ingress Criterion´s name" required>' +
                        '   </div>' +
                        '   <div class="col-md-4" style="margin-bottom:5px;">'+
                        '       <div class="radio">'+
                        '           <label><input type="radio" name="'+criterion+'" checked>Cualitative</label>'+
                        '       </div>'+
                        '       <div class="radio">'+
                        '           <label><input type="radio" name="'+criterion+'">Cuantitative</label>'+
                        '       </div>'+
                        '   </div> '+
                        '</div>';
                }
            }
            $("#div-name-alternatives1").html(table_alternatives)
        });

        $("#customized_criterion2").on('change', function () {
            var table_alternatives2 = "";
            if (this.checked) {
                let alternatives = parseInt($("#num_criters2").val());
                table_alternatives2 = '<h4 class="text-center text-primary" style="text-decoration:underline; margin-bottom: 25px; margin-top: 20px;">Customize Criterions </h4>';
                for (let index = 0; index < alternatives; index++) {
                    let criterion = "criterion"+index;
                    table_alternatives2 = table_alternatives2 + '' +
                        '<div class="row">' +
                        '   <div class="col-md-4" style="margin-top: 10px">' +
                        '   </div>' +
                        '   <div class="col-md-4">' +
                        '    <input class="form-control" type="text" name="alternative2[]" placeholder="Ingress Criterion´s name" required>' +
                        '   </div>' +
                        '   <div class="col-md-4" style="margin-bottom:5px;">'+
                        '       <div class="radio">'+
                        '           <label><input type="radio" name="'+criterion+'" checked>Cualitative</label>'+
                        '       </div>'+
                        '       <div class="radio">'+
                        '           <label><input type="radio" name="'+criterion+'">Cuantitative</label>'+
                        '       </div>'+
                        '   </div> '+
                        '</div>';
                }
            }
            $("#div-name-alternatives2").html(table_alternatives2)
        });

        $("#form_pairwise_comp_matrix").submit(function (event) {
            // Esto le cambia el comportamiento
            event.preventDefault();
            $.ajax({
                method: "POST",
                url: "controllers/analytic_h_processController.php",
                data: $(this).serialize()
            }).done(function (data) {
                console.log(data);
                $("#card_pair_waise_main_matrix").html(data.table_main);
                let cadena_tables = "";
                $.each(data.table_criterion, function (index, value) {
                    cadena_tables = cadena_tables + value;
                });
                $("#pair_waise_all_matrix_criterions").html(cadena_tables);
            });
        });

    });

    function matrix_regreat(data) {
        let cadena = '<table class="table">';
        $.each(data, function (key, arr) {
            cadena += "<tr>";
            cadena += "<td>" + key + "</td>";
            $.each(arr, function (keyarr, value) {
                cadena += "<td>" + value + "</td>";
            });
            cadena += "</tr>";
        });
        // for (let i = 0; i < data.length; i++) {
        //     cadena += "<tr>";
        //     for (let j = 0; j < data[i].length; j++) {
        //         cadena+= "<td>"+data[i][j]+"</td>";
        //     }
        // }
        cadena += "</table>";
        console.log(cadena);
        $("#matrix_regreat").html(cadena);
    }
    // The rest of the code goes here!

}));