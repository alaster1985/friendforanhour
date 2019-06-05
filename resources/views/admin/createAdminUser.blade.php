@include('admin/layouts.header')
@include('admin/layouts.menu')
<div class="content-sec">
    <div class="container">
        <div class="title-date-range">
            <div class="row">
                <div class="col-md-6">
                    <div class="main-title">
                        <h1>Create admin user</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <form action="{{Route('addAdminUser')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="masonary-grids">
                    <div class="col-md-12">
                        <div class="widget-area">
                            <div class="wizard-form-h">
                                <h2 class="StepTitle">ADMIN USER</h2>
                                @if ($errors)
                                    <div class="error" style="display: block">{{($errors->first())}}</div>
                                @endif
                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">User name</label>
                                        <input class="input-style" name="name" value="{{old('name')}}"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">User email</label>
                                        <input class="input-style" name="email" value="{{old('email')}}"/>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="inline-form">
                                        <label class="c-label">Role</label>
                                        <select name="role">
                                            @foreach($roles as $role)
                                                <option id="{{$role->id}}" value="{{$role->id}}">{{$role->name}}</option>
                                                @if($role->id === 2)
                                                    <script>document.getElementById({{$role->id}}).selected = true</script>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="inline-form">
                                        <label class="c-label">password</label>
                                        <input class="input-style" type="password" name="password" value=""/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="inline-form">
                                        <label class="c-label">confirm password</label>
                                        <input class="input-style" type="password" name="co_password" value=""/>
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