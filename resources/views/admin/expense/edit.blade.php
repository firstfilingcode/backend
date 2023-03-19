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
                     <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Edit Expense</h3>
                     <div class="card-tools">
                        <a href="{{url ('admin/expense') }}" class="btn bbtn-warning text-white btn-sm"><i
                           class="fa fa-eye"></i> View</a>
                           
                           <a href="{{ URL::previous() }}" class="btn bbtn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                     </div>
                  </div>
                  {!! Form::model($data, ['method' => 'PATCH','files' => true,'route' => ['admin.expense.update', $data->id]]) !!}
                  @csrf
                  <div class="row m-2">
                     <div class="col-md-3">
                        <label style="color:red;">Expense Name*</label>
                        <input type="text" class="form-control" placeholder="Expanse Name" id="expense_name" name="expense_name" value="{{ $data->expense_name ?? '' }}">
                        @error('expense_name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror                  			
                     </div>
                     <div class="col-md-3">
                        <label style="color:red;">Date*</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ $data->date ?? '' }}" >
                        @error('date')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror                  			
                     </div>
                     <div class="col-md-3">
                        <label style="color:red;">Quantity*</label>
                        <input type="text" class="form-control" onBlur="calculateAmount(this.value,0);" placeholder="Quantity" id="quantity_0" name="quantity" onkeypress="javascript:return isNumber(event)" value="{{ $data->quantity ?? '' }}" >
                        @error('quantity')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror                  			
                     </div>
                     <div class="col-md-3">
                        <label style="color:red;">Rate*</label>
                        <input type="text" class="form-control" onBlur="calculateAmount(this.value,0);" placeholder="Rate" id="rate_0" name="rate" onkeypress="javascript:return isNumber(event)" value="{{ $data->rate ?? '' }}" >
                        @error('rate')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror                  			
                     </div>
                     <div class="col-md-3 mt-3">
                        <label style="color:red;">Total Amount*</label>
                        <input type="text" class="form-control amount" onblur="calculateSum()" placeholder="Amount" id="total_amt" name="total_amt" value="{{ old('amount') }}" required>
                        @error('total_amt')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     <div class="col-md-3 mt-3">
                        <label style="color:red;">Attachment*</label>
                        <input type="file" class="form-control"  id="attachment" name="attachment" value="{{ $data->attachment ?? '' }}" >
                        @error('attachment')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  
                                <div class="row m-2">
                                <div class="col-md-2 mt-2">
                                    <label for="switch1" data-on-label="Active" data-off-label="Inactive">Status</label>
                                    <div class="check-box mt-2">
                                     <input value="1"  name="status" type="checkbox" id="switch1" switch="none" checked/>
                                    </div>
                                    @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                
                                
                            </div>     
                  <div class="row mt-4 mb-3">
                     <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">Update </button>
                     </div>
                  </div>
                  {!! Form::close() !!}
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
@endsection

<script>
    function calculateAmount(value,row_id) {
       
        var quantity = $('#quantity_0').val();
        var rate = $('#rate_0').val();
    
        var amount = quantity * rate;
    
        $('#amount_0').val(amount);
        
    };  ipt>
</script>
