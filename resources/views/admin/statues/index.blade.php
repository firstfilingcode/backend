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
                                Status') }}
                            </h3>
                            <div class="card-tools">
                                <a href="{{url('admin/order_status/create')}}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-plus"></i>{{ __('Add') }}</a>
                                        
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
                                            <th>Order BY</th>
                                            <th>Status Message</th>
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
                                          
                                            <td>{{$value['order_by'] ?? ''}}</td>
                                            
                                             <td>{!!html_entity_decode($value['status_massage'] ?? '')!!} </td>
                                           <td>
                                             @if($value->status==0)
                                            <button data-toggle="modal" data-target="#Modal_id" data-id="{{ $value->id }}"
                                              data-name="Inactive"
                                              class="btn btn-success btn-sm btn-soft-success waves-effect waves-light sa-params news_letters_status"
                                              style="display:inline">Active</button>
                    
                                            @else
                                            <button data-toggle="modal" data-target="#Modal_id" data-id="{{ $value->id }}"
                                              data-name="Active"
                                              class="btn btn-danger btn-sm btn-soft-danger waves-effect waves-light news_letters_status"
                                              style="display:inline">Inactive</button>
                    
                                            @endif
                                                
                                            </td>
                                            
                                            <td class="d-flex">
                                                
                                                <a href="{{  route('admin.order_status.edit',$value->id)  }}" class=" text-success btn-xs ml-3" title="Edit Blog"><i
                                                        class="fa fa-edit"></i></a>
                                                        
	                                           											
												<a data-id="{{$value->id}}" data-location="countries"
                                                    class="user_delete text-danger  ml-3" data-toggle="tooltip"
                                                    data-placement="top" title="Delete"
                                                    onclick="document.getElementById('id01').style.display='block'"><i
                                                        class="fa fa-trash-o"></i></a>  
                                                {!! Form::open(['method' => 'POST','route' => ['admin.order_status.destroy', $value->id],'style'=>'display:inline','class'=>'sa-params'.$value->id.'']) !!}	
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
            <form action="{{ route('admin.order_status.destroy')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="order_delete_id" name="order_delete_id" />
                    
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
            <form action="{{ route('admin.order_status.status') }}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="news_letters_id" name="news_letters_id" />
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


<script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
});


 $('#close,#close1').click(function(){
       $('#id01').hide()
   })

    </script>


<script>
  $('.news_letters_status').click(function () {
    var news_letters_id = $(this).data('id');
    var status_name = $(this).data('name');

    $('#status_name').val(status_name);
    $('#news_letters_id').val(news_letters_id);
  });
 
</script>
<script>
    $('#close,#close1').click(function () {
        $('#id01').hide()
    })

    $('.user_delete').click(function(){

      $("#order_delete_id").val($(this).data('id'))
      $("#Modal_id1").modal("show");
      
   })
</script>
<style>
    .btn-xs {
  padding: .125rem .25rem;
  font-size: 17px;
  line-height: 1.5;
  border-radius: .15rem;
}
</style>
@endsection