@extends("main")

@section("content")
    <div class="card">
        <div class="card-body">
            <div class="float-right" style="display: flex;flex-direction: row;">
                <button type="button" class="btn btn-sm btn-primary waves-effect waves-themed mr-1 grid-btn-refresh" data-for="push_report">Reset List</button>
                <button type="button" class="btn btn-sm btn-primary waves-effect waves-themed mr-1 grid-btn-excel" data-for="push_report">Export</button>
            </div>
            <div class="table-responsive" style="background-color: #ffffff">
                <div id="grid" data-for="push_report"></div>
            </div>
            @csrf
        </div>
    </div>
@stop
