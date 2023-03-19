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
                            <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Referral  Setting</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/wallet_settings') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                        <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                            </div>

                        </div>
                  {!! Form::model($data, ['method' => 'PATCH','files' => true,'route' => ['admin.wallet_settings.update', $data->id]]) !!}
                  @csrf
                 <div class="card-body">
        
           
               
                    <div class="row">
                                 
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Refer Form Amount By (%)<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('refer_form_amount') is-invalid @enderror "  id="refer_form_amount" name="refer_form_amount" placeholder="Refer Form Amount By (%)" value="{{old('refer_form_amount') ?? $data['refer_form_amount'] }}">
                                        @error('refer_form_amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Refer To Amount By (%)<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('refer_to_amount') is-invalid @enderror" id="refer_to_amount" name="refer_to_amount" placeholder="Refer To Amount By (%)" value="{{old('refer_to_amount') ?? $data['refer_to_amount'] }}">
                                        @error('refer_to_amount')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>From Range Amount<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('amount_range_from') is-invalid @enderror" id="amount_range_from" name="amount_range_from" placeholder="From Range Amount" value="{{old('amount_range_from') ?? $data['amount_range_from'] }}">
                                        @error('amount_range_from')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>To Range Amount<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('amount_range_to') is-invalid @enderror" id="amount_range_to" name="amount_range_to" placeholder="To Range Amount" value="{{old('amount_range_to') ?? $data['amount_range_to'] }}">
                                        @error('amount_range_to')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                               
                                
                            
                 
                     <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">Update </button>
                     </div>
                 
                  {!! Form::close() !!}
                        
                
            </div>
            
            
            
        </div>


               </div>
            </div>
         </div>
      </div>
   </section>
</div>


@endsection


