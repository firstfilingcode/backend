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
                                Offers') }}
                            </h3>
                            <div class="card-tools">
                                <a href="{{url('admin/offer/create')}}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-plus"></i>{{ __('Add') }}</a>
                                        
                                        <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                               
                            </div>
                        </div>
                     <!--  {!! Form::open(array('method'=>'get')) !!}-->
                        <div class="row m-2">
                             
                            <div class="col-md-3">
                                <label>From Date</label><br>
                                <input type="date" class="form-control mb-3" name="from_date" value="<?php if (isset($_GET['from_date']) && !empty($_GET['from_date'])){ echo $_GET['from_date'];}?>" >
                            </div>
                            <div class="col-md-3">
                                <label>To Date</label><br>
                                <input type="date" class="form-control mb-3" name="to_date" value="<?php if (isset($_GET['to_date']) && !empty($_GET['to_date'])){ echo $_GET['to_date'];}?>" >
                            </div>
                            <div class="col-md-3">
                                 <label class="text-white">Search</label><br>
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                            <!--{!! Form::close() !!}-->
                            <div class="col-12">
                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline">
                                    <thead>
                                        <tr role="row">
                                            <th>Sr.no</th>
                                            <th>Name</th>
                                           <!-- <th>Photo</th>-->
                                            <th>From date</th>
                                            <th>To date</th>
                                            <th>Promo Code</th>
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
                                            <td>{{$value['name'] ?? ''}}</td>
                                            
                                           <!-- <td>
                                                @if($value->photo)
                                                    <img src="{{ env('IMAGE_SHOW_PATH').'offer/'.$value['photo'] }}" class="img-fluid" style="max-width:80px" alt="{{$value->photo}}">
                                                @else
                                                    <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:80px" alt="avatar.png">
                                                @endif
                                            </td>-->
                                             <td>{{$value['from_date'] ?? ''}}</td>
                                             <td>{{$value['to_date'] ?? ''}}</td>
                                             <td>{{$value['promo_code'] ?? ''}}</td>
                                             <td>
                                                 @if($value->status==1)
                                              
                                                	<button data-toggle="modal" data-target="#Modal_id" data-id="{{ $value->id }}" data-name="Active" class="btn btn-success btn-sm btn-soft-success waves-effect waves-light sa-params offer_status" style ="display:inline">Active</button>
                                             
               								@else
               								  
                                                	<button data-toggle="modal" data-target="#Modal_id" data-id="{{ $value->id }}" data-name="Inactive" class="btn btn-danger btn-sm btn-soft-danger waves-effect waves-light offer_status" style ="display:inline">Inactive</button>
                                               
            								@endif
                                                
                                            </td>
                                            <td class="d-flex">
                                                 <a  href="{{ route('admin.offer.show',$value->id)  }}" data-id="{{$value->id}}"class=" text-danger ml-3" title="Show Offer"><i class="fa fa-eye"></i></a>
                                                <a href="{{  route('admin.offer.edit',$value->id)  }}" class=" text-success ml-3" title="Edit Offer"><i
                                                        class="fa fa-edit"></i></a>
                                                <a data-id="{{$value->id}}" data-location="countries"
                                                    class="offer_delete text-danger  ml-3" data-toggle="tooltip"
                                                    data-placement="top" title="Delete"
                                                    onclick="document.getElementById('id01').style.display='block'"><i
                                                        class="fa fa-trash-o"></i></a> 
                                            {!! Form::open(['method' => 'DELETE','route' => ['admin.offer.destroy', $value->id]]) !!}                                              
                                            {!! Form::close() !!}
                                              
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
    $('.offer_status').click(function() {
    var offer_id = $(this).data('id'); 
    var status_name = $(this).data('name');
  
    $('#status_name').val(status_name); 
  $('#offer_id').val(offer_id); 
  } );
</script>
<script>
    $('#close,#close1').click(function () {
        $('#id01').hide()
    })

    $('.offer_delete').click(function(){

      $("#offer_delete_id").val($(this).data('id'))
      $("#Modal_id1").modal("show");
      
   })
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
            <form action="{{ route('admin.offer.status') }}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="offer_id" name="offer_id" />
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
                        {{ __('Yes') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="Modal_id1">
    <div class="modal-dialog">
        <div class="modal-content bg_color">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-white">{{ __('Delete Data On Database') }}</h4>
                <button type="button" class="btn-close" data-dismiss="modal">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('admin.offer.destroy')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="offer_delete_id" name="offer_delete_id" />
                    
                    <h5 class="text-white">
                        {{ __(' Are you sure you want to delete this data......') }}?
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
@endsection