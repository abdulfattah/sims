@extends("main")

@section("content")
<div class="row">
    <div class="col-sm-12 col-lg-4">
        <div class="card text-white bg-gradient-success">
            <div class="card-body">
                <div class="text-value-lg">{{ $totalRegistered }}</div>
                <div>Total Registered</div>
                <small class="text-muted">Total registration company</small>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="card text-white bg-gradient-danger">
            <div class="card-body">
                <div class="text-value-lg">{{ $totalCancelled }}</div>
                <div>Total Cancellation</div>
                <small class="text-muted">Total cancellation</small>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="card text-white bg-gradient-warning">
            <div class="card-body">
                <div class="text-value-lg">{{ $totalApplyForCancelled }}</div>
                <div>Request For Cancellation</div>
                <small class="text-muted">Total request for cancellation</small>
            </div>
        </div>
    </div>
</div>
@stop