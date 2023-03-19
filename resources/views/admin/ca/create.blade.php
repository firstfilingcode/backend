@extends('admin.layouts.app')
@section('title') @lang('translation.Dashboard') @endsection
@section('content')
@php
getRmUser();
@endphp
<div class="content-wrapper" style="min-height: 222px;">
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card card-outline card-orange">
                        <div class="card-header bg-primary">
                            <h3 class="card-title"><i class="fa fa-bank"></i> &nbsp; Create CA</h3>
                            <div class="card-tools">
                                <a href="{{url ('admin/ca') }}" class="btn btn-warning text-white  btn-sm"><i
                                        class="fa fa-eye"></i> View</a>
                               <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                            </div>

                        </div>
                        <form id="quickForm" action="{{route('admin.ca.store')}}"   method="POST" enctype="multipart/form-data">
                           @csrf
                            <div class="row m-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{old('name')}}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mobile Number<span style="color:red;">*</span></label>
                                        {!! Form::text('mobile', null, array('class' => 'form-control','placeholder' => 'Mobile','maxlength'=>10, 'onkeypress'=>'return isNumber(event)')) !!}
                                        @error('mobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                           <div class="col-md-4">
                                    <label>E-mail<span style="color:red;">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="E-mail" value="{{old('email')}}">
                                    @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                           <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Username<span style="color:red;">*</span></label>
                                        <input type="text" class="form-control @error('userName') is-invalid @enderror  " id="Username" name="userName" placeholder="Username" value="{{old('userName')}}" maxlength="16">
                                        @error('userName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror    
                                    </div>
                                </div>
                            <div class="col-md-4">
                                    <label>Password<span style="color:red;">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password" value="{{old('password')}}">
                                    @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                           
                           
                           
                           
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>D.O.B</label>
                                        <input type="date" class="form-control" id="dob" name="dob" placeholder="Password" value="{{old('dob')}}">
                                        <!--@error('dob')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror-->
                                    </div>
                                </div>
                                
                                
                               
                                
                              <!--  <div class="col-md-4">
                                    <label style="color:red;">Confirm Password*</label>
                                    <input type="password" class="form-control @error('name') is-invalid @enderror" id="cpassword" name="cpassword"
                                        placeholder="Confirm Password" value="{{old('')}}">
                                </div>-->
                                

                                <div class="col-md-4">
                                    <label>Uplode Image</label>
                                    <input type="file" class="form-control" id="profile" name="profile" value="{{old('profile')}}">
                                    <!--@error('profile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror-->
                                </div>
                              
                                <div class="col-md-4">
                                    <label>CPO Certificate</label>
                                    <input type="file" class="form-control" id="cpo" name="cpo" value="{{old('cpo')}}">
                                   
                                </div>
                                <div class="col-md-4">
                                    <label>Membership Certificate</label>
                                    <input type="file" class="form-control" id="marship" name="marship" value="{{old('marship')}}">
                                   
                                </div>
                              
                                
                                   <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Rm <span class="required" style="color:red;">*</span></label> 
                                            <select class="form-control " name="rm[]">
                                                <option value="--select--">--select--</option>
                                                @if(!empty(getRmUser()))
                                                @foreach(getRmUser() as $item)
                                                <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                                @endforeach
                                                @endif
                                                </select>
                                        </div>
                                    </div>
                                      <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Address<span style="color:red;">*</span></label>
                                        <textarea  class="form-control text_arear @error('address') is-invalid @enderror" id="address" name="address"  placeholder="Address" value="{{old('address')}}"></textarea>
                                        @error('addresh')
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
                                    <button type="submit" class="btn btn-success btn-lg"> Save </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection