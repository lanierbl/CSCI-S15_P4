$(document).ready(function($){

/*
    $.ajax({
        url: 'api/get_states',
        success: function(data) {
            var state = $('#state');
            state.empty();
            state.append('<option>Select State</option>');
            $.each(data, function(index, value) {
                state.append("<option value='"+ value +"'>" + value + "</option>");
            });
        }
    });

    $.ajax({
        url: 'api/get_styles',
        success: function(data) {
            var style = $('#style');
            style.empty();
            style.append('<option>Select Style</option>');
            $.each(data, function(index, value) {
                style.append("<option value='"+ value +"'>" + value + "</option>");
            });
        }
    });

    $('#state').change(function(){
        $.get('api/get_cities',
            { option: $(this).val() },
            function(data) {
                var city = $('#city');
                city.empty();
                city.append('<option>Select City</option>');
                $.each(data, function(index, value) {
                    city.append("<option value='"+ value +"'>" + value + "</option>");
                });
            });
    });
*/


    $("#submit").click(function() {
        //Set form variables to be sent via JSON

        var proceed = true;

        if (document.getElementById("state").value != "Select State") {
            if (document.getElementById("city").value == "Select City") {
                $('select[name=city]').css('border-color','red');
                proceed = false;
            }
        } else {
            $('select[name=state]').css('border-color','red');
            proceed = false;
        }

        if(proceed)
        {
            // JSON data sent to PHP form for processing
            var json_obj = JSON.parse( '{}' );

            json_obj['state'] = document.getElementById("state").value;
            json_obj['city'] = (document.getElementById("city").value);

            if (document.getElementById("style").value != "Select Style") {
                json_obj['style'] = (document.getElementById("style").value);
            }
            if (document.getElementById("num_bed").value != "") {
                json_obj['num_bed'] = (document.getElementById("num_bed").value);
            }
            if (document.getElementById("num_bath").value != "") {
                json_obj['num_bath'] = (document.getElementById("num_bath").value);
            }
            if (document.getElementById("num_halfbath").value != "") {
                json_obj['num_halfbath'] = (document.getElementById("num_halfbath").value);
            }
            if (document.getElementById("park_spaces").value != "") {
                json_obj['park_spaces'] = (document.getElementById("park_spaces").value);
            }
            if (document.getElementById("sqrfoot").value != "") {
                json_obj['sqrfoot'] = (document.getElementById("sqrfoot").value);
            }
            if (document.getElementById("lot_sqrfoot").value != "") {
                json_obj['lot_sqrfoot'] = (document.getElementById("lot_sqrfoot").value);
            }
            if (document.getElementById("garage") != null)
                if (document.getElementById("garage").checked) {
                    json_obj['garage'] = 'true';
                }
            if (document.getElementById("pool") != null)
                if (document.getElementById("pool").checked) {
                    json_obj['pool'] = 'true';
                }
            // Save search if desired
            if ($('#searchName').val() != "") {
                var search_obj = JSON.parse( '{}' );
                search_obj['searchName'] = $('#searchName').val();
                search_obj['searchString'] = json_obj;
                $.post('/search/save', search_obj);
            }

            $.post('/search/do', json_obj, function(response) {
                output = '<div class="success">'
                for (i = 0; i < response.results.length; i++) {
                    output += "<b>Address</b> " + "<a href=/home/detail/" + response.results[i].id + ">" +
                                                     response.results[i].addr_street + ", " +
                                                     response.results[i].addr_city + ", " +
                                                     response.results[i].addr_state + "  " +
                                                     response.results[i].addr_zip + "</a><br/>";
                    output += "<b>Bedrooms: </b>: " + response.results[i].num_bed + "<br/>";
                    output += "<b>Bathrooms: </b>: " + response.results[i].num_bath + "<br/>";
                    output += "<br/>";
                }
                output += '</div>';

                $("#result").hide().html(output).slideDown();

            }, 'json');
        }

    });

    //reset form when new options selected
    $("#state").change(function() {
        $('select[name=state]').css('border-color','');
    });

    $("#city").change(function() {
        $('select[name=city]').css('border-color','');
    });

});


