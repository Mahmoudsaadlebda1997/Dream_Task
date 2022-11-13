@extends('layouts.master')
@section('title')
    AllAds
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <style>
        .select2-container .select2-selection--single {
            height: 43px;
        }
    </style>
@endsection
@section('title_1')
    All Ads
@endsection
@section('content')
    {{-- content html --}}
    <div class="container-fluid">
        <main class="main-content mt-1 border-radius-lg">
            <div class="">
                <div class="row">
                    <div class="col-12 mt-2">
                            <div class="card-body">
                                <a class="btn btn-primary"
                                   href="{{route('getCreateAd')}}">{{__('trans.new')}}</a>
                                <div class="table-responsive">
                                    <table class="table border-danger table-vertical-center" id="table">
                                        <thead>
                                        <tr>
                                            <th width="20">
                                                id</th>
                                            <th>title</th>
                                            <th>User_Name</th>
                                            <th>Start_Date</th>
                                            <th>End_date</th>
                                            <th>Image</th>
                                            <th>Active</th>
                                            <th width="250">{{__('trans.operation')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($ads as $k=>$ad)
                                                <td>
                                                    {{$ad->id}}
                                                </td>
                                                <td>{{$ad->title}}</td>
                                                <td>{{$ad->user->name}}</td>
                                                <td>{{$ad->start_date}}</td>
                                                <td>{{$ad->end_date}}</td>
                                                <td> <img src=" {{asset('public/storage/' . $ad->ad_image)}}" alt="" width="70px" height="70px"> </td>

                                                <td>
                                                    @if($ad->active ==0)
                                                    <div class="btn-danger mt-3 text-center w-100 fa-1x"> NotActive</div>
                                                    @else
                                                    <div class="btn-success mt-3 text-center w-100"> Active</div>
                                                    @endif
                                                </td>
                                                <td class="">
                                                        <a style="margin:10px" href="{{route('getEditAd',['id'=>$ad->id])}}"
                                                           data-toggle="tooltip" data-placement="top"
                                                           title="{{__('trans.edit')}}"
                                                           class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1">
                                                           <span class="svg-icon svg-icon-md svg-icon-primary"><!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg--><svg
                                                                   xmlns="http://www.w3.org/2000/svg"
                                                                   xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                   width="24px" height="24px" viewBox="0 0 24 24"
                                                                   version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                                    <path
                                                                        d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                                        fill="#000000" fill-rule="nonzero"
                                                                        transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>
                                                                    <path
                                                                        d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                                        fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                                </g>
                                                            </svg><!--end::Svg Icon--></span>
                                                        </a>
                                                        <a style="margin:10px"  data-toggle="tooltip" data-placement="top"
                                                                title="{{__('trans.delete')}}"
                                                           href="{{route('deleteAd',['id'=>$ad->id])}}"
                                                                class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1">
                                                        <span class="svg-icon svg-icon-md svg-icon-primary"><!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg--><svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <path
            d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
            fill="#000000" fill-rule="nonzero"></path>
        <path
            d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
            fill="#000000" opacity="0.3"></path>
    </g>
</svg><!--end::Svg Icon--></span>
                                                        </a>
                                                </td>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
@section('scripts')
@endsection
