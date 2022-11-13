@extends('layouts.master')
@section('title')
    Create Ad
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .select2-container .select2-selection--single{
            height: 43px;
        }
    </style>
@endsection
@section('title_1')
    Add Add
@endsection
@section('content')
    {{-- content html --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                {{Form::open([
                    'method'=>'post',
                    'route'=>'handleCreateAd',
                    'id'=>'form',
                     'enctype'=>'multipart/form-data',
                ])}}
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title text-center">Add Ad</h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <div class="form-group row">
                                            <div class="col-sm-3 font-weight-bolder col-form-label">
                                                <label for="title">{{__('trans.title')}}<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input required type="text" id="title" class="form-control"
                                                       name="title" placeholder="{{__('trans.title')}}">
                                                <span class="text-danger error_span"
                                                      id="name_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group row">
                                            <div class="col-sm-3 font-weight-bolder col-form-label">
                                                <label for="ad_image">{{__('trans.image')}}<span
                                                        class="text-danger"></span></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="file" id="ad_image" class="form-control" accept="image/*"
                                                       name="ad_image" placeholder="{{__('trans.image')}}">
                                                <span class="text-danger error_span"
                                                      id="image_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2" id="city_section">
                                        <div class="form-group row">
                                            <div class="col-sm-3 font-weight-bolder col-form-label">
                                                <label for="users">User</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select id="users"
                                                        class="form-control" name="user_id">
                                                    <option  value="">-- NONE --</option>
                                                    @foreach($users as $user)
                                                        <option
                                                            value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger error_span"
                                                      id="batch_id_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group row">
                                            <div class="col-sm-3 font-weight-bolder col-form-label">
                                                <label for="start_date">Start Date<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="date" id="start_date" class="form-control date"
                                                       name="start_date" placeholder="{{__('trans.date')}}">
                                                <span class="text-danger error_span"
                                                      id="date_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group row">
                                            <div class="col-sm-3 font-weight-bolder col-form-label">
                                                <label for="end_date">End Date<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="date" id="end_date" class="form-control date"
                                                       name="end_date" placeholder="{{__('trans.date')}}">
                                                <span class="text-danger error_span"
                                                      id="date_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit"
                                        class="btn btn-primary mr-1 waves-effect waves-float waves-light">
                                    Save
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
