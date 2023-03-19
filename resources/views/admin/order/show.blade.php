@extends('admin.layouts.app')
@section('title') @lang('translation.Dashboard')
@endsection @section('content')

<div class="content-wrapper" style="min-height: 199px;">
    <section class="content pt-3">
        <div class="container-fluid">
            <div class="card">
                <div class="row m-2">

                    <div class="col-md-12">
                            <div class="card-tools" style="text-align: right;">
                               <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                            </div>
                           @if(!empty($data['ca_user_id']))
                                 @if($data['ca_approval_status'] == 2 ) <p style="color:red">This order is pending approval by reject </p> @endif
                                 @if($data['ca_approval_status'] == 0)<p style="color:red">This order is pending approval by CA</p> @endif
                          @endif
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <span class="color_gray">CUSTOMER PHONE NO</span><br>
                                    <span>+91 {{$data['user_mobile'] ?? ''}}</span>
                                </div>
                                <div class="col-md-2">
                                    <span class="color_gray">CUSTOMER EMAIL</span><br>
                                    <span>{{$data['user_email'] ?? ''}}</span>
                                </div>
                                <div class="col-md-2">
                                    <span class="color_gray">ORDER ID</span><br>
                                    <span>{{$data['order_no'] ?? ''}}</span>
                                </div>
                                
                               
                                <div class="col-md-2">
                                    <span class="color_gray"> ORDER DATE</span><br>
                                    <span>{{$data['created_at'] ?? ''}}</span>
                                </div>
                                 @php
                                
                                     $status_id = array();
                                    if($data['status_id'] > 0){ 
                                    $val = $data['status_id'];
                                    $status_id = explode(',', $val);
                                     }
                                      $old_status = array();
                                if($data['old_status'] > 0){ 
                                $old_status = explode(',', $data['old_status']);
                         }
                         
                         
                                @endphp
                                <div class="col-md-4 ">
                                    <span class="color_gray"> ORDER Status</span><br>
                                    <div class="btn-group">
                                        <select name="status_id" id="status_id" class="form-control teg">
                                            <option value="">Order Status..</option>
                                            @if(!empty($status_id))
    
                                            @foreach($status_id as $key => $ids)
                                        @php
                                             $fill = DB::table('status')->find($ids);
                                        @endphp
                                       @if(!empty($fill))
                                            <option value="{{ $fill->id ?? ''  }}" {{ ( $fill->id ==$data['status']) ? 'selected' : '' }}    @if(Auth::user()->role_id > 1) @if(in_array($fill->id,$old_status)) disabled="" @endif @endif>{{ $fill->name ?? '' }}
                                            </option>
                                         @endif
                                            @endforeach
                                            @endif
                                        </select>


                                        <a class=" btn btn-warning text-white btn-sm p-0 " style="width: 75px;"
                                            id="statusComment_submit">Update St.</a>
                                    </div>
                                    @if(Auth::user()->role_id == 1)
                                    @if($data['status'] == 13)
                                     <a class=" btn btn-warning text-white btn-sm p-0 " style="width: 75px;"
                                             data-toggle="modal" data-target="#Reopen">Reopen Se.</a>
                                    @endif
                                    @endif
                                </div>
                           
                            @if(Auth::user()->role_id == 1)
                            @if(in_array(2,$old_status))
                            <div class="col-md-4">
                            <form id="quickForm" action="{{url('admin/updateRm')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="order_id" value="{{$data['id'] ?? '' }}">
                               
                                <div class=" form-group btn-group mt-4">
                                    <!--<label>Rm </label>-->
                                        
                                            
                                            <select class="form-control w-100 select2-custom teg " name="rm">
                                                <option value="">--select--</option>
                                                @if(!empty(getRmUser()))
                                                @foreach(getRmUser() as $item)
                                                <option value="{{ $item->id ?? '' }}" {{( $item->id
                                                    ==$data['rm_user_id']) ? 'selected' : '' }}>{{ $item->name ?? '' }}/{{ $item->mobile ?? '' }}
                                                    
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>

                                      
                                        <button class="btn btn-warning text-white btn-sm  ">Update Rm</button>
                                    </div>
                                
                            </form>
                            </div>
                             @endif
                            @endif
                            
                            @if(Auth::user()->role_id == 2 ||Auth::user()->role_id == 1)
                            
                            @if(!empty($data['rm_user_id']))
                            <div class="col-md-4">
                            <form id="quickForm" action="{{url('admin/updateCa')}}" method="POST"
                                enctype="multipart/form-data" class="mt-4">
                                @csrf
                                <input type="hidden" name="order_id" value="{{$data['id'] ?? '' }}">
                                
                                        <div class="btn-group">
                                            
                                            <select class="form-control w-100 select2-custom teg " name="ca">
                                                <option value="">--select--</option>
                                                @if(!empty(getCaUser()))
                                                @foreach(getCaUser() as $item1)
                                                <option value="{{ $item1->id ?? '' }}" {{( $item1->id == $data['ca_user_id']) ? 'selected' : '' }}>{{ $item1->name ?? '' }}/{{ $item1->mobile ?? '' }}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        
                                    
                                        <button class="btn btn-warning text-white btn-sm  ">Update Ca</button>
                                    </div>
                                
                            </form>
                            </div>
                            @endif
                            
                            @endif
                            
                            <div class="col-md-3">
                                <label for="">SP SHARE:</label>
                              
                                 <div class="btn-group">
                                     @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    
                                     <input type="text" value="{{$data['ca_share'] ?? ''}}" class="w-85 "
                                    id="myInput" readonly>
                                     @else
                                     <input type="password" value="{{$data['ca_share'] ?? ''}}" class="w-85 "
                                    id="myInput" readonly>
                                     @endif
                                
                            
                                <button type="button" class="btn btn-warning text-white btn-sm"
                                    data-toggle="modal" data-target="#CAShare1">
                                    CA Share
                                </button>
                               </div>
                            </div>
                               
                                            
                                            
                            <div class="col-md-3">
                                <label for="">Acknowledgement NO :</label>
                               <div class="btn-group">
                                <input type="text" class="form-control w-100" id="acknowledgement_no"
                                    value="{{$data['acknowledgement_no'] ?? ''}}" placeholder="No">
                            
                            
                                <a class="btn btn-warning text-white btn-sm "
                                    id="acknowledgement_Submit">Update</a>
                            </div>
                            </div>
                            <div class="col-md-4 ">
                                    <span class="color_gray">  </span><br>
                                    <div class="btn-group">
                                      <select name="case_on_hold" id="case_on_hold" class="form-control">
                                            <option value="">Select Type..</option>
                                          
                                           <option value="no" {{ ( "no" ==$data['CaseOnHold']) ? 'selected' : '' }}>No</option>
                                           <option value="yes" {{ ( "yes" ==$data['CaseOnHold']) ? 'selected' : '' }}>Yes</option>
                                        </select>
                                         <button class="btn btn-warning text-white btn-sm  " id="case_on">Change</button>
                                    </div>
                                </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card card-outline card-orange">

                        <div class="col-12 col-sm-12  mt-2">

                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                    <!--<li class="nav-item">
                                        <a class="nav-link active" id="order_tab" data-toggle="pill" href="#order"
                                            role="tab" aria-controls="order" aria-selected="true">Order</a>
                                    </li>-->
                                    <li class="nav-item">
                                        <a class="nav-link active" id="message_box_tab" data-toggle="pill"
                                            href="#message_box" role="tab" aria-controls="message_box"
                                            aria-selected="true">Message &
                                            Notifications History</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="document_types_tab" data-toggle="pill"
                                            href="#document_types" role="tab" aria-controls="document_types "
                                            aria-selected="false"> Documents </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="order_priority_tab" data-toggle="pill"
                                            href="#order_priority" role="tab" aria-controls="order_priority"
                                            aria-selected="false">Order Priority</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="DOCUMENTSSENTTOCLIENT_tab" data-toggle="pill"
                                            href="#DOCUMENTSSENTTOCLIENT" role="tab" aria-controls="order_Client"
                                            aria-selected="false">Documents Send To Client</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Documents_tab" data-toggle="pill"
                                            href="#Documents" role="tab" aria-controls="order_Documents"
                                            aria-selected="false">Documents </a>
                                    </li>
                                     <li class="nav-item">
                                        <a class="nav-link" id="Services_covered_tab" data-toggle="pill"
                                            href="#Services_covered" role="tab" aria-controls="Services_covered"
                                            aria-selected="false">Services Covered </a>
                                    </li>
                                   

                                    

                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-four-tabContent">



                                    <div class="tab-pane fade active show" id="message_box" role="tabpanel"
                                        aria-labelledby="message_box_tab">
                                        @php
                                        $message = DB::table('chats')->select('*','user.name as user_name')
                                        ->leftjoin('users as user','user.id','chats.user_id')->where('order_id',
                                        $data['id'])->get();
                                        @endphp
                                        <div class="row mt-2">
                                            <!-- <div class="col-md-12">
                                                <span>Message &amp; Notifications History</span>
                                            </div>-->
                                            <div class="col-md-12 mt-4 overflow mb-2" id="message_box_data">
                                                @if(!empty($message))
                                                @foreach($message as $mess)
                                                @if(Auth::user()->id == $mess->user_id)
                                                <div class="post ">
                                                    <div class="user-block mb-1">
                                                         <span>
                                                            <a href="#"> You </a>
                                                        </span>
                                                        <span class="description ml-0"> {{ $mess->created_at }}</span>
                                                    </div>

                                                    <p>
                                                        {!!html_entity_decode($mess->message ?? '')!!}
                                                    </p>

                                                </div>


                                                @else

                                                <div class="post ">
                                                    <div class="user-block mb-1">
                                                       <span>
                                                            <spam>{{$mess->user_name ?? ''}}</spam>
                                                        </span>
                                                        <span class="description ml-0"> {{ $mess->created_at ?? ''}}</span>
                                                    </div>

                                                    <p>
                                                        {!!html_entity_decode($mess->message ?? '')!!}
                                                    </p>

                                                </div>
                                                @endif
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <textarea id="message" name="message" rows="4" class="form-control"
                                                    placeholder="Type your message here..."></textarea>
                                            </div>

                                            <div class="col-md-6 col-6 text-left mt-1">
                                                <a class="btn btn-warning text-white btn-sm"
                                                    href="{{url('admin/order_edit')}}/{{$data['id'] ?? ''}}">Refresh
                                                    to see new messages</a>
                                            </div>
                                            <div class="col-md-6 col-6 text-right mt-1">
                                                <a class="btn btn-warning text-white btn-sm mt-4 " id="messageSend">Send
                                                    Message</a>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="tab-pane fade" id="order_priority" role="tabpanel"
                                        aria-labelledby="order_priority_tab">
                                        <div class="row mt-2">
                                            <div class="col-md-12 mt-4">
                                                <div class="row p-2">
                                                    <div class="col-md-3">
                                                        <label for="">Order Priority</label>
                                                        <select name="priority" id="priority" class="form-control">
                                                            <option value="">Priority select..</option>
                                                             @if(!empty(getOrderPriority()))
                                                                @foreach(getOrderPriority() as $item2)
                                                                <option value="{{ $item2->name ?? '' }}" {{( $item2->name == $data['priority']) ? 'selected' : '' }} style="background-color:{{$item2->color_code}};color: #fff;">{{ $item2->name ?? '' }}
                                                                </option>
                                                                @endforeach
                                                                @endif
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="col-md-9"></div>
                                                    <div class="col-md-8 mt-3">
                                                        <label for=""> Comment:</label>
                                                        <textarea id="priority_comment" name="priority_comment"
                                                            class="form-control" placeholder="Add Comment"></textarea>
                                                    </div>
                                                    <div class="col-md-12 text-center">
                                                        <a class=" btn btn-warning text-white btn-sm mt-4 "
                                                            id="order_priority_submit">Update Priority</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                   
                                   
                                    <div class="tab-pane fade" id="document_types" role="tabpanel"
                                        aria-labelledby="document_types_tab">
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <div class="callout callout-info">
                                                    <div class="card-header">
                                                        <h6>SERVICES COVERED</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <ul class="mb-5">

                                                            @if(!empty(getDocument($data['id'])))
                                                            @foreach(getDocument($data['id']) as $docs)
                                                            <li>{{$docs['documents'] ?? '' }}</li>
                                                            @endforeach
                                                            @endif

                                                        </ul>
                                                        @php

                                                        $doc =
                                                        DB::table('document_types')->where('status',0)->orderBy('id','DESC')->get();
                                                        @endphp
                                                        <form id="quickForm" action="{{url('admin/documentRequest')}}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="">
                                                                        <h6>REQUEST PENDING DOCUMENTS</h6>
                                                                    </label>
                                                                    <input type="hidden" name="order_id"
                                                                        value="{{$data['id'] ?? '' }}">
                                                                    <input type="hidden" name="user_id"
                                                                        value="{{$data['user_id'] ?? '' }}">
                                                                    <select type="text"
                                                                        class="form-control w-100 select2-custom teg "
                                                                        Placeholder="Select Tage" multiple="multiple"
                                                                        id="document_type_id" name="document_type_id[]">
                                                                        <option value="">select...</option>
                                                                        @if(!empty($doc))
                                                                        @foreach($doc as $docs)
                                                                        <option value="{{ $docs->id ?? ''  }}">{{
                                                                            $docs->name ?? '' }}</option>
                                                                        @endforeach
                                                                        @endif


                                                                    </select>
                                                                </div>
                                                                <div class="col-md-12 mt-2">
                                                                    <button
                                                                        class="btn btn-warning text-white btn-sm mt-4 ">Request
                                                                        Documents</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3 callout callout-info">
                                            <div class="col-md-12">
                                                <h6>PENDING DOCUMENTS BY CUSTOMER</h6>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="">
                                                    <div class="card-header">
                                                        <div class="row ">

                                                            @if(count(getDocumentPadding($data['id'])) > 0)

                                                            @foreach(getDocumentPadding($data['id']) as $docPadding)
                                                            <div class="col-md-6">
                                                                <h6> {{$docPadding['documents'] ?? '' }}</h6>
                                                            </div>
                                                             <div class="col-md-6 text-right">
                                                                <a class="download-link" href="{{url('admin/Remove_DOCUMENTS')}}/{{$docPadding['id'] ?? '' }}"><i class="fa fa-remove" style="font-size:20px;color:red"></i></a><br>
                                                                <span>{{ $docPadding->created_at}}
                                                                    </span>
                                                            </div>
                                                            @endforeach
                                                            @else
                                                            <div class="col-md-6">
                                                                <h6> document padding not found</h6>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-md-12">
                                                <div class="callout callout-info">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-md-6 p-2">
                                                                <h6>DOCUMENTS UPLOADED BY
                                                                    CUSTOMER</h6>
                                                            </div>
                                                            <div class="col-md-6 text-right">
                                                                <!--<a class="download-link">Download
                                                                    all</a>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="crad-body p-4">
                                                        <div class="row">
                                                            @if(!empty(getDocumentUploadedByCustomer($data['id'])))
                                                            @foreach(getDocumentUploadedByCustomer($data['id']) as
                                                            $docDone)
                                                            <div class="col-md-6">
                                                                <h6>{{$docDone['documents'] ?? '' }} </h6>
                                                            </div>
                                                            <div class="col-md-6 text-right">
                                                                
                                                                <a class="download-link mr-2" href="{{url('admin/download_DOCUMENTS')}}/{{$docDone['id'] ?? '' }}"><i class="fa fa-download" style="font-size:20px"></i></a>
                                                                @if(Auth::user()->role_id == 1)
                                                                <a class="download-link" href="{{url('admin/admin_Remove_DOCUMENTS')}}/{{$docDone['id'] ?? '' }}"><i class="fa fa-remove" style="font-size:20px;color:red"></i></a>
                                                                @endif
                                                                <br>
                                                                <span>{{ date('d-m-y | H:m:A',
                                                                    strtotime($docDone->updated_at))}}
                                                                    </span>
                                                            </div>
                                                            <hr>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    
                                     <div class="tab-pane fade" id="DOCUMENTSSENTTOCLIENT" role="tabpanel"
                                        aria-labelledby="DOCUMENTSSENTTOCLIENT_tab">
                                        <form id="quickForm" action="{{url('admin/DoumentsSent')}}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{$data['id'] ?? '' }}">
                                        <div class="row mt-2">
                                            <div class="col-md-12 mt-4">
                                                <div class="row p-2">
                                                    <div class="col-md-3">
                                                        <!--<label for="">Douments Sent To Cluent</label>-->
                                                       <div class="input-group">
                                                            <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="DoumentsSend" id="exampleInputFile">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                            </div>
                                                            
                                                            </div>
                                                    </div>
                                                    
                                                    
                                                    <div class="col-md-12 text-center">
                                                        
                                                         <button class="btn btn-warning text-white btn-sm  ">Douments Send</button>
                                                         
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    @if(!empty(getDoumentsSendByClient($data['id'])))
                                                    @foreach(getDoumentsSendByClient($data['id']) as $docSend)
                                                    <div class="col-md-6">
                                                        <h6>{{$docSend['files'] ?? '' }} </h6>
                                                    </div>
                                                    <div class="col-md-6 text-right">
                                                        <a class="download-link mr-2" href="{{url('admin/downloadDoumentsSendByClient')}}/{{$docSend['id'] ?? '' }}"><i class="fa fa-download" style="font-size:20px"></i></a>
                                                        @if(Auth::user()->role_id == 1)
                                                                <a class="download-link" href="{{url('admin/admin_Remove_DoumentsSendByClient')}}/{{$docSend['id'] ?? '' }}"><i class="fa fa-remove" style="font-size:20px;color:red"></i></a>
                                                        @endif
                                                                <br>
                                                        <span>{{ $docSend->created_at}}
                                                            </span>
                                                    </div>
                                                    <hr>
                                                    @endforeach
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                        
                                    </div>
                                    @php
                                    $docOthers = DB::table('user_documents')->where('order_id',$data['id'])->first();
                                    
                                    @endphp
                                    <div class="tab-pane fade" id="Documents" role="tabpanel">
                                        <div class="row mt-2">
                                           <div class="col-md-2 {{ ($docOthers->first_name != null) ? '' : 'hide' }}">
                                              <span> <b> Name</b></span><br>
                                              {{$docOthers->first_name ?? ''}} {{$docOthers->last_name ?? ''}}
                                          </div>
                                          <div class="col-md-2 {{ ($docOthers->fathers_name != null) ? '' : 'hide' }}">
                                              <span> <b> Fathers Name</b></span><br>
                                              {{$docOthers->fathers_name ?? ''}}
                                          </div>
                                          <div class="col-md-2 {{ ($docOthers->cin != null) ? '' : 'hide' }}">
                                              <span> <b>Cin </b></span><br>
                                              {{$docOthers->cin ?? ''}}
                                          </div>
                                          <div class="col-md-2 {{ ($docOthers->company_name != null) ? '' : 'hide' }}">
                                              <span> <b>Company Name </b></span><br>
                                              {{$docOthers->company_name ?? ''}}
                                          </div>
                                          <div class="col-md-2 {{ ($docOthers->incorporation_date != null) ? '' : 'hide' }}">
                                              <span> <b> Incorporation Date</b></span><br>
                                              {{$docOthers->incorporation_date ?? ''}}
                                          </div>
                                          <div class="col-md-2 {{ ($docOthers->gender != null) ? '' : 'hide' }}">
                                              <span> <b> Gender</b></span><br>
                                              {{$docOthers->gender ?? ''}}
                                          </div>
                                          <div class="col-md-2 {{ ($docOthers->dob != null) ? '' : 'hide' }}">
                                              <span> <b>DOB </b></span><br>
                                              {{$docOthers->dob ?? ''}}
                                          </div>
                                          <div class="col-md-2 {{ ($docOthers->house_no != null) ? '' : 'hide' }}">
                                              <span> <b>House No </b></span><br>
                                              {{$docOthers->house_no ?? ''}}
                                          </div>
                                          <div class="col-md-2 {{ ($docOthers->cin != null) ? '' : 'hide' }}">
                                              <span> <b> Area</b></span><br>
                                              {{$docOthers->area ?? ''}}
                                          </div>
                                          <div class="col-md-2 {{ ($docOthers->pincode != null) ? '' : 'hide' }}">
                                              <span> <b>Pin Code </b></span><br>
                                              {{$docOthers->pincode ?? ''}}
                                          </div>
                                          <div class="col-md-2 {{ ($docOthers->city != null) ? '' : 'hide' }}">
                                              <span> <b> City</b></span><br>
                                              {{$docOthers->city ?? ''}}
                                          </div>
                                          <div class="col-md-2 {{ ($docOthers->cin != null) ? '' : 'hide' }}">
                                              <span> <b> State</b></span><br>
                                              {{$docOthers->state ?? ''}}
                                          </div>
                                          <div class="col-md-2 {{ ($docOthers->code != null) ? '' : 'hide' }}">
                                              <span> <b> Code</b></span><br>
                                              {{$docOthers->code ?? ''}}
                                          </div>
                                          <div class="col-md-2 {{ ($docOthers->ifsc != null) ? '' : 'hide' }}">
                                              <span> <b> Ifsc</b></span><br>
                                              {{$docOthers->ifsc ?? ''}}
                                          </div>
                                           <div class="col-md-2 {{ ($docOthers->bank_name != null) ? '' : 'hide' }}">
                                              <span> <b> Bank Name</b></span><br>
                                              {{$docOthers->bank_name ?? ''}}
                                          </div>
                                           <div class="col-md-2 {{ ($docOthers->bank_account_no != null) ? '' : 'hide' }}">
                                              <span> <b> Bank Account No</b></span><br>
                                              {{$docOthers->bank_account_no ?? ''}}
                                          </div>
                                           <div class="col-md-2 {{ ($docOthers->aadhar_no != null) ? '' : 'hide' }}">
                                              <span> <b> Aadhar No</b></span><br>
                                              {{$docOthers->aadhar_no ?? ''}}
                                          </div>
                                           <div class="col-md-2 {{ ($docOthers->mobile != null) ? '' : 'hide' }}">
                                              <span> <b> Mobile</b></span><br>
                                              {{$docOthers->mobile ?? ''}}
                                          </div>
                                        
                                     
                                        </div>
                                       
                                    </div>
                                    
                                    <div class="tab-pane fade" id="Services_covered" role="tabpanel"
                                        aria-labelledby="Services_covered_tab">
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <div class="callout callout-info">
                                                    <div class="card-header">
                                                        <h6>Service Covered</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        
                                                       {!!html_entity_decode($data->service_covered ?? '')!!}

                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                       
                                       
                                    </div>
                                </div>
                            </div>


                        </div>


                    </div>
                </div>
            </div>
    </section>
</div>
<input type="hidden" id="order_id" value="{{$data['id'] ?? '' }}">
<input type="hidden" id="user_id" value="{{Auth::user()->id ?? ''}}">
<input type="hidden" id="ca_share_pass" value="{{Auth::user()->ca_share_pass ?? ''}}">

<script>
    $(document).ready(function () {
        var URL  = "{{ url('/') }}/admin";
        $('#case_on').on('click', function () {
           var order_id = $('#order_id').val();
            var CaseOnHold = $('#case_on_hold').val();
           
          
            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: URL + '/CaseOnHold',
                data: { order_id: order_id, CaseOnHold: CaseOnHold },
                //dataType: 'json',
                success: function (response) {
                     
                    toastr.success('  Update successfully');
                  
                   
                }
            });
          
        });
         $('#case_on').on('click', function () {
        
        });
        $('#messageSend').on('click', function () {
            var order_id = $('#order_id').val();
            var message = $('#message').val();
            var user_id = $('#user_id').val();

            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: URL + '/messageSend',
                data: { order_id: order_id, message: message, user_id: user_id },
                //dataType: 'json',
                success: function (response) {
                    //toastr.success(response.message);

                    $('#message').val('');
                    $('#message_box_data').html(response);

                }
            });
        });
        $('#statusComment_submit').on('click', function () {
            var order_id = $('#order_id').val();
            var status_id = $('#status_id').val();
            var status_comment = $('#status_comment').val();
             var acknowledgement_no = $('#acknowledgement_no').val();
           
            if(status_id == 13){
               if(acknowledgement_no == ""){
                    alert("Please acknowledge no update");
                    return "";
                }          
            }
            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: URL + '/statusComment',
                data: { order_id: order_id, status_id: status_id, status_comment: status_comment },
                //dataType: 'json',
                success: function (response) {
                     
                    toastr.success('ORDER Status Update successfully');
                    $('#status_comment').val('');
                    if(status_id == 2 || status_id == 13){
                            location.reload();
                    }
                }
            });
        });
         
        
        $('#order_priority_submit').on('click', function () {
            var order_id = $('#order_id').val();
            var priority_comment = $('#priority_comment').val();
            var priority = $('#priority').val();

            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: URL + '/orderPriority',
                data: { order_id: order_id, priority: priority, priority_comment: priority_comment },
                //dataType: 'json',
                success: function (response) {
                    toastr.success('Priority Update successfully');
                    $('#priority_comment').val('');
                }
            });
        });


        $('#acknowledgement_Submit').on('click', function () {
            var order_id = $('#order_id').val();
            var acknowledgement_no = $('#acknowledgement_no').val();

            $.ajax({
                type: "post",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: URL + '/acknowledgementNo',
                data: { order_id: order_id, acknowledgement_no: acknowledgement_no },
                //dataType: 'json',
                success: function (response) {
                    toastr.success('Acknowledgement No Update successfully');

                }
            });
        });

    });


    function myFunction() {
        var ca_pass = $('#ca_share_pass').val();
        var ca_pass_type = $('#sp_password').val();

        var x = document.getElementById("myInput");
        if (x.type === "password") {
            if (ca_pass == ca_pass_type) {
                $("#CAShare").modal();
                toastr.success('Password Confirm Successful');

                x.type = "text";
            } else {
                x.type = "password";
                $("#CAShare").modal('hide');
                toastr.info('Password incorrect');
            }

        } else {
            x.type = "password";
        }
    }

</script>

<div class="modal fade" id="CAShare" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sp Share Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" placeholder="Sp Share Password" id="sp_password">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class=" btn btn-warning text-white btn-sm" onclick="myFunction()">Submit</a>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="Reopen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Order Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="quickForm" action="{{url('admin/update_old_status')}}" method="POST" enctype="multipart/form-data" class="mt-4">
                                @csrf
      <div class="modal-body">
          <input type="hidden" id="order_id" name="order_id" value="{{$data['id'] ?? '' }}">

          @php
            $old_status = array();
                if($data['old_status'] > 0){ 
                $old_status = explode(',', $data['old_status']);
            }
                      
            @endphp
        @if(!empty($old_status))
    
   
        @foreach($old_status as $key => $ids)
    @php
      
         $fill = DB::table('status')->where('id',$ids)->first();
         
    @endphp
    @if($key == 0)
       <input type="hidden" id="status_id" name="status_id[]" value="{{$fill->id ?? ''}}" >
        <label for="vehicle1" style="margin-left: 56px;"> {{$fill->name ?? ''}}</label><br>
  @else
  <input type="checkbox" id="status_id" name="status_id[]" value="{{$fill->id ?? ''}}" checked>
        <label for="vehicle1"> {{$fill->name ?? ''}}</label><br>
  @endif
        @endforeach
        @endif
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>

    </div>
  </div>
</div>






<style>
.hide {
    display:none;
}
    .tabset>input[type="radio"] {
        position: absolute;
        left: -200vw;
    }




    .tabset>label {
        position: relative;
        display: inline-block;
        padding: 15px 15px 25px;
        border: 1px solid transparent;
        border-bottom: 0;
        cursor: pointer;
        font-weight: 600;
    }

    .tabset>label::after {
        content: "";
        position: absolute;
        left: 15px;
        bottom: 10px;
        width: 22px;
        height: 4px;
        background: #8d8d8d;
    }

    .tabset>label:hover,
    .tabset>input:focus+label {
        color: #117a8b;
    }

    .tabset>label:hover::after,
    .tabset>input:focus+label::after,
    .tabset>input:checked+label::after {
        background: #117a8b;
    }

    .tabset>input:checked+label {
        border-top: 3px solid #117a8b;
    }

    .tab-panel {
        padding: 30px 0;
    }

    *,
    *:before,
    *:after {
        box-sizing: border-box;
    }

    .card_border_left {
        border-left: 0;
    }

    .overflow {
        height: 270px;
        overflow-x: hidden;
        overflow-y: scroll;
    }

    .btn_maergin_TOP {
        margin-top: 26% !important;
    }

    .btn_maergin_TOP1 {
        margin-top: 33%;

    }

    @media only screen and (max-width:600px) {
        .btn_maergin_TOP1 {
            margin-top: 2% !important;
        }

        .btn_maergin_TOP {
            margin-top: 2% !important;
        }
    }

    p {
        margin-top: 0;
        margin-bottom: 0rem !important;
    }
    
    .callout a:hover {
  color: #262728;
}
</style>


@endsection