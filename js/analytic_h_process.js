// IIFE - Immediately Invoked Function Expression
(function (yourcode) {

    // The global jQuery object is passed as a parameter
    yourcode(window.jQuery, window, document);

}(function ($, window, document) {

    // The $ is now locally scoped 

    // Listen for the jQuery ready event on the document
    $(function () {

        $("#customized_criterion").on('change', function() {
            var table_alternatives = "";
            if(this.checked) {
                let alternatives = parseInt($("#num_criters1").val());
                table_alternatives = '<h4 class="text-center text-primary" style="text-decoration:underline; margin-bottom: 25px; margin-top: 20px;">Customize Alternatives </h4>';
                for (let index = 0; index < alternatives; index++) {
                    table_alternatives = table_alternatives+ ''+ 
                    '<div class="row">'+
                    '   <div class="col-md-4" style="margin-top: 10px">'+
                    '       <label for="num_alterns" class="float-right">Name of the Criterion:</label>'+
                    '   </div>'+
                    '   <div class="col-md-8">'+
                    '    <input class="form-control" type="text" name="alternative[]" placeholder="Enter text" required>'+
                    '   </div>'+
                    '</div>';
                }
            }
            $("#div-name-alternatives1").html(table_alternatives)
        });

        $("#customized_criterion2").on('change', function() {
            var table_alternatives2 = "";
            if(this.checked) {
                let alternatives = parseInt($("#num_criters2").val());
                table_alternatives2 = '<h4 class="text-center text-primary" style="text-decoration:underline; margin-bottom: 25px; margin-top: 20px;">Customize Alternatives </h4>';
                for (let index = 0; index < alternatives; index++) {
                    table_alternatives2 = table_alternatives2+ ''+ 
                    '<div class="row">'+
                    '   <div class="col-md-4" style="margin-top: 10px">'+
                    '       <label for="num_alterns" class="float-right">Name of the Criterion:</label>'+
                    '   </div>'+
                    '   <div class="col-md-8">'+
                    '    <input class="form-control" type="text" name="alternative2[]" placeholder="Enter text" required>'+
                    '   </div>'+
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
                $("#card_pair_waise_main_matrix").html(data);
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