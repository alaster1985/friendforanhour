@include('layouts.header')
<p>lara2</p>
@include('layouts.footer')
<script type="text/javascript">
    $(document).ready(function () {
        var data = {
            longitude: 44.619724,
            latitude: 48.802045,
            radius: 25,
            _token: $('meta[name="csrf-token"]').attr('content'),
        };
        $.post('getProfilesByChordsAndRadius', data, function (data, status) {
            console.log(JSON.parse(data), status)
        })
    })
</script>