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
                        <h4 class="StepTitle">All bans for: <a
                                    href="{{Request::root()}}/profile?prf={{$profile->id}}">{{$profile->first_name . ' ' . $profile->second_name}}</a>
                        </h4>
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
                                    <th>Transaction description</th>
                                    <th>Amount (rub)</th>
                                    <th>Created_at</th>
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
                                        <td>
                                            {{$transaction->transactionName->description}}
                                        </td>
                                        <td>
                                            {{$transaction->getMoneyFormat()}}
                                        </td>
                                        <td>
                                            {{$transaction->created_at}}
                                        </td>
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