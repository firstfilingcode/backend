@extends('admin.layouts.master')
@section('title')
@lang('translation.Product_Detail')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                  

                    <div class="mt-4">
                        
                        <div class="product-desc">
								
                            <div class="tab-content border border-top-0 p-4">
                                <div class="tab-pane fade show active" id="specifi" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-nowrap mb-0">
                                            <tbody>
                                                <tr>
                                                    <th scope="row" style="width: 20%;">Name</th>
                                                    <td>{{ $user->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Email</th>
                                                    <td>{{ $user->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Roles</th>
                                                    <td>
													@if(!empty($user->getRoleNames()))
													@foreach($user->getRoleNames() as $v)
													<label class="badge badge-success">{{ $v }}</label>
													@endforeach
													@endif
													</td>
                                                </tr>
                                               
												<tr>
                                                    <th scope="row">
														<a class="btn btn-success waves-effect waves-light" href="{{ route('admin.users.edit',$user->id) }}"><i class="uil-pen"></i> Edit</a>
														<a class="btn btn-dark waves-effect waves-light" href="{{ route('admin.users.index') }}"><i class="uil-arrow-left"></i> Back</a>
														</th>
                                                    <td></td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection