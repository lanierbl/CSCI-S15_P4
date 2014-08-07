$(document).ready(function($){

    $("#search_submit").click(function() {
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
            json_obj['city'] = document.getElementById("city").value;

            if (document.getElementById("guest").value == 'false') {
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
            }

            $.post('/search/do', json_obj, function(response) {
                output = '<div class="success">'
                if (response.results.length == 0) {
                    output = output + '<h2>No Homes Found</h2>';
                } else {
                    for (i = 0; i < response.results.length; i++) {
                        output += "<b>Address</b> " + "<a data-toggle=\"modal\" data-id=\"" + response.results[i].id + "\" class=\"open-homeModal\" data-target=\"#homeModal\">" +
                            response.results[i].addr_street + ", " +
                            response.results[i].addr_city + ", " +
                            response.results[i].addr_state + "</a><br/>";
                        output += "<b>Bedrooms: </b>" + response.results[i].num_bed + "  -  ";
                        output += "<b>Bathrooms: </b>" + response.results[i].num_bath + "<br>";
                        output += "<br/>";
                    }
                }

                output += '</div>';

                $("#result").hide().html(output).slideDown();

                if ($('#searchName').val() != "") {
                    getMySearches();
                }
                clearSearchForm();
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

                // Load JSON data and display
                if(response.type == 'error')
                {
                    output = '<div class="list_result">'+response.text+'</div>';
                } else {
                    output = '<div class="list_result">'+response.text + ' - Listing #' + response.listID + '</div>';
                }

                $("#list_result").hide().html(output).slideDown();

                getMyListings();
                clearSearchForm();

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

    $("#list_state").change(function() {
        $('select[name=list_state]').css('border-color','');
    });

    $("#list_city").change(function() {
        $('select[name=list_city]').css('border-color','');
    });

    $("#list_status").change(function() {
        $('select[name=list_status]').css('border-color','');
    });

    $("#addCity_submit").click(function() {
        var label = 'city';
        var value = document.getElementById("add_city").value;
        document.getElementById("add_city").value = document.getElementById("add_city").defaultValue;
        addLabel(label, value);
    });

    $("#addState_submit").click(function() {
        var label = 'state';
        var value = document.getElementById("add_state").value;
        document.getElementById("add_state").value = document.getElementById("add_state").defaultValue;
        addLabel(label, value);
    });

    $("#addStyle_submit").click(function() {
        var label = 'style';
        var value = document.getElementById("add_style").value;
        document.getElementById("add_style").value = document.getElementById("add_style").defaultValue;
        addLabel(label, value);
    });

    $("#addStatus_submit").click(function() {
        var label = 'status';
        var value = document.getElementById("add_status").value;
        document.getElementById("add_status").value = document.getElementById("add_status").defaultValue;
        addLabel(label, value);
    });

    function getDropdownList(label) {
        url = "/api/get/ddList/" + label;
        var label = label;
        $.ajax({
            url: url,
            success: function(data) {
                var output_src = $('#' + label);
                var output_list = $('#list_' + label);
                output_src.empty();
                output_list.empty();
                output_src.append('<option>Select ' + capitaliseFirstLetter(label) + '</option>');
                output_list.append('<option>Select ' + capitaliseFirstLetter(label) + '</option>');
                $.each(data, function(index, value) {
                    output_src.append("<option value='"+ value +"'>" + value + "</option>");
                    output_list.append("<option value='"+ value +"'>" + value + "</option>");
                });
            }
        });
    }

    function addLabel(label, value) {
        label_data = {'label':label, 'value':value};
        $.post('/api/add/label', label_data, function(response) {
            if (response.action == 'success') {
                getLabelValues(label);
                getDropdownList(label);
                alert('Label "' + value + '" Created Successfully!');
            } else {
                output = response.message;
                alert(output);
            }
        }, 'json');
    }

    getDropdownList('city');

    getDropdownList('state');

    getDropdownList('style');

    getDropdownList('status');

    getLabelValues('city');

    getLabelValues('state');

    getLabelValues('style');

    getLabelValues('status');

    getMySearches();

    getMyListings();

})

function capitaliseFirstLetter(string)
{
    return string.charAt(0).toUpperCase() + string.slice(1);
}


function getLabelValues(label) {
    url = "/api/get/label/" + label;
    $.ajax({
        url: url,
        success: function(data) {
            output = '<div class="current_' + label + '">';
            $.each(data, function(index, value) {
                output = output + "<p><h4>" + value + "</h4></p>";
            });
            output = output + ("</div>");
            $('#current_' + label).hide().html(output).slideDown();
        }
    });
}

// Closes the sidebar menu
$("#menu-close").click(function(e) {
    e.preventDefault();
    $("#sidebar-wrapper").toggleClass("active");
});

// Opens the sidebar menu
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#sidebar-wrapper").toggleClass("active");
});

// Scrolls to the selected menu item on the page
$(function() {
    $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
});

window.setTimeout(function() {
    $(".flash").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 5000);

$(document).on("click", ".open-homeModal", function () {
    var homeID = $(this).data('id');

    $.post('/api/get/homeDetail', {'homeID':homeID}, function(response) {

        output = '<div class="homedetail">';
        $.each(response, function(name, value) {
            output = output + '<p>Name: ' + name + ' - Value: ' + value + '</p>';
        })
        output = output + ("</div>");
        alert(output);
        $("#homedetail").hide().html(output).slideDown();

    }, 'json');

});

$(document).on("click", ".delsearch", function () {
    var searchID = $(this).data('id');
    $.post('/api/delete/search', {'searchID':searchID}, function(response) {
        if (response.action == 'success') {
            getMySearches();
        }
        output = response.message;
        alert(output);
    }, 'json');
});

$(document).on("click", ".dellisting", function () {
    var listingID = $(this).data('id');
    $.post('/api/delete/listing', {'listingID':listingID}, function(response) {
        if (response.action == 'success') {
            getMyListings();
        }
        output = response.message;
        alert(output);
    }, 'json');
});

$(document).on("click", ".mysvsearch", function() {
    var searchID = $(this).data('id');
    search_data = {'searchID':searchID};
    $.post('/api/get/searchJSON', search_data, function(response) {
        replaceSearch(response.searchJSON);
    }, 'json');
});

function replaceSearch(searchJSON) {
    clearSearchForm();
    $.each(searchJSON, function(name, val) {
        var $el = $('[name="' + name + '"]'),

            type = $el.attr('type');

        switch (type) {
            case 'checkbox':
                $el.attr('checked', 'checked');
                break;
            case 'radio':
                $el.filter('[value="' + val + '"]').attr('checked', 'checked');
                break;
            default:
                $el.val(val);
        }
    });
}

function getMySearches() {
    $.ajax({
        url: '/api/get/mySearches',
        success: function(data) {
            output = '<div class="mySearches">';
            if (data.length == 0) {
                output = output + '<p>No Searches</p>';
            } else {
                $.each(data, function(index, value) {
                    output = output + '<p><a class="mysvsearch" data-id="' + value.id + '">' + value.name +
                        '</a> <a class="delsearch" data-id="' + value.id +
                        '"><span class="glyphicon glyphicon-remove icon"></span></a></p>'
                })
            }
            output = output + ("</div>");
            $("#mySearches").hide().html(output).slideDown();
        }
    })
}

function getMyListings() {
    $.ajax({
        url: '/api/get/myListings',
        success: function(data) {
            output = '<div class="myListings">';
            if (data.length == 0) {
                output = output + '<p>No Listings</p>';
            } else {
                $.each(data, function(index, value) {
                    output = output + '<p><a data-toggle="modal" data-id="' + value.home_id +
                        '" class="open-homeModal" data-target="#homeModal">Listing #' + value.home_id +
                        ' - ' + value.status + '</a> <a class="dellisting" data-id="' + value.id +
                        '"><span class="glyphicon glyphicon-remove icon"></span></a></p>';
                })
            }
            output = output + ("</div>");
            $("#myListings").hide().html(output).slideDown();
        }
    })
}

function clearSearchForm() {
    document.getElementById("city").value = "Select City";
    document.getElementById("state").value = "Select State";
    document.getElementById("list_city").value = "Select City";
    document.getElementById("list_state").value = "Select State";
    if (document.getElementById("guest").value == 'false') {
        document.getElementById("style").value = "Select Style";
        document.getElementById("list_style").value = "Select Style";
        document.getElementById("num_bed").value = document.getElementById("num_bed").defaultValue;
        document.getElementById("list_num_bed").value = document.getElementById("num_bed").defaultValue;
        document.getElementById("num_bath").value = document.getElementById("num_bath").defaultValue;
        document.getElementById("list_num_bath").value = document.getElementById("num_bath").defaultValue;
        document.getElementById("num_halfbath").value = document.getElementById("num_halfbath").defaultValue;
        document.getElementById("list_num_halfbath").value = document.getElementById("num_halfbath").defaultValue;
        document.getElementById("park_spaces").value = document.getElementById("park_spaces").defaultValue;
        document.getElementById("list_park_spaces").value = document.getElementById("park_spaces").defaultValue;
        document.getElementById("sqrfoot").value = document.getElementById("sqrfoot").defaultValue;
        document.getElementById("list_sqrfoot").value = '';
        document.getElementById("lot_sqrfoot").value = document.getElementById("lot_sqrfoot").defaultValue;
        document.getElementById("list_lot_sqrfoot").value = '';
        document.getElementById("searchName").value = document.getElementById("searchName").defaultValue;
        document.getElementById("list_street").value = '';
        document.getElementById("list_status").value = document.getElementById("searchName").defaultValue;
        document.getElementById("list_price").value = '';
        document.getElementById("list_desc").value = '';
        $('input:checkbox').removeAttr('checked');
    }
}
