@include('admin/layouts.header')
@include('admin/layouts.menu')
<div class="content-sec">
    <div class="container">
        <div class="title-date-range">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-title">
                        <h1>edit admin user</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        <form action="{{Route('updateAdminUser')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="masonary-grids">
                <div class="col-md-12">
                    <div class="widget-area">
                        <div class="wizard-form-h">
                            <h2 class="StepTitle">admin user</h2>
                            @if ($errors)
                                <div class="error" style="display: block">{{($errors->first())}}</div>
                            @endif
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <div class="col-md-4">
                                <div class="inline-form">
                                    <label class="c-label">User name</label>
                                    <input class="input-style" name="name" value="{{$user->name}}"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="inline-form">
                                    <label class="c-label">User email</label>
                                    <input class="input-style" name="email" value="{{$user->email}}"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="inline-form">
                                    <label class="c-label">Role</label>
                                    <select name="role">
                                        @foreach($roles as $role)
                                            <option id="{{$role->id}}" value="{{$role->id}}">{{$role->name}}</option>
                                            @if($role->id === $user->roles->first()->id)
                                                <script>document.getElementById({{$role->id}}).selected = true</script>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="inline-form">
                                    <label class="c-label">Created at</label>
                                    <input class="input-style" disabled
                                           name="created_at" value="{{$user->created_at}}"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="inline-form">
                                    <label class="c-label">Updated at</label>
                                    <input class="input-style" disabled
                                           name="updated_at" value="{{$user->updated_at}}"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="inline-form">
                                    <button type="submit" {{--disabled--}} class="btn btn-success">SAVE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-success" align="center">
                {{ session()->get('message') }}
            </div>
        @endif
    </div>
</div>
@include('admin/layouts.footer')