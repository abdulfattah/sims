<div class="text-right">
    <button type="button" id="add-note" class="btn btn-sm btn-primary" style="height: 33px">
        Create Note
    </button>
</div>
<table class="table table-responsive-sm table-sm mt-3">
    <thead>
        <tr>
            <th style="width: 65%;">Title</th>
            <th style="width: 20%;">Note By</th>
            <th style="width: 12%;">Date</th>
            <th style="width: 70px">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tax->notes as $note)
        <tr>
            <td><a href="javascript:void(0)" data-id="{!! $note->id !!}" class="show-note">{!! $note->note_title !!}</a></td>
            <td>{!! $note->writer != null ? $note->writer->fullname : null !!}</td>
            <td>{!! $note->created_at != null ? date('d-M-Y h:i:s A', strtotime($note->created_at)) : null !!}</td>
            <th style="text-align: right">
                <a href="javascript:void(0)" data-id="{!! $note->id !!}" class="edit-note"><i class="c-icon cil-pencil"></i></a>
                <a href="javascript:void(0)" data-id="{!! $note->id !!}" data-tax-id="{!! $note->tax_record_id !!}" class="delete-note"><i class="c-icon cil-trash text-danger"></i></a>
            </th>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="modal fade" id="modal-note" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="margin: 10px auto;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="title-note" class="modal-title">Add Note</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{!! \URL::to('tax?section=note') !!}" id="form-note" class="form-horizontal" enctype="multipart/form-data" novalidate>
                    @csrf
                    <input type="hidden" name="tax_record_id" value="{!! $tax->id !!}" />
                    <input id="method-note" type="hidden" name="_method" value="" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Title</label>
                                <div data-dx="textbox" data-case="lowercase" data-name="note_title" data-mode="text" data-validate="true" data-validation-type="required" data-validation-group="note"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" style="height:350px">
                                <label for="name">Note</label>
                                <div id="quill-note"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-ghost-danger" data-dismiss="modal">Cancel</button>
                <div data-dx="btn-submit" data-type="default" data-text="Submit" data-disabled="false" data-validation-group="note" data-form="form-note"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-show-note" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" style="margin: 10px auto;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="title-note" class="modal-title">Show Note</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name" style="font-weight: bold">Title</label>
                            <div id="show-title"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" style="height:350px">
                            <label for="name" style="font-weight: bold">Note</label>
                            <div id="show-note"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-ghost-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@section('page-css')
<style>
    #quill-note {
        height: 84%;
    }
</style>
@stop

@section('page-script')
<script type="text/javascript">
    $(document).ready(function () {  
        var quill = new Quill('#quill-note', {
            placeholder: 'Type your note here...',
            theme: 'snow'
        });

        $("#form-note").on("submit", function () {
            $(this).append("<textarea name='note' style='display:none'>" + $('.ql-editor')[0].innerHTML + "</textarea>");
        });
});
</script>
@stop