@extends('admin.layouts.app') 
@section('title') 

@endsection 
@section('content')
<style>
    .btn-xs {
  padding: .125rem .25rem;
  font-size: 17px;
  line-height: 1.5;
  border-radius: .15rem;
}
</style>
<div class="content-wrapper">
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card card-outline card-orange">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">
                                <i class="fa fa-address-book-o"></i> &nbsp; {{ __('View
                                Roles') }}
                            </h3>
                            <div class="card-tools">
                                <a href="{{url('admin/roles/create')}}" class="btn btn-warning text-white btn-sm"><i
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
                                            <th>Name</th>
                                            <!--<th>Status</th>-->
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
                                            <td>{{$value['name'] ?? ''}}</td>
                                            <!-- <td>
                                                
                                            @if($value->status==1)
                                               <form action="{{url('admin/roles/status')}}/{{ $value->id}}/Active" method="POST"> 
                                                    @csrf   
                                                	<button onclick="myFunction()" type="submit" class="btn btn-success btn-sm btn-soft-success waves-effect waves-light sa-params" style ="display:inline">Active</button>
                                                </form>
               								@else
               									<form action="{{url('admin/roles/status')}}/{{ $value->id}}/Inactive" method="POST"> 
                                                    @csrf   
                                                	<button onclick="myFunction()" type="submit" class="btn btn-danger btn-sm btn-soft-danger waves-effect waves-light" style ="display:inline">Inactive</button>
                                                </form>
            								@endif	
                                            </td>-->
                                            <td>
                                                 <a href="{{  route('admin.roles.edit',$value->id)  }}" class=" text-success btn-xs ml-3" data-toggle="tooltip" data-placement="top" title="Edit Accounts"><i
                                                        class="fa fa-edit"></i></a>
                                                 <a   data-id="{{$value->id}}"  data-location="countries"  class="role_delete text-danger btn-xs ml-3" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>
                                               {!! Form::open(['method' => 'DELETE','route' => ['admin.roles.destroy', $value->id]]) !!}                                              
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
            <form action="{{ route('admin.roles.destroy')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="role_id" name="role_id" />
                    
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

    <script>
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
});
    </script>
<script>
    $('#close,#close1').click(function () {
        $('#id01').hide()
    })

    $('.role_delete').click(function(){

      $("#role_id").val($(this).data('id'))
      $("#Modal_id1").modal("show");
      
   })
</script>

@endsection