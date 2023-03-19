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
                            <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp;Payments</h3>
                        </div>
                      <form id="quickForm" action="{{url('admin/ca_payment')}}"   method="POST" enctype="multipart/form-data">
                           @csrf
                            <div class="row m-2">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Customer Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Customer Email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Status">Payment Status</label>
                                            <select name="cars" id="cars" class="form-control">
                                              <option value="">select...</option>
                                              <option value="0">Unpai</option>
                                              <option value="1">Paid</option>
                                              
                                              <option value="3">Not Update</option>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Status">Select Product</label>
                                            <select name="service_id" id="service_id" class="form-control teg mt-1" >
                                                <option value="" >Select Service Name</option>
                                                @if(!empty(getService()))
                                    		    @foreach (getService() as $service)
                                    		      	<option value="{{$service->id}}"  <?php if (isset($_POST['service_id']) && !empty($_POST['service_id'])){ echo ($service->id == $_POST['service_id']) ? 'selected' : '' ;} ?> >{{$service->name}}</option>
                                    		  
                                    		   @endforeach
                                    		   @endif
                                        </select>
                                    </div>
                                </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Invoice Number</label>
                                        <input type="email" class="form-control " id="invoice_number" name="invoice_number" placeholder="Invoice Number">
                                        
                                    </div>
                                    
                                </div>
                              
                               <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Form Date</label>
                                        <input type="date" class="form-control " id="form_date" name="form_date" placeholder="Form Date"  value="<?php if (isset($_POST['form_date']) && !empty($_POST['form_date'])){ echo $_POST['form_date'];}?>">
                                    </div>
                                    
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>To Date</label>
                                        <input type="date" class="form-control " id="to_date" name="to_date" placeholder="To Date" value="<?php if (isset($_POST['to_date']) && !empty($_POST['to_date'])){ echo $_POST['to_date'];}?>">
                                    </div>
                                    
                                </div>
                                
                                     <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Order Id</label>
                                        <input type="email" class="form-control "  name="order_id" placeholder="Order Id">
                                        
                                    </div>
                                    
                                </div>
                                
                                   <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Status">Invoice Status</label>
                                            <select name="invoice_status" id="invoice_status" class="form-control">
                                              <option value="">select...</option>
                                              <option value="0" <?php if (isset($_POST['invoice_status']) && !empty($_POST['invoice_status'])){ echo (0 == $_POST['invoice_status']) ? 'selected' : '' ;} ?> >All</option>
                                              <option value="1" <?php if (isset($_POST['invoice_status']) && !empty($_POST['invoice_status'])){ echo (1 == $_POST['invoice_status']) ? 'selected' : '' ;} ?> >Approved</option>
                                              <option value="2" <?php if (isset($_POST['invoice_status']) && !empty($_POST['invoice_status'])){ echo (2 == $_POST['invoice_status']) ? 'selected' : '' ;} ?> >Denied</option>
                                              <option value="0" <?php if (isset($_POST['invoice_status']) && !empty($_POST['invoice_status'])){ echo (0 == $_POST['invoice_status']) ? 'selected' : '' ;} ?> >Not Update</option>
                                            </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-success btn-lg"> Save </button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                      <div class="col-12" style="text-align: right;">
                          <button type="button" class="btn btn-success " data-toggle="modal" data-target="#InvoiceUpload" >Invoice Upload</button>
                      </div>
                     <div class="col-12">
                                <table id="example1" class="table table-bordered table-hover dataTable dtr-inline table-responsive text-nowrap no-footer">
                                    <thead>
                                        <tr role="row">
                                             <th>ORDER ID</th>
                                             <th>Status</th>
                                             <th>Customer Email</th>
                                             <th>Service Name</th>
                                             <th>Reimbursement Amount</th>

                                            <th>Upload</th>
                                            <th>Invoice Number</th>
                                            <th>Invoice Document</th>
                                            <th>Invoice Status</th>
                                            <th>Payment Status</th>
                                            <th>Private Comment</th>
                                        </tr>
                                    </thead>

                                    <tbody class="product_list_show">
                                          @if(!empty($data))
                                            @php
                                                $i=1;
                                               
                                            @endphp
                                  @foreach($data as $key => $value)
                                    @php
                                        $invoice_number = DB::table('order_reimbursements')->where('order_id', $value->id)->orderBy('id','DESC')->first(['srn_number','files']);     
                                    @endphp
                                        <tr>
                                            <!--<td>{{ $i++}}</td>-->
                                            <td>
                                                <input type="checkbox" class="order-item-select-box payement_click" order_id="{{$value['id'] ?? ''}}" data-value="view"  {{ ( $value->invoice_status == 1) ? 'disabled' : '' }} >
                                                <a href="{{  url('admin/ca_view_order')}}/{{$value->id}}" >{{$value['order_no'] ?? ''}}</a></td>
                                            <td>{{$value['status_name'] ?? ''}}</td>
                                            <td>{{$value['user_email'] ?? ''}}</td>
                                            <td>{{$value['service_name'] ?? ''}}</td>
                                            <td>{{$value['reimbursement_amt']}}</td>
                                            <td>
                                                <div class="upload-button medium-12 columns ">
                                                     <div class="form-group">
                                                         <button type="button" class="btn btn-primary order_id" data-id="{{$value->id}}" data-toggle="modal" data-target="#gridSystemModal">Reimbursement Upload</button>
                                                    </div>
                                                </div>
                                                
                                            </td>
                                            <td>{{$value->invoice_number ?? 'NOT UPLOADED'}}</td>
                                            <td><a href="{{url('admin/downloadInvoice/')}}/{{$value->id ?? ''}}">Download</a></td>
                                            <td>
                                               @if($value->invoice_status == 0)
                                                         Not Update
                                                         @elseif($value->invoice_status == 1)
                                                         Approved
                                                         @else
                                                         Denied
                                                         @endif
                                            </td>
                                           <td>
                                                         @if($value->payment_status == 0)
                                                         Not Update
                                                         @elseif($value->payment_status == 2)
                                                         Paid
                                                         @else
                                                         Unpaid
                                                         
                                                         @endif
                                           </td>
                                           <td>
                                               {{$value->private_comment}}
                                               
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
    </section>
</div>
<script>
var URL  = "{{ url('/') }}/admin";
    $('.order_id').click(function() {
        
    var order_id = $(this).data('id'); 

    $('#order_id1').val(order_id); 
    AllReimbursement(order_id);
  
  } );
  
  
  function AllReimbursement(order_id){
      $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: URL + '/acknowledgementAllView',
                data: { order_id: order_id},
                //dataType: 'json',
                success: function (response) {
                      $('#oldData').html(response); 

                }
            });
  };
  

$(".payement_click").on("click", function(){
  var classLengthss = $(".payement_click").length;
 
var arrssView = [];
 
$('.payement_click').each(function(index) {
 var valuess = $('.payement_click').eq(index).attr('data-value');
var idss = $('.payement_click').eq(index).attr('order_id');
     if($('.payement_click').eq(index).prop('checked'))
     {
         
      
              arrssView.push(idss);
         
         
        
     }
});

$('#order_id').val(arrssView);

});
</script>


<div id="gridSystemModal" class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="gridModalLabel">Reimbursement Upload</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
          <div id="oldData"></div>
           <form id="quickForm" action="{{route('admin.reimbursementUpload')}}"   method="POST" enctype="multipart/form-data">
                           @csrf
        <div class="row ">
            <input type="hidden" id="order_id1" name="order_id" >
            <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>SRN Number</label>
                    <input type="text" class="form-control" id="srn_number" name="srn_number" placeholder="SRN Number">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label></label>
                    <input type="file" class="form-control" id="documents_file" name="documents_file">
                </div>
            </div>
            
            
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save </button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
 
<div id="InvoiceUpload" class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="InvoiceUpload" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="InvoiceUpload">Invoice Upload</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
           <form id="quickForm" action="{{route('admin.InvoiceUpload')}}"   method="POST" enctype="multipart/form-data">
                           @csrf
        <div class="row ">
            <input type="hidden" id="order_id" name="order_id" >
            <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount" placeholder="Amount">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Invoice Number</label>
                    <input type="text" class="form-control" id="invoice_number" name="invoice_number" placeholder="Invoice Number">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label></label>
                    <input type="file" class="form-control" id="documents_file" name="documents_file">
                </div>
            </div>
            
            
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save </button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
<style>
    input[type="checkbox"]::after {
    position: relative;
    content: "";
    width: 21px;
    height: 21px;
    top: -1px;
    left: 0;
    background: #fff;
    border-radius: 50%;
    box-shadow: 0 0 5px rgb(0 0 0 / 20%);
    transform: scale(1.1);
    transition: 0.4s;
}
input[type="checkbox"] {
    position: initial;
    appearance: auto;
    width: 25px;
    height: 20px;
    background: #ccc0;
    border-radius: 50px;
    box-shadow: inset 0 0 0px rgb(0 0 0 / 20%);
    cursor: pointer;
    transition: 0.4s;
}
</style>
@endsection