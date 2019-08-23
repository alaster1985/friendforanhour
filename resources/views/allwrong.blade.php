@include('layouts.header')
<div style="background: #1da1f2">something went wrong</div>
<div id="divContainer" style="position: absolute; left: 50px; top: 90px;">
    <div id="frameContainer" style="overflow:hidden;">
        <iframe id="myIframe" src="https://ulogin.ru/clear_page.php" scrolling="no" style="width: 233px; height: 400px; margin-top: -350px; margin-left: -63px; margin-bottom: -10px;">
        </iframe>
    </div>
</div>
@include('layouts.footer')

<script type="text/javascript">
    // $(document).ready(function () {
    //     var myIframe = document.getElementById('myIframe');
    //     var iWindow = myIframe.contentWindow;
    //     var iDoc = iWindow.document;
    //     var fb = iDoc.getElementsByClassName('ulogin-button-facebook')
    //     var ok = iDoc.getElementsByClassName('ulogin-button-odnoklassniki')
    //     var vk = iDoc.getElementsByClassName('ulogin-button-vkontakte')
    //
    //     console.log(fb)
    //     console.log(ok)
    //     console.log(vk)
    //
    // })
</script>