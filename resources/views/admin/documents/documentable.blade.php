<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <span><i class="fa fa-image"></i></span>
                    <span>{!! $documentable->name !!} Documents</span>
                </h3>
            </div>

            <div class="box-body documents-container">
                <div class="row">
                    @forelse($documents as $document)
                        <div class="col-md-12">
                            <div class="well">
                                <a class="btn btn-info btn-xs" href="{{ $document->url }}" target="_blank" title="View Document" data-toggle="tooltip">
                                    <i class="fa fa-eye"></i>
                                </a>
                                &nbsp; &nbsp; &nbsp; &nbsp;
                                <a id="image-row-clicker-{{ $document->id }}" class="dropzone-document-click" href="#" data-id="{{ $document->id }}" data-title="{{ $document->name }}">
                                    <span id="image-row-title-span-{{ $document->id }}" class="image-row-title-span">{{ $document->name }}</span>
                                </a>
                                  &nbsp; &nbsp; &nbsp; &nbsp;
                                <form id="form-delete-row{{ $document->id }}" method="POST" action="/admin/documents/{{ $document->id }}" class="dt-titan" style="display: inline-block;">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                    <input name="_id" type="hidden" value="{{ $document->id }}">

                                    <a data-form="form-delete-row{{ $document->id }}" class="btn btn-danger btn-xs btn-delete-row" data-toggle="tooltip" title="Delete document - {{ $document->name }}"
                                       style="padding: 0px 6px;">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <p class="text-muted">Please click on the panel below to upload
                                documents
                                to {!! $documentable->name !!}.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>



@section('scripts')
    @parent

    <script type="text/javascript" charset="utf-8">
        Dropzone.autoDiscover = false;
        $(function () {
            activateImageClick();
            initActionDeleteClick($('.documents-container'));

            // autodiscover was turned off - update the settings
            var documentDropzone = new Dropzone("#formDocumentDropzone");
            documentDropzone.options.maxFiles = "10";
            documentDropzone.options.maxFilesize = "5";
            documentDropzone.options.paramName = "file";
            documentDropzone.previewTemplate = $('#preview-template').html();
            documentDropzone.on("success", function (file, response) {
                if (response.data && response.success) {
                    var data = response.data;

                    file.hiddenInputs = Dropzone.createElement('<input class="image-row-title" type="hidden" value=""/>');
                    file.previewElement.appendChild(file.hiddenInputs);
                    file.hiddenInputs = Dropzone.createElement('<input class="image-row-id" type="hidden" id="image-row-' + data['id'] + '" value="' + data['id'] + '"/>');
                    file.previewElement.appendChild(file.hiddenInputs);

                    notify('Successfully', 'The document has been uploaded and saved in the database.', null, null, 5000);
                } else {
                    notifyError(response.error['title'], response.error['content']);
                    //notifyError('Oops!', 'Something went wrong (hover over image for more information', null, null, 5000);
                }
            });

            function activateImageClick()
            {
                $('.dropzone-document-click').off('click');
                $('.dropzone-document-click').on('click', function (e) {
                    e.preventDefault();

                    var id = $($(this).parent().find('.image-row-id')).val();
                    var title = $($(this).parent().find('.image-row-title')).val();

                    if ($(this).attr('data-id')) {
                        id = $(this).attr('data-id');
                        title = $(this).attr('data-title');
                    }

                    $('#modal-document-id').val(id);
                    $('#modal-document-name').val(title);
                    $('#modal-document').modal();

                    return false;
                });
            }

            $('#btn-form-save-document').click(function (e) {
                e.preventDefault();

                $('#modal-document').modal('hide');

                if ($('#modal-document-name').val().length < 3) {
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: "/admin/documents/" + $('#modal-document-id').val() + '/edit/name',
                    data: {
                        'name': $('#modal-document-name').val()
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.error) {
                            notifyError(data.error.title, data.error.content);
                        } else {
                            notify('Successfully', 'The document name was updated.', null, null, 5000);
                        }

                        // update the title tag's input
                        var id = $('#modal-document-id').val();
                        var title = $('#modal-document-name').val();
                        var idInput = $('#image-row-' + id);

                        idInput.parent().find('.image-row-title-span').html(title);
                        $('#image-row-title-span-' + id).html(title);
                        $('#image-row-clicker-' + id).attr('data-title', title);

                        // reset
                        $('#modal-document-name').val('');
                    }
                });
            })
        })
    </script>
@endsection