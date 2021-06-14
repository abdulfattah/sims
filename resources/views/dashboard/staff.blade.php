@extends("main")

@section("content")
    <div class="row">
        <div class="col-sm-6 col-xl-4">
            <div class="p-3 bg-primary-300 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        {{ $totalRegistered }}
                        <small class="m-0 l-h-n">Total registration company</small>
                    </h3>
                </div>
                <i class="fal fa-user position-absolute pos-right pos-bottom opacity-15 mb-n1 mr-n1" style="font-size:6rem"></i>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="p-3 bg-danger-400 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        {{ $totalCancelled }}
                        <small class="m-0 l-h-n">Total cancellation</small>
                    </h3>
                </div>
                <i class="fal fa-trash position-absolute pos-right pos-bottom opacity-15  mb-n1 mr-n4" style="font-size: 6rem;"></i>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="p-3 bg-warning-200 rounded overflow-hidden position-relative text-white mb-g">
                <div class="">
                    <h3 class="display-4 d-block l-h-n m-0 fw-500">
                        {{ $totalApplyForCancelled }}
                        <small class="m-0 l-h-n">Total request for cancellation</small>
                    </h3>
                </div>
                <i class="fal fa-sad-tear position-absolute pos-right pos-bottom opacity-15 mb-n5 mr-n6" style="font-size: 8rem;"></i>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-xl-6">
            <div class="p-3 bg-white rounded">
                <div id="chart_risk_entity"></div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-6">
            <div class="p-3 bg-white rounded">
                <div id="chart_risk_person"></div>
            </div>
        </div>
    </div>
@stop

@section('page-script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#chart_risk_entity").dxPieChart({
                size: {
                    width: 500
                },
                palette: "bright",
                dataSource: {!! $chartEntity !!},
                series: [
                    {
                        argumentField: "risk",
                        valueField: "total",
                        label: {
                            visible: true,
                            connector: {
                                visible: true,
                                width: 1
                            }
                        }
                    }
                ],
                title: "Risiko Entiti Cukai Jualan",
                "export": {
                    enabled: true
                },
                onPointClick: function (e) {
                    var point = e.target;

                    toggleVisibility(point);
                },
                onLegendClick: function (e) {
                    var arg = e.target;

                    toggleVisibility(this.getAllSeries()[0].getPointsByArg(arg)[0]);
                }
            });

            $("#chart_risk_person").dxPieChart({
                size: {
                    width: 500
                },
                palette: "bright",
                dataSource: {!! $chartPerson !!},
                series: [
                    {
                        argumentField: "risk",
                        valueField: "total",
                        label: {
                            visible: true,
                            connector: {
                                visible: true,
                                width: 1
                            }
                        }
                    }
                ],
                title: "Risiko Orang Berdaftar",
                "export": {
                    enabled: true
                },
                onPointClick: function (e) {
                    var point = e.target;

                    toggleVisibility(point);
                },
                onLegendClick: function (e) {
                    var arg = e.target;

                    toggleVisibility(this.getAllSeries()[0].getPointsByArg(arg)[0]);
                }
            });

            function toggleVisibility(item) {
                if (item.isVisible()) {
                    item.hide();
                } else {
                    item.show();
                }
            }
        });
    </script>
@stop
