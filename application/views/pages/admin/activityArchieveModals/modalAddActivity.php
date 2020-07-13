<form class="was-validated" novalidate>
    <div class="modal fade" id="modalAddActivity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-info modal-notify " role="document">
            <div class="modal-content">
                <div class="modal-header white-text text-center">
                    <h4 class="modal-title w-100 font-weight-bold" id="myModalLabel">Tambah Laporan Kegiatan</h4>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <div class="modal-body container">

                    <div class="row mb-3">
                        <div class="col">
                            <label>Nama Perpustakaan</label>
                            <select class="custom-select d-block w-100" id="library-name-add" required></select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Nama Kegiatan</label>
                            <input type="text" class="form-control" id="activity-name-add" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Tempat Kegiatan</label>
                            <input type="text" class="form-control" id="activity-place-add" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Deskripsi Kegiatan</label>
                            <textarea rows="4" type="text" class="form-control" id="activity-description-add" required></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Tanggal Kegiatan</label>
                            <input type="date" class="form-control" id="activity-date-add" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label>Jumlah Peserta</label>
                            <input type="number" class="form-control" id="activity-attendant-add" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col" id="photo-attachment-col">
                            <label>Lampiran Foto</label>
                            <div class="row align-top">
                                <div class="col mb-2">
                                    <a id="btn-add-photo-attachment" type="button" class=" btn-no-margin btn btn-md btn-primary"><i class="fas fa-plus mr-1 fa-lg"></i>Tambah Lampiran</a>
                                </div>
                            </div>
                            <div class="row align-top mt-2" id="photo-attachment-row-0">
                                <div class="col-8">
                                    <div class="custom-file">
                                        <input accept="image/*" type="file" class="custom-file-input" id="input-file-0" required>
                                        <label class="custom-file-label" id="labelAttachment0">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-right">
                    <button class="btn btn-primary" type="button" id="btn-add-activity"><i class="fas fa-plus mr-1 fa-lg"></i>Tambah</button>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    var attachmentCounter = 1

    $('#btn-add-photo-attachment').on('click', function() {
        addRowAttachment(attachmentCounter)
        attachmentCounter++
    })

    function addRowAttachment(row) {
        $('#photo-attachment-col').append(`
        <div class="photo-attachment-row-class row align-top mt-2" id="photo-attachment-row-` + row + `">
                                <div class="col-8">
                                    <div class="custom-file">
                                        <input accept="image/*" type="file" class="custom-file-input"  id="input-file-` + row + `" required>
                                        <label class="custom-file-label" id="labelAttachment` + row + `">Choose file</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button onclick="$('#photo-attachment-row-` + row + `').remove()" id="btn-delete-photo-attachment" type="button" class=" btn-no-margin btn btn-md btn-danger" style="width: 100px;"><i class="far fa-trash-alt mr-1 fa-lg"></i></button>
                                </div>
                            </div>
        `)

        $('#input-file-' + row + '').change(function(e) {
            var fileName = e.target.files[0].name;
            $('#labelAttachment' + row).html(fileName);
        });
    }
</script>

<script>
    (function() {
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('was-validated');
            var validation = Array.prototype.filter.call(forms, function(form) {

                $('#btn-add-activity').on('click', function() {

                    if (form.checkValidity() === false) {

                        event.preventDefault();
                        event.stopPropagation();

                    } else {

                        var formData = new FormData()
                        $(".custom-file-input").each(function() {
                            formData.append('files[]', $(this).prop('files')[0])
                        })

                        formData.append('libraryName', $('#library-name-add').val())
                        formData.append('activityName', $('#activity-name-add').val())
                        formData.append('activityPlace', $('#activity-place-add').val())
                        formData.append('activityDescription', $('#activity-description-add').val())
                        formData.append('activityDate', $('#activity-date-add').val())
                        formData.append('activityAttendant', $('#activity-attendant-add').val())
                        formData.append('photoDescription', $('#photo-description-add').val())

                        showButtonLoading('#btn-add-activity')
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('ActivityArchieve/insert') ?>",
                            dataType: "application/json",
                            data: formData,
                            contentType: false,
                            processData: false,
                            error: function(jqXHR, exception) {

                                if (jqXHR.status != 200) {
                                    
                                    hideButtonLoading('#btn-add-activity', 'Tambah', 'fa-trash-alt')
                                    $('#modalImport').modal('hide');

                                } else {
                                    
                                    response = JSON.parse(jqXHR.responseText)
                                    if (response['errorMessage'] != "") {
                                        alert(response['errorMessage'])
                                    } else {
                                        $('#library-name-add, #activity-date-add, #activity-attendant-add, #photo-description-add, #activity-name-add, #activity-place-add, #activity-description-add').val('')
                                        getData()
                                    }

                                    $('#modalAddActivity').modal('hide');
                                    hideButtonLoading('#btn-add-activity', 'Tambah', 'fa-trash-alt')
                                    $('.photo-attachment-row-class').empty()

                                }
                            }
                        });

                    }
                });
            });
        }, false);
    })();
</script>