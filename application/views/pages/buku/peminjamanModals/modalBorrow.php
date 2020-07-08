<div class="modal fade" id="modalBorrow" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalBorrowHead"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="body-table-meminjam">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    var status, head
    var tableBody = $("#body-table-meminjam")

    $('#modalBorrow').on('show.bs.modal', function(event) {
        var sender = $(event.relatedTarget)
        status = sender.data('status')
        head = sender.data('head')

        tableBody.empty()
        $('#modalBorrowHead').text(head)
        getBorrow()
    })

    function getBorrow() {

        var value = {
            status: status
        }

        $.post("<?php echo site_url('borrow/get') ?>", value)
            .done(function(data, _) {

                var borrows = $.parseJSON(data)
                tableBody.empty()

                $.each(borrows, function(index, borrow) {

                    var html = `<tr><td>` + borrow['Judul'] + `</td><td>` + borrow['Nama'] + `</td>`
                    switch (status) {
                        case "1":
                            html += `<td><a onclick="updateStatus(` + borrow['ID'] + `, 0)" class="mr-1"><i class="fas fa-trash-alt fa-lg red-text"></i></a><a onclick="updateStatus(` + borrow['ID'] + `, 2)"><i class="fas fa-check-circle fa-lg green-text"></i></a></td></tr>`
                            break;
                        case "2":
                            html += `<td><a onclick="updateStatus(` + borrow['ID'] + `, 3)"><i class="fas fa-check-circle fa-lg green-text"></i></a></td></tr>`
                            break;
                        default:
                            html += `<td>-</td></tr>`
                            break;
                    }

                    tableBody.append(html)

                })
            })
            .fail(function(e, status, thrown) {
                alert("Server mengalami masalah.")
            })
    }

    function updateStatus(ID, updateStatus) {

        if (confirm('Apakah anda yakin?')) {

            var value = {
                ID: ID,
                status: updateStatus
            }

            $.post("<?php echo site_url('borrow/update') ?>", value)
                .done(function() {
                    getBorrow()

                    var state = $('#state').val()
                    if (state != 'book')
                        getPublications()
                    else
                        getBooks()
                        
                })
                .fail(function(e, status, thrown) {
                    alert("Server mengalami masalah.")
                })

        }


    }
</script>