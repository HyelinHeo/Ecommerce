@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header content-header{{setting('fixed_header')}}">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{trans('lang.dashboard')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{trans('lang.dashboard')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('lang.dashboard')}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-2 col-6">
                <!-- small box all success-->
                <div class="small-box bg-info">
                    <div class="inner">
                        @if(setting('currency_right', false) != false)
                            <h4>{!!$all_price!!}</h4>
                        @else
                            <h4>{!!$all_price!!}</h4>
                        @endif

                        <p>{{trans('lang.dashboard_total_price')}} <span style="font-size: 11px">({{trans('lang.dashboard_after taxes')}})</span></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money"></i>
                    </div>
                    <a href="{!! route('orders.index') !!}" class="small-box-footer">{{trans('lang.dashboard_more_info')}}
                        <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box shipping price-->
                <div class="small-box bg-success">
                    <div class="inner">
                        @if(setting('currency_right', false) != false)
                            <h4>{!!$shipping_price!!}</h4>
                        @else
                            <h4>{!!$shipping_price!!}</h4>
                        @endif
                        <p>{{trans('lang.dashboard_total_shipping_price')}} <span style="font-size: 11px">({{trans('lang.dashboard_after taxes')}})</span></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-ship"></i>
                    </div>
                    <a href="{!! route('markets.index') !!}" class="small-box-footer">{{trans('lang.dashboard_more_info')}}
                        <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box pickup price-->
                <div class="small-box bg-success">
                    <div class="inner">
                        @if(setting('currency_right', false) != false)
                            <h4>{!!$pickup_price!!}</h4>
                        @else
                            <h4>{!!$pickup_price!!}</h4>
                        @endif

                        <p>{{trans('lang.dashboard_total_pickup_price')}} <span style="font-size: 11px">({{trans('lang.dashboard_after taxes')}})</span></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cube"></i>
                    </div>
                    <a href="{!! route('payments.index') !!}" class="small-box-footer">{{trans('lang.dashboard_more_info')}}
                        <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box business profit-->
                <div class="small-box bg-success">
                    <div class="inner">
                        @if(setting('currency_right', false) != false)
                            <h4>{!!$add_price!!}</h4>
                        @else
                            <h4>{!!$add_price!!}</h4>
                        @endif

                        <p>{{trans('lang.dashboard_total_add_price')}}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money"></i>
                    </div>
                    <a href="{!! route('users.index') !!}" class="small-box-footer">{{trans('lang.dashboard_more_info')}}
                        <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box business profit-->
                <div class="small-box bg-warning">
                    <div class="inner">
                        @if(setting('currency_right', false) != false)
                            <h4>{!!$business_profit!!}</h4>
                        @else
                            <h4>{!!$business_profit!!}</h4>
                        @endif

                        <p>{{trans('lang.dashboard_total_business_profit')}}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-line-chart"></i>
                    </div>
                    <a href="{!! route('users.index') !!}" class="small-box-footer">{{trans('lang.dashboard_more_info')}}
                        <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

        </div>
        <!-- /.row -->

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-2 col-6">
                <!-- small box pickup price-->
                <div class="small-box bg-danger">
                    <div class="inner">
                        @if(setting('currency_right', false) != false)
                            <h4>{!!$cancel_order_price!!}</h4>
                        @else
                            <h4>{!!$cancel_order_price!!}</h4>
                        @endif

                        <p>{{trans('lang.dashboard_cancel_total_price')}} <span style="font-size: 11px">({{trans('lang.dashboard_after taxes')}})</span></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-money"></i>
                    </div>
                    <a href="{!! route('watchdogPayments.index') !!}" class="small-box-footer">{{trans('lang.dashboard_more_info')}}
                        <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box shipping price-->
                <div class="small-box bg-danger">
                    <div class="inner">
                        @if(setting('currency_right', false) != false)
                            <h4>{!!$cancel_shipping_price!!}</h4>
                        @else
                            <h4>{!!$cancel_shipping_price!!}</h4>
                        @endif
                        <p>{{trans('lang.dashboard_cancel_total_shipping_price')}} <span style="font-size: 11px">({{trans('lang.dashboard_after taxes')}})</span></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-ship"></i>
                    </div>
                    <a href="{!! route('watchdogOrders.index') !!}" class="small-box-footer">{{trans('lang.dashboard_more_info')}}
                        <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-2 col-6">
                <!-- small box business profit-->
                <div class="small-box bg-danger">
                    <div class="inner">
                        @if(setting('currency_right', false) != false)
                            <h4>{!!$cancel_pickup_price!!}</h4>
                        @else
                            <h4>{!!$cancel_pickup_price!!}</h4>
                        @endif

                        <p>{{trans('lang.dashboard_cancel_total_pickup_price')}} <span style="font-size: 11px">({{trans('lang.dashboard_after taxes')}})</span></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cube"></i>
                    </div>
                    <a href="{!! route('watchdogOrders.index') !!}" class="small-box-footer">{{trans('lang.dashboard_more_info')}}
                        <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

        </div>

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box all price-->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$cancel_orders_count}}</h3>

                        <p>{{trans('lang.dashboard_watchdog_order_count')}}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-bag"></i>
                    </div>
                    <a href="{!! route('watchdogOrders.index') !!}" class="small-box-footer">{{trans('lang.dashboard_more_info')}}
                        <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box all price-->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$watchdog_photos_count}}</h3>

                        <p>{{trans('lang.dashboard_watchdog_photo_count')}}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-photo"></i>
                    </div>
                    <a href="{!! route('watchdogPhotos.index') !!}" class="small-box-footer">{{trans('lang.dashboard_more_info')}}
                        <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header no-border">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">{{trans('lang.earning_plural')}}</h4>
                            <a href="{!! route('payments.index') !!}">{{trans('lang.dashboard_view_all_payments')}}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                @if(setting('currency_right', false) != false)
                                    <span class="text-bold text-lg">{{$earning}}</span>
                                @else
                                    <span class="text-bold text-lg">{{$earning}}</span>
                                @endif
                                <span>{{trans('lang.dashboard_earning_over_time')}}</span>
                            </p>
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-success"> {{$ordersCount}}</span></span>
                                <span class="text-muted">{{trans('lang.dashboard_total_orders')}}</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->

                        <div class="position-relative mb-4">
                            <canvas id="sales-chart" height="200"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2"> <i class="fa fa-square text-primary"></i> {{trans('lang.dashboard_this_year')}} </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header no-border">
                        <h4 class="card-title">{{trans('lang.user_feedback_plural')}}</h4>
                        <div class="card-tools">
                            <a href="{{route('watchdogUserFeedback.index')}}" class="btn btn-tool btn-sm"><i class="fa fa-bars"></i> </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                            <tr>
                                <th>{{trans('lang.user_feedback_type')}}</th>
                                <th>{{trans('lang.user_feedback_user')}}</th>
                                <th>{{trans('lang.user_feedback_done')}}</th>
                                <th>{{trans('lang.view_details')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user_feedback as $feedback)

                                <tr>
                                    <td>
                                        <?php
                                        $type="";
                                        switch ( $feedback->type ) {
                                            case 0:
                                                $type=trans('lang.user_feedback_table_error');
                                                break;
                                            case 1:
                                                $type=trans('lang.user_feedback_table_opinion');
                                                break;
                                            case 2:
                                                $type=trans('lang.user_feedback_table_proposal');
                                                break;
                                            case 3:
                                                $type=trans('lang.user_feedback_table_translation');
                                                break;
                                            case 4:
                                                $type=trans('lang.user_feedback_table_withdrawal');
                                                break;
                                            case 5:
                                                $type=trans('lang.user_feedback_table_duplicate_email_report');
                                                break;
                                            default:
                                                $type=trans('lang.user_feedback_table_others');
                                          }
                                        echo $type;
                                        ?>
                                        </td>
                                    <td>
                                        {!! $feedback->email !!}
                                    </td>
                                    <td>
                                        {!! getDoneColumn($feedback, 'done') !!}
                                    </td>
                                    <td class="text-center">
                                        <a href="{!! route('watchdogUserFeedback.show',$feedback->id) !!}" class="text-muted"> <i class="fa fa-eye"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts_lib')
    <script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
@endpush
@push('scripts')
    <script type="text/javascript">
        var data = [1000, 2000, 3000, 2500, 2700, 2500, 3000];
        var labels = ['JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];

        function renderChart(chartNode, data, labels) {
            var ticksStyle = {
                fontColor: '#495057',
                fontStyle: 'bold'
            };

            var mode = 'index';
            var intersect = true;
            return new Chart(chartNode, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            backgroundColor: '#007bff',
                            borderColor: '#007bff',
                            data: data
                        }
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: mode,
                        intersect: intersect
                    },
                    hover: {
                        mode: mode,
                        intersect: intersect
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            // display: false,
                            gridLines: {
                                display: true,
                                lineWidth: '4px',
                                color: 'rgba(0, 0, 0, .2)',
                                zeroLineColor: 'transparent'
                            },
                            ticks: $.extend({
                                beginAtZero: true,

                                // Include a dollar sign in the ticks
                                callback: function (value, index, values) {
                                    @if(setting('currency_right', '0') == '0')
                                        return " "+value;
                                    @else
                                        return value+" ";
                                        @endif

                                }
                            }, ticksStyle)
                        }],
                        xAxes: [{
                            display: true,
                            gridLines: {
                                display: false
                            },
                            ticks: ticksStyle
                        }]
                    }
                }
            })
        }

        $(function () {
            'use strict'

            var $salesChart = $('#sales-chart')
            $.ajax({
                url: "{!! $ajaxEarningUrl !!}",
                success: function (result) {
                    $("#loadingMessage").html("");
                    var data = result.data[0];
                    var labels = result.data[1];
                    renderChart($salesChart, data, labels)
                },
                error: function (err) {
                    $("#loadingMessage").html("Error");
                }
            });
            //var salesChart = renderChart($salesChart, data, labels);
        })

    </script>
@endpush