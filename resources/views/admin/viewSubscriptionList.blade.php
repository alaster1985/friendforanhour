@include('admin/layouts.header')
@include('admin/layouts.menu')
<div class="content-sec">
    @if(session()->has('message'))
        <div class="alert alert-success" align="center">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="container">
        <div class="title-date-range">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-title">
                        <h4 class="StepTitle">Transaction LIST</h4>
                    </div>
                </div>
                <div class="col-md-6">
                </div>
            </div>
        </div><!-- title Date Range -->
        <div class="row">
            <div class="masonary-grids">
                <div class="col-md-12">
                    <div class="widget-area">
                        <div class="streaming-table">
                            <span id="found" class="label label-info"></span>
                            <table id="stream_table" class='table table-striped table-bordered'>
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Profile</th>
                                    {{--<th>Transaction  name</th>--}}
                                    <th>Transaction description</th>
                                    <th>Amount (rub)</th>
                                    <th>Created_at</th>
                                    {{--<th>Updated_at</th>--}}
                                    {{--<th>Edit</th>--}}
                                    {{--@if(Auth::user()->hasRole('admin'))--}}
                                    {{--<th>Delete</th>--}}
                                    {{--@endif--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>
                                            {{$transaction->id}}
                                        </td>
                                        <td>
                                            <a href="editProfileUser?prf={{$transaction->profile_id}}">{{$transaction->profile->first_name . ' ' . $transaction->profile->second_name}}</a>
                                        </td>
                                        {{--<td>--}}
                                            {{--{{$transaction->transaction->transaction_name}}--}}
                                        {{--</td>--}}
                                        <td>
                                            {{$transaction->transactionName->description}}
                                        </td>
                                        <td>
                                            {{$transaction->getMoneyFormat()}}
                                        </td>
                                        <td>
                                            {{$transaction->created_at}}
                                        </td>
                                        {{--<td>--}}
                                            {{--{{$transaction->updated_at}}--}}
                                        {{--</td>--}}
                                        {{--<td>--}}
                                            {{--<a href="editBan?ban={{$transaction->id}}">+</a>--}}
                                        {{--</td>--}}
                                        {{--@if(Auth::user()->hasRole('admin'))--}}
                                            {{--<td>--}}
                                                {{--{{ csrf_field()}}--}}
                                                {{--<a href=""--}}
                                                   {{--onclick="return confirm('Are you sure you want to delete this User?');">-</a>--}}
                                            {{--</td>--}}
                                        {{--@endif--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- Content Sec -->
        </div><!-- Page Container -->
    </div><!-- main -->
</div>
@include('admin/layouts.footer')
