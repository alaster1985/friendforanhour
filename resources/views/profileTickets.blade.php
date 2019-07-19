@include('layouts.header')
<section id="support-tickets">
    <div class="container">
        <div class="row  service service_close">
            <h2>Мои Вопросы:</h2>
            <table class="col-lg-12 table_paid">
                <td><label>ID:</label></td>
                <td><label>Заголовок:</label></td>
                <td><label>Описание:</label></td>
                <td><label>Ответ:</label></td>
                <td><label>Статус:</label></td>
                <td><label>Создано:</label></td>
                <td><label>Обновлено:</label></td>
                @foreach($tickets as $ticket)
                    <tr class="support-tickets-content">
                        <td>{{$ticket->id}}</td>
                        <td>{{$ticket->title}}</td>
                        <td>{{$ticket->description}}</td>
                        <td>{{$ticket->report}}</td>
                        <td>{{$ticket->status->status}}</td>
                        <td>{{$ticket->created_at}}</td>
                        <td>{{$ticket->created_at}}</td>
                    </tr>
                @endforeach
            </table>
            <div class="col-lg-12 new-support-tickets">
                <button class="btn btn-primary btn-md btn-block" type="button">
                    <a href="contactToSupport">Новое сообщение</a>
                </button>
            </div>
        </div>
    </div>
</section>
@include('layouts.footer')