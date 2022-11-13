@extends('layouts.master')
@section('title')
    Edit Ad
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
   Edit Ad
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                {{Form::open([
                    'method'=>'put',
                    'route'=>['handleEditAd',$ad->id],
                    'id'=>'form',
                     'enctype'=>'multipart/form-data',
                ])}}
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="card-title text-center">Edit Ad</h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <div class="form-group row">
                                            <div class="col-sm-3 font-weight-bolder col-form-label">
                                                <label for="name">{{__('trans.title')}}<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="text" id="title" class="form-control"
                                                       value="{{$ad->title}}"
                                                       name="title" placeholder="{{__('trans.title')}}">
                                                <span class="text-danger error_span"
                                                      id="name_error"></span>
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
                                                    <option value="">-- NONE --</option>
                                                    @foreach($users as $user)
                                                        <option @if($user->id == $ad->user_id) selected @endif
                                                        value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger error_span"
                                                      id="batch_id_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2" id="active_section">
                                        <div class="form-group row">
                                            <div class="col-sm-3 font-weight-bolder col-form-label">
                                                <label for="activites">Active</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <select name="active" class="form-control">
                                                    @foreach($activites ?? [] as $active)
                                                        <option value="{{$active}}">{{$active}}</option>
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
                                    <div class="col-12 mb-2">
                                        <div class="form-group row">
                                            <div class="col-sm-3 font-weight-bolder col-form-label">
                                                <label for="start_date">{{__('trans.date')}}<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="date" id="start_date" class="form-control start_date"
                                                       value="{{$ad->start_date}}"
                                                       name="start_date" placeholder="{{__('trans.date')}}">
                                                <span class="text-danger error_span"
                                                      id="date_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="form-group row">
                                            <div class="col-sm-3 font-weight-bolder col-form-label">
                                                <label for="end_date">{{__('trans.date')}}<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input type="date" id="end_date" class="form-control date"
                                                       value="{{$ad->end_date}}"
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
                                        {{__('trans.update')}}
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
