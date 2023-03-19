@extends('admin.layouts.app')
@section('title') @lang('translation.Dashboard')
@endsection @section('content')

<div class="content-wrapper">
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card card-outline card-orange">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">
                                <i class="fa fa-address-book-o"></i> &nbsp; {{ __('View
                                Wallet Settings') }}
                            </h3>
                            <div class="card-tools">
                                <!--<a href="{{url('admin/calendar/create')}}" class="btn btn-warning text-white btn-sm"><i-->
                                <!--        class="fa fa-plus"></i>{{ __('Add') }}</a>-->
                                        
                                        <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                               
                            </div>
                        </div>
                       <!--{!! Form::open(array('method'=>'get')) !!}-->
                        <div class="row m-2">
                          
                            <div class="col-12">
                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline">
                                    <thead>
                                        <tr role="row">
                                            <th>Sr.no</th>
                                            <th>User Wallte Use By %</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody class="product_list_show">
                                          @if(!empty($data))
                                            @php
                                                $i=1;
                                               
                                            @endphp
                                  @foreach($data as $key => $value)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$value['user_use_by'] ?? ''}}</td>
                                            
                                            <td class="d-flex">
                                                <a href="{{  url('admin\wallet_settings_edit',$value->id)  }}" class=" text-success ml-3" title="Edit Offer"><i
                                                        class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                        
                                                        
                                        
                                           
                                            </td>
                                           
                                        </tr>
                                         @endforeach
                            
                            @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



@endsection