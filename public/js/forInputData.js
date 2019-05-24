(function () {
    $(document).ready(function () {
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
            lastRow.find('div').replaceWith('<button id="cancelButton' + i + '" type="button">cancel</button>');
            lastRow.find('select').detach();
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
            lastRow.find('div').replaceWith('<button id="cancelButton' + j + '" type="button">cancel</button>');
            lastRow.find('select').detach();
            j++;
            lastRow.appendTo('.services_as_friend');
        });

        $('table').on('click', 'button', function () {
            this.closest('tr').remove()
        })

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

        // function readURL(input) {
        //
        //     if (input.files && input.files[0]) {
        //         var reader = new FileReader();
        //
        //         reader.onload = function(e) {
        //             $('#blah').attr('src', e.target.result);
        //         }
        //
        //         reader.readAsDataURL(input.files[0]);
        //     }
        // }
        //
        // $("#imgInp").change(function() {
        //     readURL(this);
        // });

    });
}());