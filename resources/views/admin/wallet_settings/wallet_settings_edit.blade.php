@extends('admin.layouts.app')
@section('title') @lang('translation.Dashboard') @endsection
@section('content')

<div class="content-wrapper" style="min-height: 222px;">
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card card-outline card-orange">
                        <div class="card-header bg-primary">
                            <h3 class="card-title"><i class="fa fa-edit"></i> &nbsp; Edit Wallet Settings</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/wallet_settings') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                            </div>

                        </div>
                          <form id="quickForm" action="{{url('admin/wallet_settings_edit')}}/{{($data->id)}}"   method="POST" enctype="multipart/form-data">
                           @csrf
                            <div class="row m-2">
                             
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>User Wallte Use By %<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('user_use_by') is-invalid @enderror @error('user_use_by') is-invalid @enderror mt-1" id="user_use_by" name="user_use_by" placeholder="User Wallte Use By %" value="{{old('user_use_by') ?? $data['user_use_by'] }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row m-2">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-success pl-3 pr-3">Update</button>
                                </div>
                            </div>
                      </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection