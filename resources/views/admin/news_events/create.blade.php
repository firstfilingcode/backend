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
                            <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Create News Events</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/news_events') }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                                        
                                        <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                                <!--<a href="https://www.school.rukmanisoftware.com/account_dashboard" class="btn btn-primary  btn-sm"><i class="fa fa-arrow-left"></i> Back</a>-->
                            </div>

                        </div>
                        <form id="quickForm" action="{{route('admin.news_events.store')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row m-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label">Role <span class="required"
                                                style="color:red;">*</span></label>
                                        <select class="form-control" name="role_id" id="role_id">
                                            <option value="">select</option>
                                            @if(!empty(getRole()))
                                            @foreach(getRole() as $role)
                                            <option value="{{ $role->id ?? ''  }}" {{ ( $role['id']==old('role_id'))
                                                ? 'selected' : '' }}>{{ $role->name ?? '' }}</option>
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
                                            id="date" name="title" placeholder="Title" value="{{old('title')}}">
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date<span style="color:red;">*</span></label>
                                        <input type="date" class="form-control @error('date') is-invalid @enderror"
                                            id="date" name="date" placeholder="Name" value="{{old('date')}}">
                                        @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Time<span style="color:red;">*</span></label>
                                        <input type="time" class="form-control @error('time') is-invalid @enderror"
                                            id="time" name="time" placeholder="Name" value="{{old('time')}}">
                                        @error('time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Event Description<span style="color:red;">*</span></label>
                                        <textarea id="event_description"class="form-control @error('event_description') is-invalid @enderror"rows="3" name="event_description"></textarea>
                                            
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
                                        <input value="1" name="status" type="checkbox" id="switch1" switch="none"
                                            checked />
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>

@endsection