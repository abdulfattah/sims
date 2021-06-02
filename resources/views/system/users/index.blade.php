@extends("main")

@section("content")
    <div class="card">
        <div class="card-body">
            <div class="float-right" style="display: flex;flex-direction: row;">
                <button type="button" class="btn btn-sm btn-primary waves-effect waves-themed mr-1 grid-btn-plus" data-for="users">Add New User</button>
                <button type="button" class="btn btn-sm btn-primary waves-effect waves-themed mr-1 grid-btn-refresh" data-for="users">Reset List</button>
                <button type="button" class="btn btn-sm btn-primary waves-effect waves-themed mr-1 grid-btn-excel" data-for="users">Export</button>
            </div>
            @if ($trashed)
                <div class="text-danger text-center">DISPLAY ALL TRASHED ITEM</div> @endif
            <div class="table-responsive" style="background-color: #ffffff">
                <div id="grid" data-for="users" data-trashed="{{ $trashed }}"></div>
            </div>
            @csrf
        </div>
    </div>
@stop
