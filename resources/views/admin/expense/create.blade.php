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
                            <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Create Expense</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/expense') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                        <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                                <!--<a href="https://www.school.rukmanisoftware.com/account_dashboard" class="btn btn-primary  btn-sm"><i class="fa fa-arrow-left"></i> Back</a>-->
                            </div>

                        </div>
                       <form id="quickForm" action="{{route('admin.expense.store')}}"   method="POST" enctype="multipart/form-data">
                           @csrf
                            <div class="row m-2">
                                <div class="col-md-12">
                                 <table class="_table" id="tableId"style="width:100%">
                                    <thead>
                                        
                                      <tr>
                                        <th class="text-danger">Expense Name*</th>
                                        <th class="text-danger">Date*</th>
                                        <th class="text-danger">Quantity*</th>
                                        <th class="text-danger">Rate*</th>
                                        <th class="text-danger">Total*</th>
                                        <th class="text-danger">Attach Document*</th>
                 
                                      </tr>
                                    </thead>
                                    <tbody id="table_body">
                                      <tr id="box2" >
                                          <td>
                                          <input type="text" class="form-control" placeholder="Expanse Name" id="expense_name" name="expense_name" value="{{ old('expense_name') }}" required>
                                        </td>
                                        <td>
                                            <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d') }}" required>
                                        </td>
                                        
                                        <td>
                                          <input type="text" class="form-control" onBlur="calculateAmount(this.value,0);" placeholder="Quantity" id="quantity_0" name="quantity" onkeypress="javascript:return isNumber(event)" value="{{ old('quantity') }}" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" onBlur="calculateAmount(this.value,0);" placeholder="Rate" id="rate_0" name="rate" onkeypress="javascript:return isNumber(event)" value="{{ old('rate') }}" required>
                                        </td>
                                        <td>
                                           <input type="text" class="form-control amount" onblur="calculateSum()" placeholder="Amount" id="amount_0" name="amount" value="{{ old('amount') }}" Readonly required>
                                        </td>
                                        <td>
                                           <input id="thumbnail" class="form-control mt-1" type="file" name="attachment">
                                        </td>
                                        <td>
                                          <div class="action_container">
                                            <!--<a class="danger" onclick="remove_tr(this)">-->
                                            <!--  <i class="fa fa-close"></i>-->
                                                <button type="button" class="addmoreprodtxtbx btn btn-success" id="clonebtn"  ><i class="fa fa-plus-square"></i></button>
                                                <button type="button" id="removerow" class="removeprodtxtbx btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </a>
                                          </div>
                                        </td>
                                      </tr>
                                    </tbody>
                                     
                                </table>
                                </div>
                                
                                
                                <div class="col-md-3 mt-3">
                                    <div class="form-group">
                                       <label class="text-danger"><b>Total Amount*</b></label>
                                        <input type="text" class="form-control" placeholder="Total Amount" id="total_amt" name="total_amt" value="" value="{{ old('total_amt') }}"Readonly>
                                        @error('total_amt')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <div class="form-group">
                                        <label><b>Description</b></label>
                                            <textarea type="text" id="description" name="description" class="form-control" placeholder="Description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                
                                
                                <div class="col-md-3"></div>
                                
                                
                                </div>
                                
                            <div class="row m-2">
                                <div class="col-md-2 mt-2">
                                    <label for="switch1" data-on-label="Active" data-off-label="Inactive">Status</label>
                                    <div class="check-box mt-2">
                                     <input value="1"  name="status" type="checkbox" id="switch1" switch="none" checked/>
                                    </div>
                                    @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                
                                
                            </div>
                            <div class="row m-2">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-success btn-lg pl-3 pr-3">Save</button>
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

<script>
    
$(document).ready(function() {
 $('#trColor tr').click(function() {
   $(this).css('backgroundColor', '#6639b5c4');
  $( this ).siblings().css( "background-color", "white" );
});
    
    count=0;
      $( ".removeprodtxtbx" ).eq( 0 ).css( "display", "none" );
    $(document).on("click", "#clonebtn", function() {
       count++;
        //we select the box clone it and insert it after the box
        $('#box2').addClass('rowTr')
        $('#box2').clone().appendTo('#table_body')
       $('.rowTr').last().addClass('rowTr1')
       //  $('#box2').find('#removerow').addClass("buttondel")
          
   
        // $('.buttondel').css('visibility', 'visible')
      
         $( ".removeprodtxtbx" ).eq( count ).css( "display", "block" );
         $( ".addmoreprodtxtbx" ).eq( count ).css( "display", "none" );
         $( ".pay_amt" ).eq( count ).val("");
          
    });
    
    $(document).on("click", "#removerow", function() {
        $(this).parents("#box2").remove();
        $('#removerow').focus();
        count--;
    });
    
      $(document).on("click", "#closeModal", function() {
$( "tr" ).remove( ".rowTr1" );
 $( ".pay_amt" ).val("");
 $( "#pay_amt" ).val("");
count=0;
    });
    
    
    
    
   
});
</script>

<script>
   
    function calculateAmount(value,row_id) {
       
        var quantity = $('#quantity_'+row_id).val();
        var rate = $('#rate_'+row_id).val();
    
        var amount = quantity * rate;
    
        $('#amount_'+row_id).val(amount);
        calculateSum();
    };    
 function calculateSum() {
        var sum = 0;
        $(".amount").each(function() {
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseFloat(this.value);
            }
        });
    
        $("#total_amt").val(sum.toFixed(2));
    }
        
</script>
@endsection