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
              <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Edit Clints</h3>
              <div class="card-tools">
                <a href="{{url ('admin/clints') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                        <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
              </div>
            </div>
            {!! Form::model($data, ['method' => 'PATCH','files' => true,'route' => ['admin.clints.update', $data->id]])
            !!}
            @csrf
            <div class="row m-2">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Name<span style="color:red;">*</span></label>
                  <input type="text"
                    class="form-control @error('name') is-invalid @enderror @error('name') is-invalid @enderror"
                    id="name" name="name" placeholder="Name" value="{{old('name',$data['name']) ?? ''}}">
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group col-md-4">
                <label for="inputPhoto">Upload photo<span class="text-danger">*</span>

                </label>

                <input id="thumbnail" class="form-control mt-1" type="file" name="photo">
              </div>

              <div class="form-group col-md-4">
                @if($data->photo)
                <img src="{{ env('IMAGE_SHOW_PATH').'clints/'.$data['photo'] }}" class="img-fluid"
                  style="max-width:80px" alt="{{$data->photo}}">
                @else
                <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:80px"
                  alt="avatar.png">
                @endif
              </div>

            </div>
            <div class="row m-2">
              <div class="col-md-4 mt-2">
                <label for="switch1" data-on-label="Active" data-off-label="Inactive">Status</label>
                <div class="check-box mt-2">
                  <input value="1 {{old('status',$data['status']) ?? ''}}" name="status" type="checkbox" id="switch1"
                    switch="none" {{ ( $data['status']==1) ? 'checked' : '' }} />
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
                <button type="submit" class="btn btn-success btn-lg"> Save </button>
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
  function calculateAmount(value, row_id) {

    var quantity = $('#quantity_0').val();
    var rate = $('#rate_0').val();

    var amount = quantity * rate;

    $('#amount_0').val(amount);

  }; ipt >
</script>