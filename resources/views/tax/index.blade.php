@extends("main")

@section("content")
    <div class="card">
        <div class="card-body">
            <div class="float-right" style="display: flex;flex-direction: row;">
                <button type="button" class="btn btn-sm btn-primary waves-effect waves-themed mr-1 grid-btn-sync" data-for="tax">Synchronizing Tax</button>
                <button type="button" class="btn btn-sm btn-primary waves-effect waves-themed mr-1 grid-btn-refresh" data-for="tax">Reset List</button>
                <button type="button" class="btn btn-sm btn-primary waves-effect waves-themed mr-1 grid-btn-column" data-for="tax">Column Chooser</button>
                <button type="button" class="btn btn-sm btn-primary waves-effect waves-themed mr-1 grid-btn-excel" data-for="tax">Export</button>
            </div>
            @if ($trashed)
                <div class="text-danger text-center">DISPLAY ALL TRASHED ITEM</div> @endif
            <div class="table-responsive" style="background-color: #ffffff">
                <div id="grid" data-for="tax" data-trashed="{{ $trashed }}"></div>
            </div>
            @csrf
        </div>
    </div>
@stop
