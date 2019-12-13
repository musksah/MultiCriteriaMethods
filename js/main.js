// IIFE - Immediately Invoked Function Expression
(function (yourcode) {

    // The global jQuery object is passed as a parameter
    yourcode(window.jQuery, window, document);

}(function ($, window, document) {

    // The $ is now locally scoped 

    // Listen for the jQuery ready event on the document
    $(function () {
        // The DOM is ready!
        // $("#form_payoff_data").submit(function (event) {
        //     event.preventDefault();
        //     debugger
        //     $.ajax({
        //         method: "POST",
        //         url: "controllers/maximaxcontroller.php",
        //         data: $(this).serialize()
        //     }).done(function (data) {
        //         console.log(data);
        //         $("#matrix_regreat").html(data);
        //     });
        // });

        $("#btn_submit_payoff").on('click', function(){
            alert("hola");
        });

        $("#form_matrix_generator").submit(function (event) {
            // Esto le cambia el comportamiento
            event.preventDefault();
            $.ajax({
                method: "POST",
                url: "controllers/maximaxcontroller.php",
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