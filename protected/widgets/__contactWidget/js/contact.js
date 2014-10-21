/**
 * Created by mukolla on 03.04.14.
 */

$(document).ready(function() {
    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
        google.maps.event.addDomListener(window, 'load', initialize(option));
    });

    $(document).on('submit', '#feedback-form', function (e) {
        e.preventDefault();
        var $this = $(this),
            url = $this.attr('action'),
            data = $this.serialize();
        $.post(url, data, function (response) {
            if(typeof response.result != 'undefined' && response.result == 'success'){
                $('#myModal4').modal('show');
            } else {
            }
        }, "json");
    });

    $("#myModal4").on('hidden.bs.modal', function(){
        document.location.href = '/contact';
    });
});
