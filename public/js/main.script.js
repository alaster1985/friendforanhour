$(document).ready(function () {

    // Search User Slider
    $('#user_search').submit(function () {
        $('.alert-danger').empty();
        
        $.post('filter', $("#user_search").serialize(),
            function (data) {
                if (data.success == false) {
                    $.each(data.errors, function (key, value) {
                        $('.alert-danger').show();
                        $('.alert-danger').append('<p>' + value + '</p>');
                    });
                } else {

                    var userCardArr = JSON.parse(data);
                        
                    for (var i = 0 in userCardArr) {
                        var para = document.createElement("div");
                        para.classList = "tinder--card";
                        para.innerHTML = 
                            '<img src="' + userCardArr[i].profile_photo[0].photo_path + '">' +
                            '<h3>' + userCardArr[i].first_name + '</h3>' +
                            '<p>' + userCardArr[i].about + '</p>';
                        document.getElementById('tinder--cards').appendChild(para);

                        // console.log(userCardArr[i]);
                    }
                    $('#user_search').hide('slow');
                    $('#search-section h2').hide('slow');
                    $('#user_search_result').removeClass('none');
                }                
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

    setInterval(lastActivity, 3000);

    function lastActivity() {
        var onlineMarker;
        if ($('body').find('#chat-vue').length > 0) {
            onlineMarker = $('body').find('#chat-vue').find('img').attr('src').substr(-5, 1);
        } else {
            onlineMarker = false
        }
        if ($('#last_activity').length > 0 && onlineMarker !== false) {
            if (onlineMarker == 1) {
                $('#last_activity').hide()
            } else {
                $('#last_activity').show()
            }
        }
    }

})