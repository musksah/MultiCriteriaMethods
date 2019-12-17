// IIFE - Immediately Invoked Function Expression
(function (yourcode) {

    // The global jQuery object is passed as a parameter
    yourcode(window.jQuery, window, document);

}(function ($, window, document) {

    // The $ is now locally scoped 

    // Listen for the jQuery ready event on the document
    $(function () {

        $("#customized_alternatives").on('change', function () {
            var table_alternatives = "";
            if (this.checked) {
                let alternatives = parseInt($("#num_alterns").val());
                table_alternatives = '<hr class="sidebar-divider my-0"> <h4 class="text-center text-primary" style="text-decoration:underline; margin-bottom: 25px; margin-top: 20px;">Customize Names</h4>';
                for (let index = 0; index < alternatives; index++) {
                    table_alternatives = table_alternatives + '' +
                        '<div class="row">' +
                        '   <div class="col-md-4" style="margin-top: 10px">' +
                        '       <label for="num_alterns" class="float-right"> Alternative Name:</label>' +
                        '   </div>' +
                        '   <div class="col-md-8">' +
                        '    <input class="form-control" type="text" name="alternative[]" placeholder="Enter the text" required>' +
                        '   </div>' +
                        '</div>';
                }
            }
            $("#div-name-alternatives").html(table_alternatives)
        });

        $("#form_matrix_generator").submit(function (event) {
            // Esto le cambia el comportamiento
            event.preventDefault();
            $.ajax({
                method: "POST",
                url: "controllers/expectRegreatController.php",
                data: $(this).serialize()
            }).done(function (data) {
                console.log(data);
                $("#card-body-payoff-matrix").html(data);
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