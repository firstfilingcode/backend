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
                        Contacts') }}
                     </h3>
                     
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
                                 <th>Name</th>
                                 <th>Mobile</th>
                                 <th>Email</th>
                                 <th>Query</th>
                                 <th>Page Name</th>
                                
                               
                                 
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
                                 <td>{{$value['mobile'] ?? ''}}</td>
                                 <td>{{$value['email'] ?? ''}}</td>
                                 <td>{{$value['query'] ?? ''}}</td>
                                 <td>{{$value['page_name'] ?? ''}}</td>
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
<style>
   .btn-xs {
   padding: .125rem .25rem;
   font-size: 17px;
   line-height: 1.5;
   border-radius: .15rem;
   }
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@endsection