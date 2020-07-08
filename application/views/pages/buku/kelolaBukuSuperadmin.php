<link rel="stylesheet" href="<?php echo base_url('assets/css/kelola-buku.css') ?>">

<!-- Borrow Section -->
<div class="container" style="padding: 0px;">

    <div class="row">
        <div class="col-sm mb-4">
            <div class="card mauve white-text">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p id="borrowing-count" class="h2-responsive font-weight-bold mt-n2 mb-0" data-time="2000">0</p>
                        <p class="mb-0">Meminjam</p>
                    </div>
                    <div>
                        <i class="fas fa-book fa-4x text-black-40"></i>
                    </div>
                </div>
                <a class="card-footer footer-hover small text-center white-text border-0 p-2" data-status="1" data-head="Meminjam" data-toggle="modal" data-target="#modalBorrow">Lihat<i class="fas fa-arrow-circle-right pl-2"></i></a>
            </div>
        </div>

        <div class="col-sm mb-4">
            <div class="card mauve white-text">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p id="borrowed-count" class="h2-responsive font-weight-bold mt-n2 mb-0" data-time="2000">0</p>
                        <p class="mb-0">Dipinjam</p>
                    </div>
                    <div>
                        <i class="fas fa-book fa-4x text-black-40"></i>
                    </div>
                </div>
                <a class="card-footer footer-hover small text-center white-text border-0 p-2" data-status="2" data-head="Dipinjam" data-toggle="modal" data-target="#modalBorrow">Lihat<i class="fas fa-arrow-circle-right pl-2"></i></a>
            </div>
        </div>


        <div class="col-sm mb-4">
            <div class="card mauve white-text">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p id="returned-count" class="h2-responsive font-weight-bold mt-n2 mb-0" data-time="2000">0</p>
                        <p class="mb-0">Dikembalikan</p>
                    </div>
                    <div>
                        <i class="fas fa-book fa-4x text-black-40"></i>
                    </div>
                </div>
                <a class="card-footer footer-hover small text-center white-text border-0 p-2" data-status="3" data-head="Dikembalikan" data-toggle="modal" data-target="#modalBorrow">Lihat<i class="fas fa-arrow-circle-right pl-2"></i></a>
            </div>
        </div>
    </div>
</div>


<div class="card mb-4 pt-4 container ">

    <!-- FAB -->
    <div id="fab" class="wrapper">
        <div class="menu-object">
            <ul class="toggle">
                <li id="btn-fab" class="ico01 li-fab btn-indigo"></li>
                <li class="move-ico ico03 li-fab btn-indigo">
                    <a class="link link02" data-toggle="modal" data-target="#modalImport">
                        <i class="far fa-file-excel"></i>
                    </a>
                </li>
                <li class="move-ico ico04  li-fab btn-indigo">
                    <a class="link link03" id="modalAdd">
                        <i class="fas fa-file"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>


    <!-- Counter -->
    <div class="row d-flex mt-4">

        <div class="col-sm mb-4 text-center">
            <h4 class="h1 font-weight-normal mb-3">
                <i class="fas fa-book-open indigo-text"></i>
                <span id="book-count" class="d-inline-block " data-time="2000">0</span>
            </h4>
            <p class="font-weight-normal text-muted">Buku</p>
        </div>

        <div class="col-sm mb-4 text-center">
            <h4 class="h1 font-weight-normal mb-3">
                <i class="fas fa-file-alt indigo-text"></i>
                <span id="publication-count" class="d-inline-block " data-time="2000">0</span>
            </h4>
            <p class="font-weight-normal text-muted">Publikasi</p>
        </div>


    </div>

    <!-- Filter -->
    <div class="row d-flex justify-content-center m-2">
        <div class="col-md-6">
            <div class="form-row mb-2">
                <div class="col mb-2">
                    <label for="state">Urut</label>
                    <select class="custom-select d-block w-100" id="sort" required>
                    </select>
                </div>
                <div class="col-12 mb-2 col-md-auto">
                    <label for="state">Jumlah</label>
                    <select class="custom-select d-block w-100" id="page" required>
                        <option value="10" selected>10</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="500">500</option>
                    </select>
                </div>
                <div class="col mb-2 col-md-auto">
                    <label for="state">Jenis</label>
                    <select class="custom-select d-block w-100" id="state" required>
                        <option value="book" selected>Buku</option>
                        <option value="publication">Publikasi</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center ml-2 mr-2 mb-2">
        <div class="col-md-6 text-center">
            <div class="input-group  ">
                <input id="search" type="text" class="form-control" placeholder="Saya mencari ...">
                <div class="input-group-append">
                    <button id="btn-search" onclick="start = 0,getBooks()" class="btn btn-md mauve text-white  rounded-right m-0 px-3 py-2 z-depth-0 waves-effect" type="submit" id="button-addon2">Cari</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading/Empty -->
    <div id="notification"></div>

    <!-- Content -->
    <div class="row d-flex justify-content-center mr-2 ml-2">
        <div class="container">
            <div id="content" class="row text-center">
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-3 mb-4">
        <nav id="books-pagination" class="mb-4">
        </nav>
    </div>
</div>

<?php $this->load->view('pages/buku/bukuModals/modalDeleteBuku') ?>
<?php $this->load->view('pages/buku/bukuModals/modalEditBuku') ?>
<?php $this->load->view('pages/buku/bukuModals/modalAddBuku') ?>
<?php $this->load->view('pages/buku/bukuModals/modalExcel') ?>
<?php $this->load->view('pages/buku/bukuModals/modalNotification') ?>

<?php $this->load->view('pages/buku/publikasiModals/modalDeletePublikasi') ?>
<?php $this->load->view('pages/buku/publikasiModals/modalEditPublikasi') ?>
<?php $this->load->view('pages/buku/publikasiModals/modalAddPublikasi') ?>

<?php $this->load->view('pages/buku/peminjamanModals/modalBorrow') ?>

<script>
    var mediaMobile = 992
    var start = 0
    var lastPage
    var interactedRowIdentifier

    $(document).ready(function() {

        /** onChange */
        $('#page, #sort').change(function() {
            start = 0
            var state = $('#state').val()
            if (state != 'book')
                getPublications()
            else
                getBooks()
        })

        $('#state').change(function() {
            start = 0
            var sort = $('#sort')
            var state = $(this).val()
            if (state != 'book') {
                sort.empty()
                sort.append(`
                    <option value="edisi ASC" selected>Edisi - A ke Z</option>
                    <option value="edisi DESC">Edisi - Z ke A</option>
                    <option value="judul ASC">Judul - A ke Z</option>
                    <option value="judul DESC">Judul - Z ke A</option>
                    <option value="tgl_terbit ASC">Tanggal Terbit - A ke Z</option>
                    <option value="tgl_terbit DESC">Tanggal Terbit - Z ke A</option>
                    <option value="tgl_periksa ASC">Tanggal Periksa - A ke Z</option>
                    <option value="tgl_periksa DESC">Tanggal Periksa - Z ke A</option>
                    <option value="status ASC">Status - A ke Z</option>
                    <option value="status DESC">Status - Z ke A</option>`)
                getPublications()
            } else {
                sort.empty()
                sort.append(`
                    <option value="judul ASC" selected>Judul - A ke Z</option>
                    <option value="judul DESC">Judul - Z ke A</option>
                    <option value="pengarang ASC">Pengarang - A ke Z</option>
                    <option value="pengarang DESC">Pengarang - Z ke A</option>
                    <option value="tahun ASC">Tahun - A ke Z</option>
                    <option value="tahun DESC">Tahun - Z ke A</option>
                    <option value="jumlah ASC">Jumlah - A ke Z</option>
                    <option value="jumlah DESC">Jumlah - Z ke A</option>
                    <option value="no_barcode ASC">No. Barcode - A ke Z</option>
                    <option value="no_barcode DESC">No. Barcode - Z ke A</option>
                    <option value="lokasi ASC">Lokasi - A ke Z</option>
                    <option value="lokasi DESC">Lokasi - Z ke A</option>`)
                getBooks()
            }
        })

        /** onHit Enter */
        $('#search').keyup(function(e) {
            if (e.keyCode == 13) {
                $('#btn-search').click()
            }
        })

        /** onClick */
        $('#btn-fab').click(function() {
            $('.wrapper').toggleClass('active');
        })

        $('#modalAdd').click(function() {
            var state = $('#state').val()
            if (state != 'book')
                $('#modalAddPublikasi').modal('show');
            else
                $('#modalAddBuku').modal('show');
        })

        /** Detect if scroll hit bottom page and hide/show FAB */
        function getDocHeight() {
            var D = document;
            return Math.max(
                D.body.scrollHeight, D.documentElement.scrollHeight,
                D.body.offsetHeight, D.documentElement.offsetHeight,
                D.body.clientHeight, D.documentElement.clientHeight
            );
        }
        $(window).scroll(function() {
            if ($(window).width() < mediaMobile) {
                if ($(window).scrollTop() + $(window).height() == getDocHeight()) {
                    $("#fab").hide('linear');
                } else {
                    $("#fab").show('linear');
                }
            }
        });

        /** Initiate Request Data through Network */
        $('#state').trigger('change')

    });

    function getBooks() {

        var value = {
            search: $('#search').val(),
            sort: $('#sort').val(),
            page: $('#page').val(),
            start: start
        }

        showLoading()
        hideEmptyContent()
        $("#content").empty()
        $("#books-pagination").empty();

        $.post("<?php echo site_url('book/get') ?>", value)
            .done(function(data, status) {
                var books = JSON.parse(data)

                /** Counter */
                var counterBook = books.totalBookRecords
                var counterPublication = books.totalPublicationRecords
                var counterBorrowing = books.totalBorrowing
                var counterBorrowed = books.totalBorrowed
                var counterReturnedBorrow = books.totalReturnedBorrow
                counting(counterBook, counterPublication, counterBorrowing, counterBorrowed, counterReturnedBorrow)

                /** Fetch data */
                var datas = books.data
                var counterBookFilter = books.totalBookRecordwithFilter

                /** Show if data is empty */
                if (counterBookFilter != 0) {
                    if ($(window).width() < mediaMobile) {
                        $.each(datas, function(index, data) {
                            $("#content").append(`
                            <div id="` + data.no_barcode + `" class="col-lg-4 col-md-6 mt-4 mb-4">
                            <div class="card">
                                    <div class="card-header white-text mauve">
                                        <h6 class="font-weight-bold text-uppercase mt-2">
                                            ` + data.judul + `
                                            <a class="white-text" data-toggle="modal" data-target="#modalEditBuku"
                                                data-no_barcode     ="` + data.no_barcode + `"
                                                data-klasifikasi    ="` + data.klasifikasi + `"
                                                data-judul          ="` + data.judul + `"
                                                data-pengarang      ="` + data.pengarang + `"
                                                data-tahun          ="` + data.tahun + `"
                                                data-jumlah         ="` + data.jumlah + `"
                                                data-no_register    ="` + data.no_register + `"
                                                data-tgl_input      ="` + data.tgl_input + `"
                                                data-lokasi         ="` + data.lokasi + `">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </h6>
                                    </div>
                                    <div class="card-body text-center px-4">
                                        <div class="list-group list-group-flush">
                                            <ul class="fa-ul mb-0 text-left">
                                                <li class="mb-2"><span class="fa-li"><i class="fas fa-user"></i></span>` + data.pengarang + `</li>
                                                <li class="mb-2"><span class="fa-li"><i class="fas fa-calendar-alt"></i></span>` + data.tahun + `</li>
                                                <li class="mb-2"><span class="fa-li"><i class="fas fa-calculator"></i></span>` + data.jumlah + `</li>
                                                <li class="mb-2"><span class="fa-li"><i class="fas fa-map"></i></span>` + data.lokasi + `</li>
                                                <li class="mb-2"><span class="fa-li"><i class="fas fa-barcode"></i></span>` + data.no_barcode + `</li>
                                                <li class="mb-2"><span class="fa-li"><i class="fas fa-archive"></i></span>` + data.klasifikasi + `</li>
                                                <li class="mb-2"><span class="fa-li"><i class="fas fa-calendar-alt"></i></span>` + data.tgl_input + `</li>
                                                <li><span class="fa-li"><i class="fas fa-registered"></i></span>` + data.no_register + `</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>`);
                        })
                    } else {
                        $("#content").append(`<div class="table-responsive ">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
										<th >No. Barcode</th>
                                        <th  class="text-left">Judul</th>
                                        <th  class="text-left">Pengarang</th>
                                        <th >Tahun</th>
                                        <th >No. Reg.</th>
                                        <th >Klasifikasi</th>
                                        <th sty>Edit</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">

                                </tbody>
                            </table>
                        </div>`)

                        $.each(datas, function(index, data) {
                            $("#table-body").append(`<tr>
										<td>` + data.no_barcode + `</td>
                                        <td class="text-left">` + data.judul + `</td>
                                        <td class="text-left">` + data.pengarang + `</td>
                                        <td>` + data.tahun + `</td>
                                        <td>` + data.no_register + `</td>
                                        <td>` + data.klasifikasi + `</td>
                                        <td><a class="white-text" data-toggle="modal" data-target="#modalEditBuku"
                                                data-no_barcode     ="` + data.no_barcode + `"
                                                data-klasifikasi    ="` + data.klasifikasi + `"
                                                data-judul          ="` + data.judul + `"
                                                data-pengarang      ="` + data.pengarang + `"
                                                data-tahun          ="` + data.tahun + `"
                                                data-jumlah         ="` + data.jumlah + `"
                                                data-no_register    ="` + data.no_register + `"
                                                data-tgl_input    ="` + data.tgl_input + `"
                                                data-lokasi         ="` + data.lokasi + `">
                                                <i class="fas fa-lg purple-text fa-edit"></i>
                                            </a></td>
                                    </tr>`)
                        })
                    }

                    attachPagination(counterBookFilter, value.page)
                    hideLoading()

                } else {
                    showEmptyContent()
                    hideLoading()
                }

            })
            .fail(function(e, status, thrown) {
                alert("Server mengalami masalah.")
            })
    }

    function getPublications() {

        var value = {
            search: $('#search').val(),
            sort: $('#sort').val(),
            page: $('#page').val(),
            start: start
        }

        showLoading()
        hideEmptyContent()
        $("#content").empty()
        $("#books-pagination").empty();

        $.post("<?php echo site_url('publication/get') ?>", value)
            .done(function(data, status) {
                var publications = JSON.parse(data)

                /** Counter */
                var counterBook = publications.totalBookRecords
                var counterPublication = publications.totalPublicationRecords
                var counterBorrowed = publications.totalBorrowed
                counting(counterBook, counterPublication, counterBorrowed)

                /** Fetch data */
                var datas = publications.data
                var counterPublicationFilter = publications.totalPublicationRecordwithFilter

                /** Show if data is empty */
                if (counterPublicationFilter != 0) {
                    if ($(window).width() < mediaMobile) {
                        $.each(datas, function(index, data) {
                            $("#content").append(`
                            <div id="` + data.id_buku + `" class="col-lg-4 col-md-6 mb-5">
                            <div class="card">
                                <div class="card-header white-text primary-color">
                                    <h6 class="font-weight-bold mt-2">
                                    ` + data.edisi + `
                                        <a class="white-text" data-toggle="modal" data-target="#modalEditPublikasi"
                                            data-id_publikasi="` + data.id_publikasi + `"
                                            data-edisi       ="` + data.edisi + `"
                                            data-judul       ="` + data.judul + `"
                                            data-tgl_terbit  ="` + data.tgl_terbit + `"
                                            data-tgl_periksa ="` + data.tgl_periksa + `"
                                            data-status      ="` + data.status + `">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </h6>
                                </div>
                                <div class="card-body text-center px-4">
                                    <div class="list-group list-group-flush">
                                        <ul class="fa-ul mb-0 text-left">
                                            <li class="mb-2"><span class="fa-li"><i class="fas fa-book-open"></i></span>` + data.judul + `</li>
                                            <li class="mb-2"><span class="fa-li"><i class="fas fa-calendar-alt"></i></span>` + data.tgl_terbit + `</li>
                                            <li class="mb-2"><span class="fa-li"><i class="fas fa-calendar-alt"></i></span>` + data.tgl_periksa + `</li>
                                            <li><span class="fa-li"><i class="fas fa-archive"></i></span>` + data.status + `</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            </div>`);
                        })
                    } else {
                        $("#content").append(`<div class="table-responsive ">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th  class="text-left">Edisi</th>
                                        <th  class="text-left">Judul</th>
                                        <th >Tanggal Terbit</th>
                                        <th >Tanggal Periksa</th>
                                        <th >Status</th>
                                        <th sty>Edit</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                </tbody>
                            </table>
                            </div>`)
                        $.each(datas, function(index, data) {
                            $("#table-body").append(`<tr>
                                <td class="text-left">` + data.edisi + `</td>
                                <td class="text-left">` + data.judul + `</td>
                                <td>` + data.tgl_terbit + `</td>
                                <td>` + data.tgl_periksa + `</td>
                                <td>` + data.status + `</td>
                                <td><a class="white-text" data-toggle="modal" data-target="#modalEditPublikasi"
                                        data-id_publikasi="` + data.id_publikasi + `"
                                        data-edisi       ="` + data.edisi + `"
                                        data-judul       ="` + data.judul + `"
                                        data-tgl_terbit  ="` + data.tgl_terbit + `"
                                        data-tgl_periksa ="` + data.tgl_periksa + `"
                                        data-status      ="` + data.status + `">
                                        <i class="fas fa-lg blue-text fa-edit"></i>
                                    </a></td>
                            </tr>`)
                        })
                    }

                    attachPagination(counterPublicationFilter, value.page)
                    hideLoading()

                } else {
                    showEmptyContent()
                    hideLoading()
                }

            })
            .fail(function(e, status, thrown) {
                alert("Server mengalami masalah.")
            })
    }

    function attachPagination(countFilter, page) {

        var state = $('#state').val()
        var stateAction

        if (state != 'book')
            stateAction = 'getPublications()'
        else
            stateAction = 'getBooks()'

        var first, last, previous, next
        lastPage = (Math.floor(countFilter / page))

        if (lastPage == 0) {
            first = "disabled"
            previous = "disabled"
            last = "disabled"
            next = "disabled"
        } else if (start == 0) {
            first = "disabled"
            previous = "disabled"
            next = "active"
        } else if (start != lastPage) {
            next = "active"
            previous = "active"
        } else {
            last = "disabled"
            next = "disabled"
            previous = "active"
        }

        $('#books-pagination').append(`
                    <ul class="pagination pg-purple mb-0">
                        <li class="page-item ` + first + ` clearfix d-none d-md-block">
                            <a href="#header" onClick="start=0,` + stateAction + `" class="page-link waves-effect">«</a>
                        </li>
                        <li class="mr-2 page-item ` + previous + `">
                        <button href="#header" onClick="start--,` + stateAction + `"  class="page-link waves-effect">Sebelumnya
                            </button>
                        </li>
                        <li  class="page-item ` + next + `">
                            <button href="#header" onClick="start++,` + stateAction + `"  class="page-link waves-effect">Selanjutnya
                            </button>
                        </li>
                        <li id="last" class="page-item clearfix d-none d-md-block ` + last + `">
                            <a href="#header" onClick="start=lastPage, ` + stateAction + `" class="page-link waves-effect">»</a>
                        </li>
                    </ul>`)

    }

    function showButtonLoading(button) {
        $(button).html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled')
    }

    function hideButtonLoading(button, text, icon) {
        $(button).html(`<i class="fas ` + icon + ` fa-lg mr-1"></i>` + text + ``).removeClass('disabled')
    }

    function showLoading() {
        $('#notification').append(`
        <div class="container mt-2">
            <div id="loading" class="books-loading d-flex justify-content-center">
            <div class="books-loading spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
            </div>
            </div>
        </div>
        `)
    }

    function hideLoading() {
        $('#loading').remove()
    }

    function showEmptyContent() {
        $('#notification').append(`
        <div class="container">
            <div id="empty" class="row text-center  my-5">
            <div class="books-empty col">
            <i class="fas fa-flag fa-3x mb-4 grey-text"></i>
            <h5 class="font-weight-normal mb-3">Buku/Jurnal</h5>
            <p class="text-muted mb-0">Kosong</p>
            </div>
            </div>
        </div>
        `)
    }

    function hideEmptyContent() {
        $('#empty').remove()
    }

    function counting(counterBook, counterPublication, counterBorrowing, counterBorrowed, counterReturnedBorrow) {

        $('#book-count').attr("data-to", counterBook).counter();
        $('#publication-count').attr("data-to", counterPublication).counter();
        $('#borrowing-count').attr("data-to", counterBorrowing).counter();
        $('#borrowed-count').attr("data-to", counterBorrowed).counter();
        $('#returned-count').attr("data-to", counterReturnedBorrow).counter();

    }

    /** CounterFunction */
    (function($) {
        $.fn.counter = function() {
            const $this = $(this),
                numberFrom = 0,
                numberTo = parseInt($this.attr('data-to')),
                delta = numberTo - numberFrom,
                deltaPositive = delta > 0 ? 1 : 0,
                time = parseInt($this.attr('data-time')),
                changeTime = 10;

            let currentNumber = numberFrom,
                value = delta * changeTime / time;
            var interval1;
            const changeNumber = () => {
                currentNumber += value;
                (deltaPositive && currentNumber >= numberTo) || (!deltaPositive && currentNumber <= numberTo) ? currentNumber = numberTo: currentNumber;
                this.text(parseInt(currentNumber));
                currentNumber == numberTo ? clearInterval(interval1) : currentNumber;
            }

            interval1 = setInterval(changeNumber, changeTime);
        }
    }(jQuery));
</script>