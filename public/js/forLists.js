(function () {
    $(document).ready(function () {
        $('#add-to-favorites').click(function () {
            var data = {
                profileIdOwner: $('#profileIdFrom').val(),
                profileIdFavorite: $('#profileIdAgainst').val(),
                _token: $('meta[name="csrf-token"]').attr('content'),
            };
            $.post('addToFavorite', data, function (data, status) {
                if (status === 'success') {
                    alert('Пользовать успешно добавлен в избранное');
                    $('#add-to-favorites').remove()
                }
            })
        });

        $('#to-blacklist').click(function () {
            var data = {
                profileIdOwner: $('#profileIdFrom').val(),
                profileIdNonGrata: $('#profileIdAgainst').val(),
                _token: $('meta[name="csrf-token"]').attr('content'),
            };
            $.post('addToBlackList', data, function (data, status) {
                if (status === 'success') {
                    alert('Пользователь успешно внесен в черный список');
                    $('#to-blacklist').remove()
                }
            })
        })
    })
}());


