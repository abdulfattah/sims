<div class="text-right">
    <button type="button" id="add-note" class="btn btn-sm btn-primary" style="height: 33px">
        Create Note
    </button>
</div>
<table class="table table-responsive-sm table-sm mt-3">
    <thead>
        <tr>
            <th>Note</th>
            <th style="width: 300px;">Note By</th>
            <th style="width: 180px;">Date</th>
            <th style="width: 70px">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tax->notes as $note)
        <tr>
            <td>{!! $note->note !!}</td>
            <td>{!! $note->writer != null ? $note->writer->fullname : null !!}</td>
            <td>{!! $note->created_at != null ? date('d-M-Y h:i:s A', strtotime($note->created_at)) : null !!}</td>
            <th style="text-align: right">
                <a href="javascript:void(0)" data-id="{!! $note->id !!}" class="edit-note"><i class="c-icon cil-pencil"></i></a>
                <a href="javascript:void(0)" data-id="{!! $note->id !!}" class="delete-note"><i class="c-icon cil-trash text-danger"></i></a>
            </th>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="modal fade" id="modal-note" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="margin: 10px auto;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="title-note" class="modal-title">Add Note</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{!! \URL::to('note') !!}" id="form-note" class="form-horizontal" novalidate>
                    @csrf
                    <input type="hidden" name="tax_record_id" value="{!! $tax->id !!}" />
                    <input id="method-note" type="hidden" name="_method" value="" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div data-dx="textarea" data-name="note" data-height="200" data-validate="true" data-validation-type="required" data-validation-group="note"
                                        data-value="{!! \Request::old('description', isset($tax) ? $tax->description : NULL) !!}"></div>
                                </div>
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