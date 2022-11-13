@extends('layouts.master')
@section('title')
    Create User
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
    Add User
@endsection
@section('content')
    {{-- content html --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                {{Form::open([
                    'method'=>'post',
                    'route'=>'handleCreateUser',
                    'id'=>'form',
                ])}}
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title text-center">{{__('trans.add_admin')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <div class="form-group row">
                                            <div class="col-sm-3 font-weight-bolder col-form-label">
                                                <label for="name">{{__('trans.name')}}<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input required type="text" id="name" class="form-control"
                                                       name="name" placeholder="{{__('trans.name')}}">
                                                <span class="text-danger error_span"
                                                      id="name_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group row">
                                            <div class="col-sm-3 font-weight-bolder col-form-label">
                                                <label for="email">{{__('trans.email')}}<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input required  type="text" id="email" class="form-control"
                                                       name="email"
                                                       placeholder="{{__('trans.email')}}">
                                                <span class="text-danger error_span"
                                                      id="email_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2" id="country_section">
                                        <div class="form-group row">
                                            <div class="col-sm-3 font-weight-bolder col-form-label">
                                                <label for="countries">Country</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select id="countries"
                                                        class="form-control" name="country_id">
                                                    <option  value="">-- NONE --</option>
                                                    @foreach($countries as $country)
                                                        <option
                                                            value="{{$country->id}}">{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger error_span"
                                                      id="batch_id_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2" id="city_section">
                                        <div class="form-group row">
                                            <div class="col-sm-3 font-weight-bolder col-form-label">
                                                <label for="citites">City</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select id="citites"
                                                        class="form-control" name="city_id">
                                                    <option value="">-- NONE --</option>
                                                    @foreach($cities as $city)
                                                        <option
                                                            value="{{$city->id}}">{{$city->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger error_span"
                                                      id="batch_id_error"></span>
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
