@include('layouts.header')

<section id="status-page">
  <div class="container">
    <div class="col-lg-12">
      <div class="status-page-card">
        <div class="status-page-title" style="background:#57CF23">
          <h3>Успешная транзакция.</h3>
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