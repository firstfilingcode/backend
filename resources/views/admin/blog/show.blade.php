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
                        Blog') }}
                     </h3>
                     <div class="card-tools">
                        <a href="{{ URL::previous() }}" class="btn btn-warning text-white btn-sm"><i
                                        class="fa fa-arrow-left"></i>{{ __('Back') }}</a>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="mt-4">
                        <div class="product-desc">
                           <div class="tab-content border border-top-0 p-4">
                              <div class="tab-pane fade show active" id="specifi" role="tabpanel">
                                 <div class="table-responsive">
                                    <table class="table table-nowrap mb-0">
                                       <tbody>
                                          @if(!empty($data))
                                          @foreach($data as $key => $value)
                                          <tr >
                                             <th style="width: 20%;">Name</th>
                                             <td>{{$value['name'] ?? ''}}</td>
                                          </tr>
                                          <tr >
                                             <th style="width: 20%;">Status</th>
                                             <td>
                                                @if($value->status==1)
                                                <span 
                                                   data-id="{{ $value->id }}" data-name="Active">Active</span>
                                                    @else
                                                   <span data-id="{{ $value->id }}" data-name="Inactive">Inactive</span>
                                                   
                                                @endif
                                             </td>
                                          </tr>
                                          
                                          <tr >
                                             <th style="width: 20%;">Author</th>
                                             <td>{{$value['author'] ?? ''}}</td>
                                          </tr>
                                          
                                          <tr >
                                             <th style="width: 20%;">Remark</th>
                                             <td>{{$value['remark'] ?? ''}}</td>
                                          </tr>
                                          
                                          <tr >
                                             <th style="width: 20%;">Photo</th>
                                             <td>
                                                @if($value->photo)
                                                <img src="{{ env('IMAGE_SHOW_PATH').'blog/'.$value['photo'] }}"
                                                   class="img-fluid" style="width: 30%;"
                                                   alt="{{$value->photo}}">
                                                @else
                                                <img src="{{asset('backend/img/thumbnail-default.jpg')}}"
                                                   class="img-fluid" style="width: 30%;"
                                                   alt="avatar.png">
                                                @endif
                                             </td>
                                          </tr>
                                          
                                          <tr >
                                             <th style="width: 20%;">Description</th>
                                             <td id="divMain"></td>
                                              <td id="log"> {{ $value->ck_editor ?? '' }}</td>
                                          </tr>
                                       </tbody>
                                       @endforeach
                                       @endif
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
      </div>
   </section>
</div>

<script>
    var support = (function() {
        if (!window.DOMParser) return false;
        var parser = new DOMParser();
        try {
            parser.parseFromString('x', 'text/html');
        } catch (err) {
            return false;
        }
        return true;
    })();

    var textToHTML = function(str) {

        // check for DOMParser support
        if (support) {
            var parser = new DOMParser();
            var doc = parser.parseFromString(str, 'text/html');
            return doc.body.innerHTML;
        }

        // Otherwise, create div and append HTML
        var dom = document.createElement('div');
        dom.innerHTML = str;
        return dom;

    };

    var myValue9 = document.getElementById("log").innerText;

    document.getElementById("divMain").innerHTML = textToHTML(myValue9);

    document.getElementById("log").innerText = "";
</script>

@endsection