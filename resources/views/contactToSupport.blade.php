@include('layouts.header')
<section id="technical-support">
    <div class="container">
        {{-- <h2>Поддержка:</h2> --}}
        @if ($errors)
            <div class="error">{{($errors->first())}}</div>
        @endif
        @if(session()->has('message'))
            <div class="alert alert-success" align="center">{{ session()->get('message') }}</div>
        @endif
        <div class="col-lg-8 justify-content-center technical-support-contact-form">
            <form method="POST" enctype="multipart/form-data" action="{{Route('sendTicket')}}">
                @csrf
                    <label>Заголовок:</label>
                    <input class="form-control form-control-md" name="title" type="text" value="{{old('title')}}">
                    <label>Описание:</label>
                    <textarea class="form-control form-control-md" name="description" rows="10">{{old('description')}}</textarea>
                @guest
                    <label>Введите свой E-mail:</label>
                    <input class="form-control form-control-md" name="email" type="email" value="{{old('email')}}">
                    <label>Введите свое Имя:</label>
                    <input class="form-control form-control-md" name="name_from" type="text" value="{{old('name_from')}}">
                @endguest
                @auth
                    <input class="form-control form-control-md" type="hidden" name="profile_id" value="{{Auth::user()->profile_id}}">
                @endauth
                <button class="col-lg-2 btn btn-md btn-block" type="submit">Отправить</button>
            </form>
        </div>        
    </div>
</section>
@include('layouts.footer')