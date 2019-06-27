(function () {
    $(document).ready(function () {
        $('button[type="button"]').on('click', function () {
            $('form').css('display', 'block');
            $(this).css('display', 'none');
        });
        $('#amnesty').on('click', function () {
            $('#amnesty_input').css('display', 'block');
            $('#amnesty_input').find('textarea').attr('name', 'reason_amnesty');
            $(this).css('display', 'none');
        });
        $('#add1moAccess').on('click', function (e) {
            if (window.confirm('Are you sure?')) {
                $(this).parent().parent().css('display', 'none');
                $('#details').css('display', 'none');
                $('#accessData').css('display', 'block');
            } else {
                e.preventDefault();
            }
        })
    })
}());