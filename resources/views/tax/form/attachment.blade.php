<div class="text-right">
    <button type="button" id="upload-attachment" class="btn btn-sm btn-primary" style="height: 33px">
        Upload
    </button>
</div>
<table class="table table-responsive-sm table-sm mt-3">
    <thead>
        <tr>
            <th style="width: 250px;">Title</th>
            <th>Description</th>
            <th style="width: 200px;">Upload By</th>
            <th style="width: 180px;">Datetime</th>
            <th style="width: 70px;">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tax->attachments as $attachment)
        <tr>
            <td><a href="{!! URL::to('asset/file?in=attachment' . DIRECTORY_SEPARATOR . $attachment->for_id .'&filename=' .
                                                      \App\Libs\App::getFilename('attachment', $attachment) . '&actualname=' .
                                                      $attachment->asset_name) !!}" target="_blank">{!! $attachment->title !!}</a></td>
            <td>{!! $attachment->description !!}</td>
            <td>{!! $attachment->uploader != null ? $attachment->uploader->fullname : null !!}</td>
            <td>{!! $attachment->created_at != null ? date('d-M-Y h:i:s A', strtotime($attachment->created_at)) : null !!}</td>
            <th style="text-align: right">
                <a href="javascript:void(0)" data-id="{!! $attachment->id !!}" class="edit-attachment"><i class="c-icon cil-pencil"></i></a>
                <a href="javascript:void(0)" data-id="{!! $attachment->id !!}" class="delete-attachment"><i class="c-icon cil-trash text-danger"></i></a>
            </th>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="modal fade" id="modal-attachment" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="margin: 10px auto;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="title-attachment" class="modal-title">Upload Attachment</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{!! \URL::to('attachment') !!}" id="form-attachment" class="form-horizontal" enctype="multipart/form-data" novalidate>
                    @csrf
                    <input type="hidden" name="tax_record_id" value="{!! $tax->id !!}" />
                    <input id="method-attachment" type="hidden" name="_method" value="" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Title</label>
                                <div class="col-md-8">
                                    <div data-dx="textbox" data-name="title" data-mode="text" data-value=""></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">Description</label>
                                <div class="col-md-8">
                                    <div data-dx="textarea" data-name="description" data-height="150" data-value=""></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label">File</label>
                                <div class="col-md-8">
                                    <div data-dx="fileuploader" data-name="filename" data-multiple="false" data-mode="useForm" data-validate="true" data-validation-type="required"
                                        data-validation-group="attachment"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-ghost-danger" data-dismiss="modal">Cancel</button>
                <div data-dx="btn-submit" data-type="default" data-text="Upload" data-disabled="false" data-validation-group="attachment" data-form="form-attachment"></div>
            </div>
        </div>
    </div>
</div>