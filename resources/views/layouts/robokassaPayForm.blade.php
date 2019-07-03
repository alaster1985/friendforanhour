@if(Auth::check() && Auth::user()->hasRole('user'))
<div class="col-md-3" style="color: red; border: solid green 2px">
    <form action="https://merchant.roboxchange.com/Index.aspx" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display: none">
            {{$invId = strtotime('now')}}
        </div>
        <input name="MerchantLogin" type="hidden" value="{{env('ROBOKASSA_MERCHANTLOGIN')}}">
        <input name="OutSum" type="hidden" value="{{env('ROBOKASSA_OUTSUM')}}">
        <input name="InvId" type="hidden" value="{{$invId}}">
        <input name="IsTest" type="hidden" value="1">
        <input name="Desc" type="hidden" value="{{env('ROBOKASSA_INVDESC').'_ID_'.$invId}}">
        <input name="Shp_ProfileId" type="hidden" value="{{Auth::user()->profile_id}}">
        <input name="Shp_TransactionNameId" type="hidden" value="1">
        <input name="SignatureValue" type="hidden"
               value="{{md5(env('ROBOKASSA_MERCHANTLOGIN') . ":"
               . env('ROBOKASSA_OUTSUM') . ":". $invId .":"
               . env('ROBOKASSA_TEST_PASS1')
               . ":Shp_ProfileId=" . Auth::user()->profile_id
               . ":Shp_TransactionNameId=1")}}">
        <button id="payButton" type="submit">renew subscription</button>
    </form>
</div>
@endif