$(document).ready(function($){

    $("#search_submit").click(function() {
        //Set form variables to be sent via JSON

        var proceed = true;

        if (document.getElementById("src_state").value != "Select State") {
            if (document.getElementById("src_city").value == "Select City") {
                $('select[name=src_city]').css('border-color','red');
                proceed = false;
            }
        } else {
            $('select[name=src_state]').css('border-color','red');
            proceed = false;
        }

        if(proceed)
        {
            // JSON data sent to PHP form for processing
            var json_obj = JSON.parse( '{}' );

            json_obj['state'] = document.getElementById("src_state").value;
            json_obj['city'] = document.getElementById("src_city").value;

            if (document.getElementById("src_guest").value == 'false') {
                if (document.getElementById("src_style").value != "Select Style") {
                    json_obj['style'] = (document.getElementById("src_style").value);
                }
                if (document.getElementById("src_num_bed").value != "") {
                    json_obj['num_bed'] = (document.getElementById("src_num_bed").value);
                }
                if (document.getElementById("src_num_bath").value != "") {
                    json_obj['num_bath'] = (document.getElementById("src_num_bath").value);
                }
                if (document.getElementById("src_num_halfbath").value != "") {
                    json_obj['num_halfbath'] = (document.getElementById("src_num_halfbath").value);
                }
                if (document.getElementById("src_park_spaces").value != "") {
                    json_obj['park_spaces'] = (document.getElementById("src_park_spaces").value);
                }
                if (document.getElementById("src_sqrfoot").value != "") {
                    json_obj['sqrfoot'] = (document.getElementById("src_sqrfoot").value);
                }
                if (document.getElementById("src_lot_sqrfoot").value != "") {
                    json_obj['lot_sqrfoot'] = (document.getElementById("src_lot_sqrfoot").value);
                }
                if (document.getElementById("src_garage") != null)
                    if (document.getElementById("src_garage").checked) {
                        json_obj['garage'] = 'true';
                    }
                if (document.getElementById("src_pool") != null)
                    if (document.getElementById("src_pool").checked) {
                        json_obj['pool'] = 'true';
                    }
                // Save search if desired
                if ($('#src_searchName').val() != "") {
                    var search_obj = JSON.parse( '{}' );
                    search_obj['searchName'] = $('#src_searchName').val();
                    search_obj['searchString'] = json_obj;
                    $.post('/search/save', search_obj);
                }
            }

            $.post('/search/do', json_obj, function(response) {
                output = '<div class="success">'
                for (i = 0; i < response.results.length; i++) {
                    output += "<b>Address</b> " + "<a data-toggle=\"modal\" data-id=\"" + response.results[i].id + "\" class=\"open-homeModal\" href=\"#homeModal\">" +
                        response.results[i].addr_street + ", " +
                        response.results[i].addr_city + ", " +
                        response.results[i].addr_state + "</a><br/>";
                    output += "<b>Bedrooms: </b>" + response.results[i].num_bed + "     ";
                    output += "<b>Bathrooms: </b>" + response.results[i].num_bath + "<br>";
                    output += "<br/>";
                }
                output += '</div>';

                $("#result").hide().html(output).slideDown();

            }, 'json');
        }

    });

    $("#list_submit").click(function() {

        var proceed = true;

        if (document.getElementById("list_state").value == "Select State") {
            $('select[name=list_state]').css('border-color','red');
            proceed = false;
        }

        if (document.getElementById("list_state").value != "Select State") {
            if (document.getElementById("list_city").value == "Select City") {
                $('select[name=list_city]').css('border-color','red');
                proceed = false;
            }
        } else {
            $('select[name=list_state]').css('border-color','red');
            proceed = false;
        }

        if (document.getElementById("list_city").value == "Select City") {
            $('select[name=list_city]').css('border-color','red');
            proceed = false;
        }

        if (document.getElementById("list_status").value == "Select Status") {
            $('select[name=list_status]').css('border-color','red');
            proceed = false;
        }

        //Set form variables to be sent via JSON
        var addr_street     = document.getElementById("list_street").value;
        var addr_city       = document.getElementById("list_city").value;
        var addr_state      = document.getElementById("list_state").value;
        var style           = document.getElementById("list_style").value;
        var desc            = document.getElementById("list_desc").value;
        var num_bed         = document.getElementById("list_num_bed").value;
        var num_bath        = document.getElementById("list_num_bath").value;
        var num_halfbath    = document.getElementById("list_num_halfbath").value;
        var sqrfoot         = document.getElementById("list_sqrfoot").value;
        var lot_sqrfoot     = document.getElementById("list_lot_sqrfoot").value;
        var park_spaces     = document.getElementById("list_park_spaces").value;
        var garage          = document.getElementById("list_garage").checked ? 1 : 0;
        var pool            = document.getElementById("list_pool").checked ? 1 : 0;
        var pic             = document.getElementById("list_pic").value;
        var status          = document.getElementById("list_status").value;
        var price           = document.getElementById("list_price").value;

        if (proceed)
        {
            // JSON data sent to PHP form for processing
            list_data = {'addr_street':addr_street, 'addr_city':addr_city, 'addr_state':addr_state, 'style':style, 'desc':desc, 'num_bed':num_bed,
                         'num_bath':num_bath, 'num_halfbath':num_halfbath, 'sqrfoot':sqrfoot, 'lot_sqrfoot':lot_sqrfoot, 'park_spaces':park_spaces, 'garage':garage,
                         'pool':pool, 'pic':pic, 'sqrfoot':sqrfoot, 'status':status, 'price':price};

            //Ajax response
            $.post('/list/do', list_data, function(response) {
                alert(response.type);

                // Load JSON data and display
                if(response.type == 'error')
                {
                    output = '<div class="list_result">'+response.text+'</div>';
                    alert(output);
                } else {
                    output = '<div class="list_result">'+response.text + ' - Listing #' + response.listID + '</div>';
                    alert(output);
                }

                $("#list_result").hide().html(output).slideDown();
            }, 'json');

        }
    });

    //reset form when new options selected
    $("#src_state").change(function() {
        $('select[name=src_state]').css('border-color','');
    });

    $("#src_city").change(function() {
        $('select[name=src_city]').css('border-color','');
    });

    $("#list_state").change(function() {
        $('select[name=list_state]').css('border-color','');
    });

    $("#list_city").change(function() {
        $('select[name=list_city]').css('border-color','');
    });

    $("#list_status").change(function() {
        $('select[name=list_status]').css('border-color','');
    });

});


