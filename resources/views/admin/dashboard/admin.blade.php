@extends('admin.layouts.app')
@section('title') @lang('translation.Dashboard') @endsection
@section('content')
<div class="content-wrapper mt-3">
   <section class="content ">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12 col-md-12">
               <div class="card card-outline card-orange">
                  <div class="card-header bg-primary">
                     <h3 class="card-title"><i class="fa fa-home"></i> &nbsp;Admin Dashboard</h3>
                     <div class="card-tools">
                        <!--<a href="https://www.school.rukmanisoftware.com/add_user" class="btn btn-primary  btn-sm" title="Add User"><i class="fa fa-plus"></i> Add User</a>-->
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
           
            <div class="col-12 col-sm-6 col-md-3">
               <a href="{{ route('admin.rm.index')}}">
                  <div class="info-box mb-3 text-dark">
                     <span class="info-box-icon bg-info elevation-1"><i class="fa fa-user-circle-o"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text"> RM Management </span>
                        <span class="info-box-number">{{ \App\Models\User::where('role_id','2')->count() }}</span>
                     </div>
                  </div>
               </a>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
               <a href="{{ route('admin.ca.index')}}">
                  <div class="info-box mb-3 text-dark">
                     <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-male"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">CA Management </span>
                        <span class="info-box-number">{{ \App\Models\User::where('role_id','3')->count() }}</span>
                     </div>
                  </div>
               </a>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
               <a href="{{ route('admin.costumar.index')}}">
                  <div class="info-box mb-3 text-dark">
                     <span class="info-box-icon bg-secondary elevation-1"><i class="fa fa-handshake-o"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Costumar Management </span>
                        <span class="info-box-number">{{ \App\Models\WebUser::where('role_id','4')->count() }}</span>
                     </div>
                  </div>
               </a>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
               <a href="{{ route('admin.users.index')}}">
                  <div class="info-box mb-3 text-dark">
                     <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-id-badge"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Users Management </span>
                        <span class="info-box-number">{{ \App\Models\User::all()->count() }}</span>
                     </div>
                  </div>
               </a>
            </div>
             
            <div class="col-12 col-sm-6 col-md-3">
               <a href="{{ route('admin.wallet.index')}}">
                  <div class="info-box mb-3 text-dark">
                     <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-google-wallet"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Total Wallet AMP. </span>
                        <span class="info-box-number">{{ \App\Models\Wallet::all()->count() ?? '' }}</span>
                     </div>
                  </div>
               </a>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
               <a href="{{ route('admin.blog.index')}}">
                  <div class="info-box mb-3 text-dark">
                     <span class="info-box-icon bg-info elevation-1"><i class="fa fa-empire"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Total Blog </span>
                        <span class="info-box-number">{{ \App\Models\Blog::all()->count() ?? '' }}</span>
                     </div>
                  </div>
               </a>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
               <a href="{{ route('admin.offer.index')}}">
                  <div class="info-box mb-3 text-dark">
                     <span class="info-box-icon bg-success elevation-1"><i class="fa fa-angellist"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Acctive Offers </span>
                        <span class="info-box-number">{{ \App\Models\Offer::all()->count() ?? '' }}</span>
                     </div>
                  </div>
               </a>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
               <a href="{{ route('admin.service.index')}}">
                  <div class="info-box mb-3 text-dark">
                     <span class="info-box-icon bg-dark elevation-1"><i class="fa fa-universal-access"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Total Sarvice </span>
                        <span class="info-box-number">{{ \App\Models\Services::all()->count() ?? '' }}</span>
                     </div>
                  </div> 
               </a>
            </div>
                  @php
                    $order = DB::table('order_details')->count();
                    @endphp
                    <div class="col-12 col-sm-6 col-md-3">
                        
                      
                          <div class="info-box mb-3 text-dark">
                             <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-first-order"></i></span>
                             <div class="info-box-content">
                                 <button type="submit" class="info-box-text btn-none"> Total Orders  </button>
                                <span class="info-box-number">{{$order ?? ''}}</span>
                             </div>
                          </div>
                         
                    </div>
                     @php
                        $panding_order = DB::table('order_details')->where('status',1)->count();
                    @endphp
                  <div class="col-12 col-sm-6 col-md-3">
                  <form id="quickForm" action="{{url('admin/order')}}"   method="POST" enctype="multipart/form-data">
                          @csrf
                       <input type="hidden" name="tab_type" value="awaiting_acceptance">
                      <div class="info-box mb-3 text-dark">
                         <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-bullhorn"></i></span>
                         <div class="info-box-content">
                              <button type="submit" class="info-box-text btn-none">  Awaiting Acceptance Order. </button>
                              <span class="info-box-number">{{$panding_order ?? ''}}</span>
                         </div>
                      </div>
                   </form>
                </div>
                @php
                    $Active = DB::table('order_details')->whereNotIn('order_details.status',[1,23,24])->count();
                @endphp
                 <div class="col-12 col-sm-6 col-md-3">
                    <form id="quickForm" action="{{url('admin/order')}}"   method="POST" enctype="multipart/form-data">
                          @csrf
                       <input type="hidden" name="tab_type" value="active_order">
                      <div class="info-box mb-3 text-dark">
                         <span class="info-box-icon bg-success elevation-1"><i class="fa fa-font-awesome"></i></span>
                         <div class="info-box-content">
                              <button type="submit" class="info-box-text btn-none">Active Order  </button>
                            <span class="info-box-number">{{$Active ?? ''}}</span>
                         </div>
                      </div>
                   </form>
                </div>
                 @php
                    $caseOnHold = DB::table('order_details')->where('CaseOnHold','yes')->count();
                @endphp
                 <div class="col-12 col-sm-6 col-md-3">
                    <form id="quickForm" action="{{url('admin/order')}}"   method="POST" enctype="multipart/form-data">
                          @csrf
                       <input type="hidden" name="tab_type" value="Caseonhold">
                      <div class="info-box mb-3 text-dark">
                         <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check"></i></span>
                         <div class="info-box-content">
                              <button type="submit" class="info-box-text btn-none">  Case On Hold  </button>
                            <span class="info-box-number">{{$caseOnHold ?? ''}}</span>
                         </div>
                      </div>
                   </form>
                </div>
                 @php
                    $Work_done = DB::table('order_details')->where('status',13)->count();
                @endphp
                 <div class="col-12 col-sm-6 col-md-3">
                    <form id="quickForm" action="{{url('admin/order')}}"   method="POST" enctype="multipart/form-data">
                          @csrf
                       <input type="hidden" name="tab_type" value="workdone">
                      <div class="info-box mb-3 text-dark">
                         <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check"></i></span>
                         <div class="info-box-content">
                              <button type="submit" class="info-box-text btn-none">  Work Done.  </button>
                            <span class="info-box-number">{{$Work_done ?? ''}}</span>
                         </div>
                      </div>
                   </form>
                </div>
                                
                              
            <div class="col-12 col-sm-6 col-md-3">
               <a href="{{ route('admin.order')}}">
                  <div class="info-box mb-3 text-dark">
                     <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Total Payment</span>
                        <span class="info-box-number">0</span>
                     </div>
                  </div>
               </a>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
               <a href="{{ route('admin.order')}}">
                  <div class="info-box mb-3 text-dark">
                     <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Total Paid Payment</span>
                        <span class="info-box-number">0</span>
                     </div>
                  </div>
               </a>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
               <a href="{{ route('admin.order')}}">
                  <div class="info-box mb-3 text-dark">
                     <span class="info-box-icon bg-success elevation-1"><i class="fa fa-check"></i></span>
                     <div class="info-box-content">
                        <span class="info-box-text">Total UnPaid Payment</span>
                        <span class="info-box-number">0</span>
                     </div>
                  </div>
               </a>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <!--<div class="card card-danger">
                  <div class="card-header">
                     <h3 class="card-title">Line Chart</h3>
                     <div class="card-tools">
                        <button class="btn btn-tool" type="button" data-card-widget="collapse">
                        <i class="fa fa-minus"></i>
                        </button>
                        <button class="btn btn-tool" type="button" data-card-widget="remove">
                        <i class="fa fa-times"></i>
                        </button>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="chart">
                        <div class="chartjs-size-monitor">
                           <div class="chartjs-size-monitor-expand">
                              <div class=""></div>
                           </div>
                           <div class="chartjs-size-monitor-shrink">
                              <div class=""></div>
                           </div>
                        </div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
                        <canvas id="myChart7" style="width:100%;max-width:600px"></canvas>
                        <script>
                           var xValues = [100,200,300,400,500,600,700,800,900,1000];
                           
                           new Chart("myChart7", {
                             type: "line",
                             data: {
                               labels: xValues,
                               datasets: [{ 
                                 data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
                                 borderColor: "red",
                                 fill: false
                               }, { 
                                 data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,7000],
                                 borderColor: "green",
                                 fill: false
                               }, { 
                                 data: [300,700,2000,5000,6000,4000,2000,1000,200,100],
                                 borderColor: "blue",
                                 fill: false
                               }]
                             },
                             options: {
                               legend: {display: false}
                             }
                           });
                        </script>
                     </div>
                  </div>
               </div>-->
               <div class="card card-danger">
                  <div class="card-header">
                     <h3 class="card-title">Order</h3>
                     <div class="card-tools">
                        <button class="btn btn-tool" type="button" data-card-widget="collapse">
                        <i class="fa fa-minus"></i>
                        </button>
                        <button class="btn btn-tool" type="button" data-card-widget="remove">
                        <i class="fa fa-times"></i>
                        </button>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="chart">
                        <div class="chartjs-size-monitor">
                           <div class="chartjs-size-monitor-expand">
                              <div class=""></div>
                           </div>
                           <div class="chartjs-size-monitor-shrink">
                              <div class=""></div>
                           </div>
                        </div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
                        <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
                        <script>
                           var xValues =  ["Awaiting Acceptance", "Active Order", "Case On Hold", "Work Done"];
                           var yValues = [{{$panding_order}}, {{$Active}}, {{$caseOnHold}}, {{$Work_done}}];
                           var barColors = [
                             "#b91d47",
                             "#00aba9",
                             "#2b5797",
                             "#e8c3b9"
                           ];
                           
                           new Chart("myChart", {
                             type: "doughnut",
                             data: {
                               labels: xValues,
                               datasets: [{
                                 backgroundColor: barColors,
                                 data: yValues
                               }]
                             },
                             options: {
                               title: {
                                 display: true,
                                 text: ""
                               }
                             }
                           });
                        </script>
                     </div>
                  </div>
               </div>
               <div class="card card-danger">
                  <div class="card-header">
                     <h3 class="card-title">Donut Chart</h3>
                     <div class="card-tools">
                        <button class="btn btn-tool" type="button" data-card-widget="collapse">
                        <i class="fa fa-minus"></i>
                        </button>
                        <button class="btn btn-tool" type="button" data-card-widget="remove">
                        <i class="fa fa-times"></i>
                        </button>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="chart">
                        <div class="chartjs-size-monitor">
                           <div class="chartjs-size-monitor-expand">
                              <div class=""></div>
                           </div>
                           <div class="chartjs-size-monitor-shrink">
                              <div class=""></div>
                           </div>
                        </div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
                        <canvas id="myChart9" style="width:100%;max-width:600px"></canvas>
                        <script>
                           var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
                           var yValues = [55, 49, 44, 24, 15];
                           var barColors = [
                             "#b91d47",
                             "#00aba9",
                             "#2b5797",
                             "#e8c3b9",
                             "#1e7145"
                           ];
                           
                           new Chart("myChart9", {
                             type: "pie",
                             data: {
                               labels: xValues,
                               datasets: [{
                                 backgroundColor: barColors,
                                 data: yValues
                               }]
                             },
                             options: {
                               title: {
                                 display: true,
                                 text: "World Wide Wine Production 2018"
                               }
                             }
                           });
                        </script>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6">
              <!-- <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">Area chart</h3>
                     <div class="card-tools">
                        <button class="btn btn-tool" type="button" data-card-widget="collapse">
                        <i class="fa fa-minus"></i>
                        </button>
                        <button class="btn btn-tool" type="button" data-card-widget="remove">
                        <i class="fa fa-times"></i>
                        </button>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="chart">
                        <div class="chartjs-size-monitor">
                           <div class="chartjs-size-monitor-expand">
                              <div class=""></div>
                           </div>
                           <div class="chartjs-size-monitor-shrink">
                              <div class=""></div>
                           </div>
                        </div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
                        <canvas id="myChart4" style="width:100%;max-width:600px"></canvas>
                        <script>
                           var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
                           var yValues = [55, 49, 44, 24, 15];
                           var barColors = [
                             "#b91d47",
                             "#00aba9",
                             "#2b5797",
                             "#e8c3b9",
                             "#1e7145"
                           ];
                           
                           new Chart("myChart4", {
                             type: "doughnut",
                             data: {
                               labels: xValues,
                               datasets: [{
                                 backgroundColor: barColors,
                                 data: yValues
                               }]
                             },
                             options: {
                               title: {
                                 display: true,
                                 text: "World Wide Wine Production 2018"
                               }
                             }
                           });
                        </script>
                     </div>
                  </div>
               </div>-->
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">Order Listing {{date('Y')}}</h3>
                     <div class="card-tools">
                        <button class="btn btn-tool" type="button" data-card-widget="collapse">
                        <i class="fa fa-minus"></i>
                        </button>
                        <button class="btn btn-tool" type="button" data-card-widget="remove">
                        <i class="fa fa-times"></i>
                        </button>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="chart">
                        <div class="chartjs-size-monitor">
                           <div class="chartjs-size-monitor-expand">
                              <div class=""></div>
                           </div>
                           <div class="chartjs-size-monitor-shrink">
                              <div class=""></div>
                           </div>
                        </div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
                        <canvas id="myChart8" style="width:100%;max-width:600px"></canvas>
                        @php
                        $kan= array();
                        $i = 1;
                        for ($i = 0; $i < 12; $i++) {
                           $kan[] = DB::table('order_details')->whereMonth('date', '=',$i)->count();;
                           }
                           @endphp
                          
                        <script>
                           var xValues = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                           var yValues = [{{$kan[0]}}, {{$kan[1]}},{{$kan[2]}},{{$kan[3]}},{{$kan[4]}},{{$kan[5]}},{{$kan[6]}},{{$kan[7]}},{{$kan[8]}},{{$kan[9]}},{{$kan[10]}},{{$kan[11]}},];
                           var barColors = ["red", "green","blue","orange","brown","red", "green","blue","orange","brown","green","blue"];
                           
                           new Chart("myChart8", {
                             type: "bar",
                             data: {
                               labels: xValues,
                               datasets: [{
                                 backgroundColor: barColors,
                                 data: yValues
                               }]
                             },
                             options: {
                               legend: {display: false},
                               title: {
                                 display: true,
                                 text: ""
                               }
                             }
                           });
                        </script>
                     </div>
                  </div>
               </div>
               <div class="card card-primary">
                  <div class="card-header">
                     <h3 class="card-title">Area chart</h3>
                     <div class="card-tools">
                        <button class="btn btn-tool" type="button" data-card-widget="collapse">
                        <i class="fa fa-minus"></i>
                        </button>
                        <button class="btn btn-tool" type="button" data-card-widget="remove">
                        <i class="fa fa-times"></i>
                        </button>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="chart">
                        <div class="chartjs-size-monitor">
                           <div class="chartjs-size-monitor-expand">
                              <div class=""></div>
                           </div>
                           <div class="chartjs-size-monitor-shrink">
                              <div class=""></div>
                           </div>
                        </div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
                        <canvas id="myChart6" style="width:100%;max-width:600px"></canvas>
                        <script>
                           var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
                           var yValues = [55, 49, 44, 24, 15];
                           var barColors = [
                             "#b91d47",
                             "#00aba9",
                             "#2b5797",
                             "#e8c3b9",
                             "#1e7145"
                           ];
                           
                           new Chart("myChart6", {
                             type: "doughnut",
                             data: {
                               labels: xValues,
                               datasets: [{
                                 backgroundColor: barColors,
                                 data: yValues
                               }]
                             },
                             options: {
                               title: {
                                 display: true,
                                 text: "World Wide Wine Production 2018"
                               }
                             }
                           });
                        </script>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
         
      </div>
   </section>
  
   
</div>
<style>
   .card-title {
   float: left;
   font-size: 1.1rem;
   font-weight: 400;
   margin: 0;
   }
   .card {
   word-wrap: break-word;
   }
   .chartjs-render-monitor {
   animation: chartjs-render-animation 1ms;
</style>

<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fullcalendar/main.css">
<script src="https://adminlte.io/themes/v3/plugins/fullcalendar/main.js"></script>
<script>
    $(function () {

        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
            ele.each(function () {

                // create an Event Object (https://fullcalendar.io/docs/event-object)
                // it doesn't need to have a start or end
               
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                }
     
                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject)

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                })

            })
        }

        ini_events($('#external-events div.external-event'))

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()

        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;

        var containerEl = document.getElementById('external-events');
        var checkbox = document.getElementById('drop-remove');
        var calendarEl = document.getElementById('calendar');

        // initialize the external events
        // -----------------------------------------------------------------

        new Draggable(containerEl, {
            itemSelector: '.external-event',
            eventData: function (eventEl) {
                 $("#value").val(eventEl.innerText)
                 
                return {
                    title: eventEl.innerText,
                  
                    backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                    borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                    textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                };
            }
        });

        var calendar = new Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',
            //Random default events
            events: [
                {
                    title: 'All Day Event',
                    start: new Date(y, m, 1),
                    backgroundColor: '#f56954', //red
                    borderColor: '#f56954', //red
                    allDay: true
                },
                {
                    title: 'Long Event',
                    start: new Date(y, m, d - 5),
                    end: new Date(y, m, d - 2),
                    backgroundColor: '#f39c12', //yellow
                    borderColor: '#f39c12' //yellow
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false,
                    backgroundColor: '#0073b7', //Blue
                    borderColor: '#0073b7' //Blue
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false,
                    backgroundColor: '#00c0ef', //Info (aqua)
                    borderColor: '#00c0ef' //Info (aqua)
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d + 1, 19, 0),
                    end: new Date(y, m, d + 1, 22, 30),
                    allDay: false,
                    backgroundColor: '#00a65a', //Success (green)
                    borderColor: '#00a65a' //Success (green)
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'https://www.google.com/',
                    backgroundColor: '#3c8dbc', //Primary (light-blue)
                    borderColor: '#3c8dbc' //Primary (light-blue)
                }
            ],
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (info) {
                    let text = Object.values(info)
                    $("#value2").val(text)
                    sendCalenderData()
                // is the "remove after drop" checkbox checked?
                if (checkbox.checked) {
                  
                    // if so, remove the element from the "Draggable Events" list
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            }
        });

        
        calendar.render();
        // $('#calendar').fullCalendar()

        /* ADDING EVENTS */
        var currColor = '#3c8dbc' //Red by default
        // Color chooser button
        $('#color-chooser > li > a').click(function (e) {
            e.preventDefault()
            // Save color
            currColor = $(this).css('color')
            // Add color effect to button
            $('#add-new-event').css({
                'background-color': currColor,
                'border-color': currColor
            })
        })
        
        
        function sendCalenderData(){
            var value1 = $('#value').val();
            var value2 = $('#value2').val();
            let text = value2;
            const myArray = text.split(",");
                let date = myArray[1];
           $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
		            $.ajax({
                     	url:'/school_calender_add',
					type:'post',
				  data: {
				date: date,
                message: value1,
              
            },
               
                success: function(result) {
                   // var result = JSON.parse(result);
                
                    if (result) {

                      //  toastr.success(result.msg);
                        //	$('.todoList').html(result)
                        	alert("done");
                      
                    } else {
                       // toastr.error(result.msg);
                    }
                }
            })
        }
        $('#add-new-event').click(function (e) {
            e.preventDefault()
            // Get value and make sure it is not null
            var val = $('#new-event').val()
           
            if (val.length == 0) {
                return
            }

            // Create events
            var event = $('<div />')
            event.css({
                'background-color': currColor,
                'border-color': currColor,
                'color': '#fff'
            }).addClass('external-event')
            event.text(val)
            $('#external-events').prepend(event)

            // Add draggable funtionality
            ini_events(event)

            // Remove event from text input
            $('#new-event').val('')
        })
    })
</script>
@endsection