<div class="modal fade" id="modalExport" tabindex="0" role="dialog">
    <div class="modal-dialog modal-info modal-notify" role="document">
        <div class="modal-content">
            <div class="modal-header white-text text-center">
                <h4 class="modal-title w-100 font-weight-bold">Ekspor</h4>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>
            <div class="modal-body mr-3 ml-3">
                <ul class="stepper stepper-vertical" style="padding: 0; margin: 0;">
                    <li class="completed">
                        <a>
                            <span class="circle">1</span>
                            <span class="label">Tahap Pertama</span>
                        </a>
                        <div class="step-content">
                            <div class="input-group">
                                <div class="container">
                                    <div class="row">
                                        <p>Jenis ekspor yang diinginkan.</p>
                                    </div>
                                    <div class="row">
                                        <select id="import-type" class="custom-select d-block w-100">
                                            <option value="pdf">PDF</option>
                                            <option value="xlxs" selected>XLXS</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="active">
                        <a>
                            <span class="circle">2</span>
                            <span class="label">Tahap Terakhir</span>
                        </a>
                        <div class="step-content">
                            <div class="input-group">
                                <div class="container">
                                    <div class="row">
                                        <p>Cabang dari perpustakaan yang diinginkan.</p>
                                    </div>
                                    <div class="row">
                                        <select id="library-name-export" class="custom-select d-block w-100">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="modal-footer d-flex justify-content-right">
                <a type="button" class="btn btn-primary" id="btn-export"><i class="far fa-lg fa-arrow-alt-circle-down mr-1"></i>Ekspor</a>
            </div>
        </div>
    </div>
</div>

<script>
    $('#btn-export').on('click', function() {

        var importType = $('#import-type').val()
        var libraryName = $('#library-name-export option:selected').text()
        var libraryID = $('#library-name-export').val()

        var value = {
            libraryID: libraryID,
        }

        showButtonLoading('#btn-export')

        $.post("<?php echo site_url('visitorarchieve/export') ?>", value)
            .done(function(data, status) {

                hideButtonLoading('#btn-export', 'Ekspor', 'fa-arrow-alt-circle-down')
                    var response = $.parseJSON(data)

                    if (importType == 'pdf') {

                        var document = new jsPDF({
                            orientation: 'landscape'
                        })

                        var columns = ["Nama", "Email", "Kota", "Tanggal Input"]
                        var rows = []

                        $.each(response, function(indexRow, row) {
                            var temp = [row['Nama'], row['Email'], row['Kota'], row['Tanggal Input']]
                            rows.push(temp)
                        })

                        document.text(20, 20, 'Laporan ' + libraryName);
                        document.autoTable(columns, rows, {
                            startY: 30
                        })
                        document.save('Visitor Archieve.pdf')

                    } else {

                        var fileName = "Report"
                        var workSheet = XLSX.utils.json_to_sheet(response)

                        var workBook = XLSX.utils.book_new()
                        XLSX.utils.book_append_sheet(workBook, workSheet, fileName)

                        var bin = XLSX.write(workBook, {
                            bookType: 'xlsx',
                            type: 'binary'
                        })

                        XLSX.writeFile(workBook, 'Report_' + '.xlsx')

                    }

                hideButtonLoading('#btn-export', 'Ekspor', 'fa-arrow-alt-circle-down')

            })
            .fail(function(e, status, thrown) {

                console.log(e, status)

            })

    })
</script>