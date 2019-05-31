(function () {
    $(document).ready(function () {
        if (window.location.pathname === '/edit') {
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
            let lastRow = $('.services_as_sponsor tr:last').clone();
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
            // lastRow.find('select').detach();
            i++;
            lastRow.appendTo('.services_as_sponsor');
        });
        var j = 0;
        $('#new_service_as_friend').click(function () {
            let lastRow = $('.services_as_friend tr:last').clone();
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
            // lastRow.find('select').detach();
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
            _token: $('meta[name="csrf-token"]').attr('content')
        }, function (data) {
            $(data).each(function (key, val) {
                mark = val.main_photo_marker ? 'Основная' : '';
                if (window.location.pathname === '/edit') {
                    mark = '<input type="radio" name="marker" value="' + val.id + '"' + (val.main_photo_marker ? 'checked' : '') + '>';
                    removePhotoButton = '<td><button type="button" id="removePhotoButton' + val.id + '" >remove</button></td>';
                }

                $('#usersPhoto').append('<tr>' +
                    '<td><img height="10%" src="' + val.photo_path + '"></td>' +
                    '<td>' + mark + '</td>' + removePhotoButton +
                    '</tr>')
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

    // function checkPhotoQuantity() {
    //     if ($("#usersPhoto td").closest("tr").length >= 1 || $("#usersPhoto td").closest("tr").length <= 9) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    function remove(photoId) {
        // if (checkPhotoQuantity()) {
            $.post('removePhoto', {
                _token: $('meta[name="csrf-token"]').attr('content'),
                photo_id: photoId
            }, function (data, status) {
                if (status === 'success') {
                    getPhoto();
                }
            });
        // } else {
        //     alert('Photos quantity must be more than 1 and less than 9!')
        // }

    }

    function updatePhoto() {
        // if (checkPhotoQuantity()) {
            var formData = new FormData();
            var uploadFile = null;
            var file = document.getElementById('imgInput');
            var mainPhoto_id = $("#usersPhoto input[type='radio']:checked").val();
            if (file.files && file.files[0]) {
                uploadFile = file.files[0];
                formData.append('file', uploadFile);
            }
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
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
        // }
    }

    function resetPreview() {
        $('#preview').attr('src', 'images/preview.png');
        $('#imgInput').val('');
    }
}());