@include('layouts.header')

<section id="status-page">
    <div class="container">
        <div class="col-lg-12">
        <div class="status-page-card">
            <div class="status-page-title" style="background:#FF2F2F">
            <h3>Подписка недействительна.</h3>
            </div>
            <div class="status-page-txt">
            @if(Auth::user()->profile->is_locked)
                <p>
                    Заблокировано вручную.
                    Вы можете связаться с <a href="contactToSupport">потдержкой</a>,
                    или посмотрите ваши <a href="{{Request::root()}}/mytickets">обращения в тех. потдержку.</a>
                </p>
            @endif
            </div>
            <div class="status-page-link-back">
                <a href="{{Request::root()}}/edit">К настройкам аккаунта</a>
            </div>
        </div>
        </div>
    </div>
</section>

@include('layouts.footer')