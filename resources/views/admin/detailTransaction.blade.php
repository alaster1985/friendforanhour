@include('admin/layouts.header')
@include('admin/layouts.menu')
<div class="content-sec">
    <div class="container">
        <div class="title-date-range">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-title">
                        <h1>detail transaction (ID = {{$transaction->id}}) for <a
                                    href="{{Request::root()}}/profile?prf={{$transaction->profile_id}}">{{$transaction->profile->first_name. ' ' . $transaction->profile->second_name}}</a>
                        </h1>
                    </div>
                    <a href="viewProfileTransactions?prf={{$transaction->profile_id}}">transactions section</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="masonary-grids">
                <div class="col-md-12">
                    <div class="widget-area">
                        <div class="wizard-form-h">
                            <h2 class="StepTitle">Transaction</h2>
                            @if ($errors)
                                <div class="error" style="display: block">{{($errors->first())}}</div>
                            @endif
                            <div id="details">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="inline-form">
                                            <label class="c-label">CRC_signature</label>
                                            <input class="input-style" disabled name="crc_signature_value"
                                                   value="{{$transaction->crc_signature_value}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="inline-form">
                                            <label class="c-label">ME_CRC_signature</label>
                                            <input class="input-style" disabled name="me_crc_signature_value"
                                                   value="{{$transaction->me_crc_signature_value}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="inline-form">
                                            <label class="c-label">InvoiceID</label>
                                            <input class="input-style" disabled name="inv_id"
                                                   value="{{$transaction->inv_id}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="inline-form">
                                            <label class="c-label">Accepted</label>
                                            <input class="input-style" disabled name="accepted"
                                                   value="{{$transaction->accepted ? 'ACCEPTED' : 'REJECTED'}}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="inline-form">
                                            <label class="c-label">Request_json</label>
                                            <textarea class="input-style" disabled
                                                      name="request_json">{{$transaction->request_json}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                @if($transaction->manual_access_reason)
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="inline-form">
                                                <label class="c-label">Giving Access Moderator</label>
                                                <input class="input-style" disabled
                                                       value="{{$transaction->user->name}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="inline-form">
                                                <label class="c-label">Manual Access Reason</label>
                                                <textarea class="input-style"
                                                          disabled>{{$transaction->manual_access_reason}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">Created at</label>
                                        <input class="input-style" disabled
                                               name="created_at" value="{{$transaction->created_at}}"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">Updated at</label>
                                        <input class="input-style" disabled
                                               name="updated_at" value="{{$transaction->updated_at}}"/>
                                    </div>
                                </div>
                            </div>
                            <div id="accessData" style="display: none">
                                <form action="{{Route('addTransaction')}}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="profile_id" value="{{$transaction->profile_id}}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="inline-form">
                                                <label class="c-label">Your login (email)</label>
                                                <input class="input-style" type="text" name="login" value="{{old('login')}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="inline-form">
                                                <label class="c-label">Your password</label>
                                                <input class="input-style" type="password" name="password"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="inline-form">
                                                <label class="c-label">Reason to add 1/MO access</label>
                                                <textarea class="input-style" type="text" name="reason">{{old('reason')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="inline-form">
                                                <button type="submit" class="btn btn-success">ADD 1/MO ACCESS
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <div class="inline-form">
                                    <div id="add1moAccess" type="button">ADD 1/MO ACCESS</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-success" align="center">
                {{ session()->get('message') }}
            </div>
        @endif
    </div>
</div>
@include('admin/layouts.footer')