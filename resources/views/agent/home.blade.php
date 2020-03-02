@extends('layouts.agents_app')

@section('content')

    <div class="row">
        <div class="col-sm-2 col-xs-6">

            <div class="tile-stats tile-green">
                <div class="icon"><i class="fa fa-calendar"></i></div>
                <div class="num" data-start="0" data-end="83" data-postfix="" data-duration="1500" data-delay="0">
                    0
                </div>

                <h3>% Target</h3>
                <p>Deliveries on or before target date.</p>
            </div>

        </div>

        <div class="col-sm-2 col-xs-6">

            <div class="tile-stats tile-red">
                <div class="icon"><i class="fa fa-calendar-times-o"></i></div>
                <div class="num" data-start="0" data-end="135" data-postfix="" data-duration="1500"
                     data-delay="600">0
                </div>

                <h3>% Missed</h3>
                <p>Deliveries missed the target date.</p>
            </div>

        </div>

        <div class="clear visible-xs"></div>

        <div class="col-sm-2 col-xs-6">

            <div class="tile-stats tile-purple">
                <div class="icon"><i class="fa fa-star-half-full"></i></div>
                <div class="num" data-start="0" data-end="23" data-postfix="" data-duration="1500"
                     data-delay="1200">0
                </div>

                <h3>Partial</h3>
                <p>Partial delivery of Delivery Receipt.</p>
            </div>

        </div>

        <div class="col-sm-2 col-xs-6">

            <div class="tile-stats tile-orange">
                <div class="icon"><i class="fa fa-trophy"></i></div>
                <div class="num" data-start="0" data-end="52" data-postfix="" data-duration="1500"
                     data-delay="1800">0
                </div>

                <h3>Fullfilled</h3>
                <p>Full delivery of Delivery Receipt.</p>
            </div>

        </div>
        <div class="col-sm-2 col-xs-6">

            <div class="tile-stats tile-blue">
                <div class="icon"><i class="fa fa-truck"></i></div>
                <div class="num" data-start="0" data-end="52" data-postfix="" data-duration="1500"
                     data-delay="1800">0
                </div>

                <h3>Delivered</h3>
                <p>Total delivered Delivery Receipt.</p>
            </div>

        </div>
        <div class="col-sm-2 col-xs-6">

            <div class="tile-stats tile-pink">
                <div class="icon"><i class="fa fa-question-circle"></i></div>
                <div class="num" data-start="0" data-end="52" data-postfix="" data-duration="1500"
                     data-delay="1800">0
                </div>

                <h3>Pending</h3>
                <p>Total pending Delivery Receipt.</p>
            </div>

        </div>
    </div>
@endsection
