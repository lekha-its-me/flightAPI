$(document).ready(function () {

    $("#findRoutes").click(function () {
        var from = $("#from option:selected").val();
        var to = $("#to option:selected").val();
        var date = $("#date").val();
        var data = {
            departureAirport: from,
            arrivalAirport: to,
            departureDate: date
        };
        $(".info_message").hide();
        $(".info_message").empty();

        $.ajax({
            type: "POST",
            url: '/search',
            data: "searchQuery=" + JSON.stringify(data),
            dataType: 'json',
            success: function(data) {
                $(".founded_data").hide();
                $("#result_body").empty();
                if(data.length > 0) {
                    for(item in data){
                        $("#result_body").append('<tr><td>' +
                            data[item].transporter.name + '</td><td>' +
                            data[item].flightNumber + '</td><td>' +
                            data[item].departureAirport + '</td><td>' +
                            data[item].arrivalAirport + '</td><td>' +
                            data[item].departureDateTime + '</td><td>' +
                            data[item].arrivalDateTime + '</td><td>' +
                            data[item].duration + '</td></tr>');
                    }
                    $(".founded_data").show();
                }
            },
            async: false,
            error: function(e) {
                $(".founded_data").hide();
                $("#result_body").empty();
                $(".info_message").append('<div class="alert alert-warning" role="alert">\n' +
                    e.responseText +
                    '</div>');
                $(".info_message").show();
            }
        });
    });
});
