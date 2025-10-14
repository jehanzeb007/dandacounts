@extends('layouts.admin')
@section('page-title')
    {{__('Manage Advance Borrrow')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Advance Borrrow')}}</li>
@endsection

@section('action-btn')
<div class="d-flex">
     @can('create goal')
            <a href="#" data-url="{{ route('advanceborrow.create') }}" data-bs-toggle="tooltip" data-size="lg" title="{{__('Create')}}" data-ajax-popup="true" data-title="{{__('Create New Advance Borrrow')}}" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
    @endcan
</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="card">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <div class="theme-avtar bg-primary v">
                        <i class="ti ti-report-money"></i>
                    </div>
                    <p class="text-muted text-sm mt-4 mb-2">Total</p>
                    <h6 class="mb-3 "><a href="#" class="text-primary">Paid Advance Borrrow</a></h6>
                    <h3 class="mb-0 text-primary">{{\Auth::user()->priceFormat($paidTotal)}}

                    </h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="card">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <div class="theme-avtar bg-warning v">
                        <i class="ti ti-file-invoice"></i>
                    </div>
                    <p class="text-muted text-sm mt-4 mb-2">Total</p>
                    <h6 class="mb-3 "><a href="#" class="text-warning">Unpaid Advance Borrrow</a></h6>
                    <h3 class="mb-0 text-warning">{{\Auth::user()->priceFormat($unpaidTotal)}}

                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style
">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th> {{__('Reference')}}</th>
                                <th> {{__('Date')}}</th>
                                <th> {{__('Amount')}}</th>
                                <th> {{__('Account')}}</th>
                                <th> {{__('Category')}}</th>
                                <th> {{__('Status')}}</th>
                                <th width="10%"> {{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($advanceBorrows as $advanceBorrow)
                                <tr>
                                    <td class="font-style">{{ $advanceBorrow->reference }}</td>
                                    <td class="font-style">{{  \Auth::user()->dateFormat($advanceBorrow->date) }}</td>
                                    <td class="font-style">{{ \Auth::user()->priceFormat($advanceBorrow->amount) }}</td>
                                    <td class="font-style">{{ $advanceBorrow->bankAccount->bank_name.' '.$advanceBorrow->bankAccount->holder_name }}</td>
                                    <td class="font-style">{{ $advanceBorrow->category->name }}</td>
                                    <td class="font-style">
                                        @if($advanceBorrow->status == 'Paid')
                                            <span class="badge bg-success">Paid</span>
                                        @else
                                            <span class="badge bg-warning">Unpaid</span>
                                        @endif
                                        </td>
                                    <td class="Action">
                                        <span>
                                        @can('edit goal')
                                        <div class="action-btn me-2">
                                            <a href="#" class="mx-3 btn btn-sm align-items-center bg-info" data-url="{{ route('advanceborrow.edit',$advanceBorrow->id) }}" data-ajax-popup="true" data-title="{{__('Edit Goal')}}" data-bs-toggle="tooltip" title="{{__('Edit')}}" data-original-title="{{__('Edit')}}">
                                                <i class="ti ti-pencil text-white"></i>
                                            </a>
                                        </div>
                                            @endcan
                                            @can('delete goal')
                                            <div class="action-btn">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['advanceborrow.destroy', $advanceBorrow->id],'id'=>'delete-form-'.$advanceBorrow->id]) !!}
                                                <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para  bg-danger" data-bs-toggle="tooltip" title="{{__('Delete')}}" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$advanceBorrow->id}}').submit();">
                                                    <i class="ti ti-trash text-white"></i>
                                                </a>
                                                {!! Form::close() !!}
                                            </div>
                                            @endcan
                                        </span>
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
@endsection
