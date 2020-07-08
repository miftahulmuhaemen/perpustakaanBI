<div class="modal fade" id="modalImport" tabindex="0" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="  modal-dialog   modal-info modal-notify" role="document">
        <div class="modal-content">
            <div class="modal-header white-text text-center">
                <h4 class="modal-title w-100 font-weight-bold">Impor <a id="import-title" class="text-uppercase"></a></h4>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <div class="modal-body mr-3 ml-3">
                <ul class="stepper stepper-vertical" style="padding-top:0rem;padding-bottom:0rem;">
                    <li class="completed">
                        <a>
                            <span class="circle">1</span>
                            <span class="label">Tahap Pertama</span>
                        </a>
                        <div class="step-content">
                            <p>Sebelum mengunggah berkas Excel untuk Buku/Publikasi, ada baiknya anda
                                mengunduh berkas yang sudah ada terlebih dahulu sebagai cadangan.</p>
                            <button class="btn btn-md btn-primary" id="btn-export-excel"><i class="far fa-lg fa-arrow-alt-circle-down mr-1"></i>Ekspor</button>
                        </div>
                    </li>
                    <li class="active">
                        <a>
                            <span class="circle">2</span>
                            <span class="label">Tahap Kedua</span>
                        </a>
                        <div class="step-content">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">File</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="inputFile" id="inputFile" aria-describedby="uploadExcel">
                                    <label class="custom-file-label" for="uploadExcel">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="active">
                        <a>
                            <span class="circle">3</span>
                            <span class="label">Tahap Terakhir</span>
                        </a>
                        <div class="step-content">
                            <div class="input-group">
                                <p>Jika ditemukan data dengan `no_barcode`/`id_publikasi` yang serupa, maka,</p>
                                <select id="import-type" class="custom-select d-block w-100">
                                    <option value="Replace" selected>Timpa data lama dengan data baru</option>
                                    <option value="Keep">Pertahankan data lama</option>
                                    <option value="Cancel">Gagalkan aksi</option>
                                </select>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="modal-footer d-flex justify-content-right">
                <a type="button" class="btn btn-primary" id="btn-import-excel"><i class="far fa-lg fa-arrow-alt-circle-up mr-1"></i>Impor</a>
            </div>
        </div>
    </div>
</div>

<script>
    var title, urlImport, urlExport, importType

    function setup() {
        var state = $('#state').val()

        if (state != 'book') {
            title = 'Publikasi'
            urlImport = '<?php echo site_url('publication/import') ?>'
            urlExport = '<?php echo site_url('publication/export') ?>'
        } else {
            title = 'Buku'
            urlImport = '<?php echo site_url('book/import') ?>'
            urlExport = '<?php echo site_url('book/export') ?>'
        }
    }

    $('#modalImport').on('show.bs.modal', function(event) {

        /** Setup */
        setup()

        /** Extend title with what state it's called in */
        $('#import-title').empty()
        $('#import-title').append(title)

        var reader = new FileReader();
        reader.onload = function(event) {
            var data = event.target.result;
            var workBook = XLSX.read(data, {
                type: 'binary'
            });
            workBook.SheetNames.forEach(function(sheetName) {

                var postData = []
                var datas = XLSX.utils.sheet_to_row_object_array(workBook.Sheets[sheetName]);

                $.each(datas, function(index, data) {

                    if (state != 'book') {
                        postData.push({
                            'id_publikasi': data['ID'],
                            'edisi': data['Edisi'],
                            'judul': data['Judul'],
                            'tgl_terbit': data['Tanggal Terbit'],
                            'tgl_periksa': data['Tanggal Periksa'],
                            'status': data['Status'],
                        })
                    } else {
                        postData.push({
                            'no_barcode': data['No. Barcode'],
                            'klasifikasi': data['Klasifikasi'],
                            'judul': data['Judul'],
                            'pengarang': data['Pengarang'],
                            'tahun': data['Tahun'],
                            'no_register': data['No. Register'],
                            'jumlah': data['Jumlah'],
                            'lokasi': data['Lokasi'],
                        })
                    }

                })

                showButtonLoading('#btn-import-excel')

                $.post(urlImport + importType, {
                        data: JSON.stringify(postData)
                    })
                    .done(function(data, _) {
                        hideButtonLoading('#btn-import-excel', 'Impor', 'fa-arrow-alt-circle-up')
                        $('#modalImport').modal('hide');
                        $('#import-success').modal('show');

                        if (state != 'book')
                            getPublications()
                        else
                            getData()

                    })
                    .fail(function(e, status, thrown) {
                        hideButtonLoading('#btn-import-excel', 'Impor', 'fa-arrow-alt-circle-up')
                        $('#modalImport').modal('hide');
                        $('#import-failed').modal('show');
                    })
            })
        };

        reader.onerror = function(event) {
            console.error("File could not be read! Code " + event.target.error.code);
        };

        $('#btn-import-excel').on('click', function() {

            importType = $('#import-type').val()
            var file_data = $('#inputFile').prop('files')[0];
            reader.readAsBinaryString(file_data);

        })

        $('#btn-export-excel').on('click', function() {
            showButtonLoading('#btn-export-excel')
            setup()
            $.post(urlExport)
                .done(function(data) {

                    hideButtonLoading('#btn-export-excel', 'Ekspor', 'fa-arrow-alt-circle-down')
                    var response = $.parseJSON(data)
                    var fileName = 'Daftar' + title
                    var workSheet = XLSX.utils.json_to_sheet(response)

                    var workBook = XLSX.utils.book_new()
                    XLSX.utils.book_append_sheet(workBook, workSheet, fileName)

                    var bin = XLSX.write(workBook, {
                        bookType: 'xlsx',
                        type: 'binary'
                    })

                    XLSX.writeFile(workBook, 'Daftar ' + title + '.xlsx')
                })
                .fail(function(e, status, thrown) {
                    alert("Server mengalami masalah.")
                })
        })
    })
</script>