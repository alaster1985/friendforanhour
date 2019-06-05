
$(document).ready(function () {


    if ($(window).width() <= '768') {
        $('#navbarSupportedContent').appendTo('.mobile_autorization');
    };
    $(document).ready(function () {
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
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }
            ]
        });
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

function fancybox(event) {
    $(".fancybox").fancybox({});
}
    
})