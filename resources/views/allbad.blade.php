@include('layouts.header')

<section id="status-page">
  <div class="container">
    <div class="col-lg-12">
      <div class="status-page-card">
        <div class="status-page-title" style="background: #FF2F2F">
          <h3>Ошибка транзакции.</h3>
        </div>
        <div class="status-page-txt">
          <p>{{$messageOk}}</p>
        </div>
        <div class="status-page-link-back">
            <a href="{{Request::root()}}/edit">К настройкам аккаунта</a>
        </div>
      </div>
    </div>
  </div>
</section>

@include('layouts.footer')