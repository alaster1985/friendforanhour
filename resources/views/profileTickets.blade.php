@include('layouts.header')
<div class="row  service service_close">
    <div class="col-lg-8 col-12 ">
        <table class="col-12 table_paid">
            <tr>
                <th class="table_title_service">My tickets to support</th>
                <th></th>
            </tr>
            <td>ID</td>
            <td>Title</td>
            <td>Description</td>
            <td>Report</td>
            <td>Status</td>
            <td>Created_at</td>
            <td>Updated_at</td>
            @foreach($tickets as $ticket)
                <tr>
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
        <button class="table_paid_open"><span class="open_table">More</span><span
                    class="close_table">Less</span></button>
        <a href="contactToSupport">new ticket</a>
    </div>
</div>
@include('layouts.footer')