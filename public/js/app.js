$(document).ready(function(){
    $('.list-group-item').click(function(){
        $val = $(this).text();
        alert($val);
    });

    /*
     *popup for login
     */
    $('#logintrigger').click(function(e) {
        $('#sign_up').lightbox_me({
            centered: true,
            onLoad: function() {
                $('#login').find('input:first').focus()
            }
        });
        e.preventDefault();
    });

    $('#toggle-login').click(function(){
        $('#login').toggle();
    });
});