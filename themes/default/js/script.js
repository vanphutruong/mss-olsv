/**
 * Created with Sublime Text 2.
 * User: PhuTv.
 */
BASE_URL = 'http:/';

$(document).ready(function() {

    $(function(){

        menu = $('.container #menu').slicknav();

    });

    $(function(){

        $("input[type=radio]").uniform();

    });

    $('input, li, a, p').focus(function () {

        if ($('#parent-menu .slicknav_menu a').hasClass('slicknav_open')) {

            $(menu).slicknav('close');

        };

    });
    /* Get setting error display */
    var error = $('#error_flag').val();

    var title_mess = $('#title_mess').val();

    var type_mess = $('#type_mess').val();

    var error_timeout = $('#error_timeout').val();

    if (error > 0) {

        $("#overlay").fadeIn('slow');

        /* Display error message */
        convert_messi(title_mess, $('#error_mess').val(), type_mess, error_timeout);

        $('#error_mess').val("");

        $('#error_flag').val(0);

    };



});

/**
 * [convert_messi convert messi message to dropdown notification]
 * @param  {[string]} title         [title of notify]
 * @param  {[string]} message       [message body]
 * @param  {[string]} class_mess    [class css of type notification]
 * @param  {[integer]} error_timeout [time display notify]
 * @return {[null]}               [description]
 */
function convert_messi(title, message, class_mess, error_timeout) {

    var messi = new Array();

    messi['title'] = title;

    messi['message'] = message;

    messi['class'] = class_mess;

    messi['error_timeout'] = error_timeout;

    show_messi(messi);

}

/**
 * [show_messi show notify form setting]
 * @param  {[array string]} messi [is array setting messi]
 * @return {[null]}       [description]
 */
function show_messi(messi) {

    var error_timeout = 10000;

    if (messi['class'] == 'success') {

        messi['class'] = 'notyfy_success';

    } else if (messi['class'] == 'warning') {

        messi['class'] = 'notyfy_warning';

    } else {

        messi['class'] = 'notyfy_error';

    }

    $('#notyfy_container_top').remove();

    $(".overlay").remove();

    $(".messi-modal").remove();

    $('.main-wrapper').append('<ul id="notyfy_container_top" class="notyfy_container i-am-new" style="display: none; cursor: pointer;"><li class="notyfy_wrapper ' + messi['class'] + '" style="display: block; cursor: pointer;"><div id="notyfy_312147093313744500" class="notyfy_bar"><div class="notyfy_message"><span class="notyfy_text">' + messi['title'] + ': <strong>' + messi['message'] + '</strong></span></div></div></li></ul>');

    $('#notyfy_container_top').slideDown(function() {

        $('#notyfy_container_top').click(function() {

            $('#notyfy_312147093313744500').slideUp(function() {

                $('#notyfy_container_top').remove();

                $(".overlay").remove();

                $(".messi-modal").remove();

            });

        });

        if (messi['error_timeout']) {

            error_timeout = parseInt(messi['error_timeout']);

        };

        setTimeout(function() {

            $('#notyfy_312147093313744500').slideUp(function() {

                $('#notyfy_container_top').remove();

                $(".overlay").remove();

                $(".messi-modal").remove();

            });

        }, error_timeout);

        return;

    });

}

/**
 * [init_base_url get main url of server]
 * @param  {[string]} base_url [is protocol of request (http or https)]
 * @return {[string]}          [main url (no control, no parameter)]
 */
function init_base_url(base_url) {

    var url = window.location.href;

    url = url.replace("http://", "");

    var urlExplode = url.split("/");

    for (var i = 0; i < urlExplode.length; i++) {

        base_url += '/' + urlExplode[i];

        if (urlExplode[i] == 'index.php') {

            break;

        }

    };

    return base_url;
}