@extends('admin.layouts.master-without-nav')
@section('title')
Verify Your Email Address
@endsection
@section('content')

<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row">
           <div class="col-lg-6">
               <div class="text-center">
                    <a href="{{url('login')}}" class="mb-5 d-block auth-logo">
                       @include('admin.layouts.logo-svg')
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- end container -->
</div>
@endsection