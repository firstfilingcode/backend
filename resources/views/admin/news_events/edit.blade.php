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
                            <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Edit News Events</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/news_events') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i>
                                    View</a>
                                    
                                    <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                            </div>
                        </div>
                        {!! Form::model($data, ['method' => 'PATCH','files' => true,'route' =>
                        ['admin.news_events.update', $data->id]])
                        !!}
                        @csrf
                        <div class="row m-2">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Role</label>
                                    <select class="form-control" name="role_id" id="role_id">
                                        <option value="">select</option>
                                        @if(!empty(getRole()))
                                        @foreach(getRole() as $role)
                                        <option value="{{ $role->id ?? ''  }}" {{ ( $role['id']==old('role_id'))
                                            ? 'selected' : '' }}>{{
                                            $role->name ?? '' }}</option>
                                        @endforeach
                                        @endif


                                        @error('role_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Title<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            id="date" name="title" placeholder="Title" value="{{old('title') ?? $data['title'] }}">
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                            </div>
                                
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control" id="date" name="date" placeholder="Name"
                                        value="{{old('date') ?? $data['date'] }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Time</label>
                                    <input type="time" class="form-control" id="time" name="time" placeholder="Name"
                                        value="{{old('time') ?? $data['time'] }}">
                                </div>
                            </div>

                            <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Event Description<span style="color:red;">*</span></label>
                                        <textarea id="event_description"class="form-control @error('event_description') is-invalid @enderror"rows="3" name="event_description">{{old('event_description') ?? $data['event_description'] }}</textarea>
                                            
                                        @error('event_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>



                        </div>
                        <div class="row m-2">
                            <div class="col-md-4 mt-2">
                                <label for="switch1" data-on-label="Active" data-off-label="Inactive">Status</label>
                                <div class="check-box mt-2">
                                    <input value="1 {{old('status',$data['status']) ?? ''}}" name="status"
                                        type="checkbox" id="switch1" switch="none" {{ ( $data['status']==1) ? 'checked'
                                        : '' }} />
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