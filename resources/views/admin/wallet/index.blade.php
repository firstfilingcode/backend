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
                                <i class="fa fa-address-book-o"></i> &nbsp; {{ __('Wallet
                                ') }}
                            </h3>
                            
                            <div class="card-tools">
                                <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                            </div>
                        </div>

                        <div class="row m-2">
                            <div class="col-12">
                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline">
                                    <thead>
                                        <tr role="row">
                                            <th>Sr.no</th>
                                            <th>Name</th>
                                             <th>Mobile No.</th>
                                            <th>Amount</th>
                                            <th>Status</th>
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
                                            <td>{{$value['userData']['name'] ?? ''}}</td>
                                            <td>{{$value['userData']['mobile'] ?? ''}}</td>
                                            <td>{{$value['amount'] ?? ''}}</td>
                                            
                                             <td>
                                                 @if($value->status==0)
                                              
                                                	<button data-toggle="modal" data-target="#Modal_id" data-id="{{ $value->id }}" data-name="Active" class="btn btn-success btn-sm btn-soft-success waves-effect waves-light sa-params wallet_status" style ="display:inline">Active</button>
                                             
               								@else
               								  
                                                	<button data-toggle="modal" data-target="#Modal_id" data-id="{{ $value->id }}" data-name="Inactive" class="btn btn-danger btn-sm btn-soft-danger waves-effect waves-light wallet_status" style ="display:inline">Inactive</button>
                                               
            								@endif
                                                
                                            </td>
                                            <td class="d-flex">
                                                <a href="{{  route('admin.wallet.show',$value->id)  }}" class=" text-danger btn-xs ml-3" title="Show Blog"><i
                                                        class="fa fa-eye"></i></a>
                                               
                                            
                                              
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

<script>
    $('.wallet_status').click(function() {
    var wallet_id = $(this).data('id'); 
    var status_name = $(this).data('name');
  
    $('#status_name').val(status_name); 
  $('#wallet_id').val(wallet_id); 
  } );
</script>
<!-- The Modal -->
<div class="modal" id="Modal_id">
    <div class="modal-dialog">
        <div class="modal-content bg_color">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-white">{{ __('Change status') }}</h4>
                <button type="button" class="btn-close" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>

            <!-- Modal body -->
            <form action="{{ route('admin.wallet.status') }}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="wallet_id" name="wallet_id" />
                    <input type="hidden" id="status_name" name="status_name" />
                    <h5 class="text-white">
                        {{ __('Are you sure you want to change status') }}?
                    </h5>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form"
                        data-dismiss="modal">
                        {{ __('Close') }}
                    </button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">
                        {{ __('yes') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .btn-xs {
  padding: .125rem .25rem;
  font-size: 17px;
  line-height: 1.5;
  border-radius: .15rem;
}
</style>
@endsection