(function () {
    $(document).ready(function () {
        $('button[type="button"]').on('click', function () {
            $('form').css('display', 'block');
            $(this).css('display', 'none');
        })
        $('div[type="button"]').on('click', function () {
            $('#amnesty').css('display', 'block');
            $('#amnesty').find('textarea').attr('name', 'reason_amnesty');
            $(this).css('display', 'none');
        })
    })
}());