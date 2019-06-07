(function () {
    $(document).ready(function () {
        if (window.location.pathname === '/edit' || window.location.pathname === '/admin/editProfileUser') {
            // if (window.location.pathname === '/demo/friendforanhour/public/edit' || window.location.pathname === '/demo/friendforanhour/public/admin/editProfileUser') {
            getPhoto();
        }

        $('table').on('change', 'input.main_service_marker1', function () {
            if ($('table').find('input.main_service_marker1:checked').length > 2) {
                $(this).prop('checked', '');
                alert('Select maximum ' + 2 + ' Levels!');
            }
        });
        $('table').on('change', 'input.main_service_marker2', function () {
            if ($('table').find('input.main_service_marker2:checked').length > 2) {
                $(this).prop('checked', '');
                alert('Select maximum ' + 2 + ' Levels!');
            }
        });

        var i = 0;
        $('#new_service_as_sponsor').click(function () {
            let lastRow;
            if ($('.services_as_sponsor tr').length === 1) {
                let newLastRow =
                    '<tr>\n' +
                    '    <td><input type="text" maxlength="14" name="service_name[1n0]" value=""></td>\n' +
                    '    <td><input type="text" name="service_description[1n0]" value=""></td>\n' +
                    '    <td><input type="number" min="0" max="100000" name="price[1n0]" value=""></td>\n' +
                    '    <td><input type="checkbox" class="main_service_marker1" name="main_service_marker[1n0]"></td>\n' +
                    '    <td>\n' +
                    '        <select name="is_disabled[1n0]">\n' +
                    '            <option value="0">Enabled</option>\n' +
                    '            <option value="1">Disabled</option>\n' +
                    '        </select>\n' +
                    '    </td>\n' +
                    '    <td><button id="cancelServiceButton0" type="button">cancel</button></td>\n' +
                    '</tr>';
                $('.services_as_sponsor').append(newLastRow);
                lastRow = $('.services_as_sponsor tr:last');
            } else {
                lastRow = $('.services_as_sponsor tr:last').clone();
            }
            lastRow.find(':input').each(function () {
                let newMark = this.name.substring(
                    this.name.lastIndexOf("[") + 1,
                    this.name.lastIndexOf("]")
                );
                this.name = this.name.replace(newMark, '1n' + i);
                if (this.type === 'text' || this.type === 'number') {
                    this.value = '';
                }
                if (this.type === 'checkbox') {
                    this.checked = '';
                }
            });
            lastRow.find('div').replaceWith('<button id="cancelServiceButton' + i + '" type="button">cancel</button>');
            lastRow.find('option').removeAttr("id");
            i++;
            lastRow.appendTo('.services_as_sponsor');

        });
        var j = 0;
        $('#new_service_as_friend').click(function () {
            let lastRow;
            if ($('.services_as_friend tr').length === 1) {
                let newLastRow =
                    '<tr>\n' +
                    '    <td><input type="text" maxlength="14" name="service_name[2n0]" value=""></td>\n' +
                    '    <td><input type="text" name="service_description[2n0]" value=""></td>\n' +
                    '    <td><input type="number" min="0" max="100000" name="price[2n0]" value=""></td>\n' +
                    '    <td><input type="checkbox" class="main_service_marker2" name="main_service_marker[2n0]"></td>\n' +
                    '    <td>\n' +
                    '        <select name="is_disabled[2n0]">\n' +
                    '            <option value="0">Enabled</option>\n' +
                    '            <option value="1">Disabled</option>\n' +
                    '        </select>\n' +
                    '    </td>\n' +
                    '    <td><button id="cancelServiceButton0" type="button">cancel</button></td>\n' +
                    '</tr>';
                $('.services_as_friend').append(newLastRow);
                lastRow = $('.services_as_friend tr:last');
            } else {
                lastRow = $('.services_as_friend tr:last').clone();
            }
            lastRow.find(':input').each(function () {
                let newMark = this.name.substring(
                    this.name.lastIndexOf("[") + 1,
                    this.name.lastIndexOf("]")
                );
                this.name = this.name.replace(newMark, '2n' + j);
                if (this.type === 'text' || this.type === 'number') {
                    this.value = '';
                }
                if (this.type === 'checkbox') {
                    this.checked = '';
                }
            });
            lastRow.find('div').replaceWith('<button id="cancelServiceButton' + j + '" type="button">cancel</button>');
            lastRow.find('option').removeAttr("id");
            j++;
            lastRow.appendTo('.services_as_friend');
        });

        $('table').on('click', 'button[id^="cancelServiceButton"]', function () {
            this.closest('tr').remove()
        });

        $('table').on('click', 'button[id^="removePhotoButton"]', function () {
            if (confirm('Are you sure you want to delete this photo?')) {
                remove(this.id.split('removePhotoButton').pop());
            } else {
                return false;
            }
        });

        $('#cancelPreview').click(function () {
            resetPreview()
        });

        $("[name = 'city']").on("click", function () {
            if (this.value === 'new') {
                $(".newCity").css("display", "block");
            } else {
                $(".newCity").css("display", "none");
            }
        });

        $("[name = 'country']").on("click", function () {
            if (this.value === 'new') {
                $(".newCountry").css("display", "block");
            } else {
                $(".newCountry").css("display", "none");
            }
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInput").change(function () {
            readURL(this);
        });

        $('#updatePhotoForm').submit(function (e) {
            updatePhoto();
            e.preventDefault();
        })
    });

    function getPhoto() {
        $('#usersPhoto').find('tr').not('tr:eq( 0 )').remove();
        var mark;
        var removePhotoButton = '';
        $.post('getPhotos', {
            _token: $('meta[name="csrf-token"]').attr('content'),
            profileId: $("input[name=profile_id]").val() ? $("input[name=profile_id]").val() : null
        }, function (data) {
            $(data).each(function (key, val) {
                mark = val.main_photo_marker ? 'Основная' : '';
                // if (window.location.pathname === '/demo/friendforanhour/public/edit' || window.location.pathname === '/demo/friendforanhour/public/admin/editProfileUser') {
                if (window.location.pathname === '/edit' || window.location.pathname === '/admin/editProfileUser') {
                    mark = '<input type="radio" class="marker_chect" name="marker" value="' + val.id + '"' + (val.main_photo_marker ? 'checked' : '') + '>';
                    removePhotoButton = '<td><button type="button" id="removePhotoButton' + val.id + '" >Удалить</button></td>';
                }

                $('#usersPhoto').append('<tr>' +
                   // '<td><img height="10%" src="/demo/friendforanhour/public/' + val.photo_path + '"></td>' +
                    '<td><img height="10%" src="/' + val.photo_path + '"></td>' +
                    '<td>' + mark + '</td>' + removePhotoButton +
                    '</tr>');
            });
            checkNumberOfPhotos();
        });
    }

    function checkNumberOfPhotos() {
        if ($('#usersPhoto tr').length <= 9 ? true : false) {
            $('#addNewPhoto').show()
        } else {
            $('#addNewPhoto').hide()
        }
    }

    function remove(photoId) {
        $.post('removePhoto', {
            _token: $('meta[name="csrf-token"]').attr('content'),
            photo_id: photoId
        }, function (data, status) {
            if (status === 'success') {
                getPhoto();
            }
        });
    }

    function updatePhoto() {
        var formData = new FormData();
        var uploadFile = null;
        var file = document.getElementById('imgInput');
        var mainPhoto_id = $("#usersPhoto input[type='radio']:checked").val();
        if (file.files && file.files[0]) {
            uploadFile = file.files[0];
            formData.append('file', uploadFile);
        }
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        formData.append('profileId', $("input[name=profile_id]").val() ? $("input[name=profile_id]").val() : null);
        formData.append('count', $('#usersPhoto tr').length);
        if (mainPhoto_id) {
            formData.append('mainPhoto_id', mainPhoto_id);
        }
        $.ajax({
            url: 'updatePhoto',
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (data) {
                resetPreview();
                getPhoto();
            },
            error: function (data) {
                $.each(data.responseJSON.errors, function (key, value) {
                    $('.alert-danger').show();
                    $('.alert-danger').empty();
                    $('.alert-danger').append('<p>' + value + '</p>');
                });
            }
        });
    }

    function resetPreview() {
        $('#preview').attr('src', '/images/preview.png');
        $('#imgInput').val('');
    }
}());