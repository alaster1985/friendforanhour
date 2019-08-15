

$(document).ready(function () {

    $('#user_search').submit(function () {

        $.post('filter', $("#user_search").serialize(),
            function (data) {
                var userCardArr = JSON.parse(data);
                console.log(userCardArr);
                $('#user_search').hide('slow');
                $('#search-section h2').hide('slow');
                $('#user_search_result').removeClass('none');

                
                // var usersCardArr = JSON.parse(msg);
                // for (var i = 0; i < usersCardArr.profile.length; i++) {
                //     var profile = usersCardArr.profile[i];
                //     console.log(profile.counter_name);
                // }
            }
        );
        return false;
    });

    $('.photo_user').slick({
        slidesToShow: 6,
        arrows: true,
        responsive: [
            {
                breakpoint: 998,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                }
            }, {
                breakpoint: 600,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 2
                }
            }, {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.table_paid tr:gt(3)').addClass('dissable_block')

    $('.table_paid_open').on('click', function () {
        $('.table_paid tr:gt(3)').toggleClass('dissable_block');
        $('.table_paid_open .open_table').toggleClass('dissable_block');
        $('.table_paid_open .close_table').toggleClass('active_table');
    });

    $('.table_for_me tr:gt(3)').addClass('dissable_block')

    $('.table_for_me_open').on('click', function () {
        $('.table_for_me tr:gt(3)').toggleClass('dissable_block');
        $('.table_for_me_open .open_table').toggleClass('dissable_block');
        $('.table_for_me_open .close_table').toggleClass('active_table');
    });

    $('.forChat').on("click", function (ev) {
        ev.preventDefault();
        $(".modal-error").css("display", "block");
        $(".modal-darkening").css("display", "block");
    });

    $(".modal-error__close-btn").on("click", function (ev) {
        ev.preventDefault();
        $(".modal-error").css("display", "none");
        $(".modal-darkening").css("display", "none");
    });

    function fancybox(event) {
        $(".fancybox").fancybox({});
    }

})