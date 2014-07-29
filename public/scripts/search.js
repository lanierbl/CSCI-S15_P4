$(document).ready(function($){

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
                $.each(data, function(index, value) {
                    city.append("<option value='"+ value +"'>" + value + "</option>");
                });
            });
    });
});