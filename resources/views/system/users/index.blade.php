@extends("main")

@section("content")
<div class="card">
    <div class="card-header">
        <div class="mt-1 float-left">
            <strong>User's Information</strong>
        </div>
        <div class="float-right" style="display: flex;flex-direction: row;">
            <button class="btn btn-primary btn-sm grid-btn-plus" type="button" style="margin-right: 4px;" data-for="users">
                <svg class="c-icon">
                    <use xlink:href="{!! asset('icons/free.svg#cil-plus') !!}"></use>
                </svg>
            </button>
            <div data-dx="tooltip" class="d-none">Add New User</div>
            <button class="btn btn-primary btn-sm grid-btn-refresh" type="button" style="margin-right: 4px;" data-for="users">
                <svg class="c-icon">
                    <use xlink:href="{!! asset('icons/free.svg#cil-reload') !!}"></use>
                </svg>
            </button>
            <div data-dx="tooltip" class="d-none">Reset List</div>
            <button class="btn btn-primary btn-sm grid-btn-excel" type="button" style="margin-right: 4px;" data-for="users">
                <svg class="c-icon">
                    <use xlink:href="{!! asset('icons/free.svg#cil-cloud-download') !!}"></use>
                </svg>
            </button>
            <div data-dx="tooltip" class="d-none">Download Excel</div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive" style="background-color: #ffffff">
            <div id="grid" data-for="users"></div>
        </div>
        @csrf
    </div>
</div>
@stop