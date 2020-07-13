<!-- FAB -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/kelola-buku.css') ?>">
<div id="fab" class="wrapper">
    <div class="menu-object">
        <ul class="toggle">
            <li id="btn-fab" class="ico01 li-fab btn-indigo"></li>
            <li class="move-ico ico04  li-fab btn-indigo">
                <a class="link link02" data-toggle="modal" data-target="#modalExport">
                    <i class="far fa-file-excel"></i>
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Data Not Found -->
<div style="height:80vh; display: none;" class="not-found">
    <div class="flex-center flex-column ">
        <h1 class="white-outline text-hide animated fadeIn mb-4 white-text" style="background-image: url('<?php echo base_url('assets/img/perpus_bi.ico') ?>'); width: 250px; height: 230px;">Perpustakaan Bank Indonesia</h1>
        <p class="animated fadeIn">Tidak ada arsip pengunjung yang ditemukan</p>
    </div>
</div>

<div class="card mb-4 container" style="display: none;">

    <!-- Counter -->
    <div class="row d-flex justify-content-center mt-4">

        <div class="col-sm mb-4 text-center">
            <h4 class="h1 font-weight-normal mb-3">
                <i class="fas fa-book-open indigo-text"></i>
                <span id="total-report-count" class="d-inline-block " data-time="2000">0</span>
            </h4>
            <p class="font-weight-normal text-muted">Total Pengunjung</p>
        </div>

        <div class="col-sm mb-4 text-center">
            <h4 class="h1 font-weight-normal mb-3">
                <i class="fas fa-file-alt indigo-text"></i>
                <span id="current-month-report-count" class="d-inline-block " data-time="2000">0</span>
            </h4>
            <p class="font-weight-normal text-muted">Pengunjung Bulan Ini</p>
        </div>

    </div>

    <div class="row mb-3">
        <div class="col">
            <section class="dark-grey-text text-center">
                <h5 class="font-weight-bold">Grafik Total Pengunjung / Tahun</h5>
            </section>
            <div class="card-body bordered border-light">
                <div id="chart" class="chart-area ">
                    <div class="not-found-chart text-center" style="display: none;">
                        <i class="fas fa-flag fa-3x mb-4 grey-text"></i>
                        <h5 class="font-weight-normal mb-3">Pengunjung per Tahun Ini</h5>
                        <p class="text-muted mb-0">Kosong</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="report-list" class="row m-5">
        <div class="col">
            <section class="dark-grey-text text-center mb-5">
                <h5 class="font-weight-bold"> <i>Corner</i> / Total Pengunjung</h5>
            </section>
            <div class="accordion" id="summary"></div>
        </div>
    </div>

</div>

<?php $this->load->view('pages/admin/VisitorArchieveModals/modalExportArchieve') ?>

<script>
    var chartData;

    $(document).ready(function() {

        $('#btn-fab').click(function() {
            $('.wrapper').toggleClass('active');
        })

        $(window).resize(function() {
            drawChart();
        })

        /** Initiate DataLoad */
        getData()

    })


    function getVisitors(libraryID, indexReportsGroup) {

        /** So this function called once per getData() called */
        $('#btn-get-report-' + indexReportsGroup).prop("onclick", null)

        var value = {
            libraryID: libraryID,
        }
        
        $.post("<?php echo site_url('VisitorArchieve/getVisitors') ?>", value)
            .done(function(data, status) {

                $('#loading' + indexReportsGroup).remove()

                var response = $.parseJSON(data)
                $.each(response, function(indexReport, data) {

                    $('#reportsGroup-row-' + indexReportsGroup).append(`
                    <tr><td>`+ data['Nama'] +`</td>
                    <td>`+ data['Email'] +`</td>
                    <td>`+ data['Kota'] +`</td>
                    <td>`+ data['Tanggal Input'] +`</td></tr>`)
                    
                })
            })
            .fail(function(e, status, thrown) {
                alert('Server mengalami masalah')
            })
    }

    function getData() {

        $.post("<?php echo site_url('VisitorArchieve/get') ?>")
            .done(function(data, status) {
                var response = $.parseJSON(data)

                chartData = response.chartData
                totalVisitor = response.totalVisitor
                totalVisitorCurrentMonth = response.totalVisitorCurrentMonth

                $.each(response.library, function(index, data) {

                    libraryID = data.Id_perpustakaan
                    libraryName = data.nama
                    $('#library-name-export').append(`<option value="` + libraryID + `">` + libraryName + `</option>`)

                })

                if (totalVisitor != false) {

                    $('.container').show()
                    $('#summary').empty()
                    $('.not-found').hide()

                    drawChart()

                    counting(totalVisitor, totalVisitorCurrentMonth)

                    $.each(response.summary, function(index, data) {

                        libraryID = data.id
                        libraryName = data.name
                        libraryCount = data.count
                        indexReportsGroup = index

                        $('#summary').append(`<div class="card z-depth-0 bordered">
                            <div class="card-header" id="heading` + indexReportsGroup + `">
                                <h5 class="mb-0">
                                    <button id="btn-get-report-` + indexReportsGroup + `" onclick="getVisitors(` + libraryID + `, ` + indexReportsGroup + `)" class="btn  btn-link" type="button" data-toggle="collapse" data-target="#collapse` + indexReportsGroup + `" aria-expanded="true" aria-controls="collapse` + indexReportsGroup + `">
                                    ` + libraryName + ` <span class="badge black ml-2">` + libraryCount + ` </span>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse` + indexReportsGroup + `" class="collapse" aria-labelledby="heading` + indexReportsGroup + `" data-parent="#summary">
                                <div  class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Kota</th>
                                                <th>Tanggal Input</th>
                                            </tr>
                                        </thead>
                                        <tbody id="reportsGroup-row-` + indexReportsGroup + `">
                                        </tbody>
                                    </table>
                                    <div id="loading` + indexReportsGroup + `" class="books-loading d-flex justify-content-center">
                                        <div class="books-loading spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>`)

                    })

                } else {

                    $('.not-found').show()

                }
            })
            .fail(function(e, status, thrown) {
                alert('Server mengalami masalah')
            })
    }


    function showButtonLoading(button) {
        $(button).html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled')
    }

    function hideButtonLoading(button, text, icon) {
        $(button).html(`<i class="fas ` + icon + ` fa-lg mr-1"></i>` + text + ``).removeClass('disabled')
    }


    function counting(totalVisitor, totalVisitorCurrentMonth) {
        $('#total-report-count').attr("data-to", totalVisitor).counter();
        $('#current-month-report-count').attr("data-to", totalVisitorCurrentMonth).counter();
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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    function drawChart() {

        if (chartData[1] != null) {

            $('#chart').empty()
            $('#chart').append(`<div id="curve_chart"></div>`)

            $('.not-found-chart').hide()

            google.charts.load('current');
            google.charts.setOnLoadCallback(initiateChart);

            function initiateChart() {
                var wrapper = new google.visualization.ChartWrapper({
                    chartType: 'LineChart',
                    dataTable: chartData,
                    options: {
                        title: '',
                        curveType: 'function',
                        legend: {
                            position: 'bottom'
                        }
                    },
                    containerId: 'curve_chart'
                });
                wrapper.draw();
            }
        } else {
            $('.not-found-chart').show()
        }

    }
</script>