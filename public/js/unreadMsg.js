(function () {
    $(document).ready(function () {
        var fomFriends = $('span[id^="fromFrId_"]');
        var toFriends = $('span[id^="toFrId_"]');

        function checkUnreadMessagesFromFriend(id, el) {
            $.get('checkUnreadMessagesFromFriend/' + id, function (data) {
                if (data != 'null') {
                    el.text('У вас есть новые сообщения');
                }
            })
        }

        function checkMyUnreadMessagesByFriend(id, el) {
            $.get('checkMyUnreadMessagesByFriend/' + id, function (data) {
                if (data != 'null') {
                    el.text('Ваши сообщения не прочитаны')
                } else {
                    el.text('Ваши сообщения были прочитаны');
                }
            })
        }

        function check() {
            fomFriends.each((key, val) => {
                var id = $(val).attr('id').split('_')[1];
                checkUnreadMessagesFromFriend(id, $(val))
            })
            toFriends.each((key, val) => {
                var id = $(val).attr('id').split('_')[1];
                checkMyUnreadMessagesByFriend(id, $(val))
            })
        }

        setInterval(check, 3000);
        setTimeout(check, 100);

    })
}());