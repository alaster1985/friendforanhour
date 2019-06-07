(function () {
    $(document).ready(function () {
        $('#sendComplain').click(function () {
            var data = {
                profileIdFrom: $('#profileIdFrom').val(),
                profileIdAgainst: $('#profileIdAgainst').val(),
                complain: $('#complain').val(),
                _token: $('meta[name="csrf-token"]').attr('content'),
            };
            $.post('addComplain', data, function (data, status) {
                if (status === 'success') {
                    alert('Жалоба отправлена!');
                    $('#complainButton').remove()
                }
            })
        })
    })
}());