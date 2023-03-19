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
                News Letters') }}
              </h3>
              <!--<div class="card-tools">
                <a href="{{url('admin/clints/create')}}" class="btn btn-warning text-white btn-sm"><i
                    class="fa fa-plus"></i>{{ __('Add') }}</a>
                <a href="{{url('admin/clints/create')}}" class="btn btn-warning text-white btn-sm"><i
                    class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
              </div>-->
              
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
                      <th>Email</th>
                      <th>Status</th>
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
                      <td>{{$value['email'] ?? ''}}</td>
                      <td>
                        @if($value->status==1)

                        <button data-toggle="modal" data-target="#Modal_id" data-id="{{ $value->id }}"
                          data-name="Active"
                          class="btn btn-success btn-sm btn-soft-success waves-effect waves-light sa-params news_letters_status"
                          style="display:inline">Active</button>

                        @else

                        <button data-toggle="modal" data-target="#Modal_id" data-id="{{ $value->id }}"
                          data-name="Inactive"
                          class="btn btn-danger btn-sm btn-soft-danger waves-effect waves-light news_letters_status"
                          style="display:inline">Inactive</button>

                        @endif

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
  $('.news_letters_status').click(function () {
    var news_letters_id = $(this).data('id');
    var status_name = $(this).data('name');

    $('#status_name').val(status_name);
    $('#news_letters_id').val(news_letters_id);
  });
  $('.user_delete').click(function () {

    $("#user_id").val($(this).data('id'))
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
      <form action="{{ route('admin.news_letters.status') }}" method="post">
        @csrf
        <div class="modal-body">
          <input type="hidden" id="news_letters_id" name="news_letters_id" />
          <input type="hidden" id="status_name" name="status_name" />
          <h5 class="text-white">
            {{ __('Are you sure you want to change status') }}?
          </h5>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">
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
      <form action="{{ route('admin.clints.destroy')}}" method="post">
        @csrf
        <div class="modal-body">
          <input type="hidden" id="user_id" name="user_id" />

          <h5 class="text-white">
            {{ __(' Are you sure you want to delete this data......') }}?
          </h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">
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