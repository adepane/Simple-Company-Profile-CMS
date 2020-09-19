@extends('panel.layouts.apps')
@include('panel.users.submenu')
@section('content')
<link rel="stylesheet" href={!! asset("jsUpload/css/jquery.fileupload.css") !!}>
<div class="kt-portlet kt-portlet--mobile">
    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <ul>
            <li>{{ $error }}</li>
        </ul>
        @endforeach
    </div>
    @endif
    <form class="kt-form kt-form--label-right" id="f_addgenerator" action="{{ route('users.update',$data->id) }}" method="POST"
        enctype="multipart/form-data">
        @method("patch")
        {{csrf_field()}}
        <input type="hidden" name="lastState" value="{{ url()->previous() }}">
        <div id="tags_group"></div>
        <div class="kt-portlet__body">
            <div class="form-group form-group-last">
                <div class="alert alert-secondary" role="alert">
                    <div class="alert-icon"><i class="flaticon-edit kt-font-brand"></i></div>
                    <div class="alert-text">
                        Edit Profile
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label class="label-form-control col-2" for="slug" id="label-slug">Full Name</label>
                <div class="col-8">
                    <input class="form-control" type="text" value="{{ $data->name }}" id="name" name="name" />
                </div>
            </div>
            
            <div class="form-group row">
                <label class="label-form-control col-2" for="slug" id="label-slug">Username</label>
                <div class="col-8">
                    <input class="form-control" type="text" value="{{ $data->username }}" id="username" name="username" />
                </div>
                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            
            <div class="form-group row">
                <label class="label-form-control col-2" for="slug" id="label-slug">E-mail</label>
                <div class="col-8">
                    <input class="form-control" type="email" value="{{ $data->email }}" id="email" name="email" />
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            
            <div class="form-group row">
                <label class="label-form-control col-2" for="slug" id="label-slug">Password</label>
                <div class="col-8">
                    <input class="form-control" type="password" value="" id="password" name="password" />
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            
            <div class="form-group row">
                <label class="label-form-control col-2" for="slug" id="label-slug">Re-Password</label>
                <div class="col-8">
                    <input class="form-control" type="password" value="" id="password_confirmation" name="password_confirmation" />
                </div>
            </div>
            
            <div class="form-group row">
                <label class="label-form-control col-2" for="slug" id="label-slug">Profile</label>
                <div class="col-8">
                    <input class="form-control" type="text" value="{{ $data->id_profile }}" id="id_profile" name="id_profile" />
                </div>
            </div>

        </div>

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-10">
                        <button class="btn btn-success" type="submit">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
@endsection