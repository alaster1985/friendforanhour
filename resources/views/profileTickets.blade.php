@include('layouts.header')
<section id="support-tickets">
    <div class="container">
        {{-- <h2>Мои Вопросы:</h2> --}}
        <div class="row  service service_close">            
            <table class="col-lg-12 table_paid">
                {{-- <td><label>ID:</label></td>
                <td><label>Заголовок:</label></td>
                <td><label>Описание:</label></td>
                <td><label>Ответ:</label></td>
                <td><label>Статус:</label></td> --}}
                @foreach($tickets as $ticket)
                    <tr class="support-tickets-content">
                        <td>{{$ticket->id}}</td>
                        <td>{{$ticket->title}}</td>
                        <td>{{$ticket->description}}</td>
                        <td>{{$ticket->report}}</td>
                        <td>{{$ticket->status->status}}</td>
                    </tr>
                @endforeach
            </table>
            <div class="new-support-tickets">
                <a href="contactToSupport">Новое сообщение</a>
            </div>
        </div>
    </div>
</section>
@include('layouts.footer')