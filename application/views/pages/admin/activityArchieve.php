<!-- FAB -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/kelola-buku.css') ?>">
<div id="fab" class="wrapper">
    <div class="menu-object">
        <ul class="toggle">
            <li id="btn-fab" class="ico01 li-fab btn-indigo"></li>
            <li class="move-ico ico03 li-fab btn-indigo">
                <a class="link link02" data-toggle="modal" data-target="#modalExport">
                    <i class="far fa-file-excel"></i>
                </a>
            </li>
            <li class="move-ico ico04  li-fab btn-indigo">
                <a class="link link03" data-toggle="modal" data-target="#modalAddActivity">
                    <i class="fas fa-file"></i>
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Data Not Found -->
<div style="height:80vh;display: none;" class="not-found" >
    <div class="flex-center flex-column ">
        <h1 class="white-outline text-hide animated fadeIn mb-4 white-text" style="background-image: url('<?php echo base_url('assets/img/perpus_bi.ico') ?>'); width: 250px; height: 230px;">Perpustakaan Bank Indonesia</h1>
        <p class="animated fadeIn">Tidak ada arsip kegiatan yang ditemukan</p>
    </div>
</div>

<div class="card mb-4 container main-container" style="display: none;">

    <!-- Counter -->
    <div class="row d-flex justify-content-center mt-4">

        <div class="col-sm mb-4 text-center">
            <h4 class="h1 font-weight-normal mb-3">
                <i class="fas fa-book-open indigo-text"></i>
                <span id="total-activity-count" class="d-inline-block" data-time="2000">0</span>
            </h4>
            <p class="font-weight-normal text-muted">Total Kegiatan</p>
        </div>

        <div class="col-sm mb-4 text-center">
            <h4 class="h1 font-weight-normal mb-3">
                <i class="fas fa-file-alt indigo-text"></i>
                <span id="current-month-activity-count" class="d-inline-block" data-time="2000">0</span>
            </h4>
            <p class="font-weight-normal text-muted">Kegiatan Bulan Ini</p>
        </div>

    </div>

    <div class="row mb-3">
        <div class="col">
            <section class="dark-grey-text text-center">
                <h5 class="font-weight-bold">Grafik Total Kegiatan / Tahun</h5>
            </section>
            <div class="card-body bordered border-light">
                <div id="chart" class="chart-area ">
                    <div class="not-found-chart text-center" style="display: none;">
                        <i class="fas fa-flag fa-3x mb-4 grey-text"></i>
                        <h5 class="font-weight-normal mb-3">Kegiatan per Tahun Ini</h5>
                        <p class="text-muted mb-0">Kosong</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="activity-list" class="row m-5">
        <div class="col">
            <section class="dark-grey-text text-center mb-5">
                <h5 class="font-weight-bold"> <i>Corner</i> / Total Kegiatan</h5>
            </section>
            <div class="accordion" id="summary"></div>
        </div>
    </div>

</div>

<?php $this->load->view('pages/admin/ActivityArchieveModals/modalAddActivity') ?>
<?php $this->load->view('pages/admin/ActivityArchieveModals/modalExportActivity') ?>

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

    function deleteActivity(activityID) {
        if (confirm('Apakah anda yakin?')) {

            var value = {
                id: activityID,
            }

            $.post("<?php echo site_url('ActivityArchieve/deleteactivity') ?>", value)
                .done(function(data, status) {

                    getData()

                })
                .fail(function(e, status, thrown) {

                })

        }
    }

    function getActivities(libraryID, indexActivitiesGroup) {

        /** So this function called once per getData() called */
        $('#btn-get-activity-' + indexActivitiesGroup).prop("onclick", null)

        var value = {
            libraryID: libraryID,
        }

        $.post("<?php echo site_url('ActivityArchieve/getActivities') ?>", value)
            .done(function(data, status) {

                $('#loading' + indexActivitiesGroup).remove()

                var response = $.parseJSON(data)

                $.each(response, function(indexReport, data) {
                    var html = ``
                    var images = []

                    if (data['Paths'] != null) {
                        images = data['Paths'].split(', ')
                    }

                    html += `<div id="activity-` + indexReport + `" class="row mb-3">
                        <div class="col-12 ">
                            <div class="card z-depth-0 bordered border-light">
                            <div class="card-body p-0">
                                <div class="row mx-0">
                                <div class="col-md-8 grey lighten-4 rounded-left pt-3">
                                    <h5 class="font-weight-bold">` + data['Nama'] + `</h5>
                                    <h6 class="font-weight-light"><i class="fas fa-user-check" ></i> ` + data['Jumlah Peserta'] + ` Peserta / <i class="fas fa-calendar-check"></i> ` + data['Tanggal Kegiatan'] + `</h6>
                                    <h6 class="font-weight-light"><i class="fas fa-map-marked-alt"></i> ` + data['Tempat'] + ` </h6>
                                    <p class="font-weight-light text-muted text-justify mt-4 mr-2">` + data['Deskripsi'] + `</p>
                                </div>
                                <div class="col-md-4 d-flex align-items-start flex-column align-middle pt-3">
                                    <div>`

                    $.each(images, function(indexPath, image) {
                        thumbnail = image.replace(".", "_thumb.")
                        html += `<a data-fancybox="activity-attachment-` + indexReport + `" href="<?php echo site_url('uploads/') ?>` + image + `"><img style="height: 90px; width: 90px; object-fit: cover" class="mt-1" src="<?php echo site_url('uploads/thumbnails/') ?>` + thumbnail + `"></a>`
                    })

                    html += `</div>
                        <div class="container mt-auto p-3">
                            <button onclick="deleteActivity(` + data['ID Penilaian'] + `)" type="button" class="btn btn-md btn-danger btn-block"><i class="far fa-trash-alt mr-1 fa-lg"></i>Hapus Kegiatan</button>
                            </div>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`

                    $('#reportsGroup-row-' + indexActivitiesGroup).append(html)

                })
            })
            .fail(function(e, status, thrown) {

            })
    }

    function getData() {


        $.post("<?php echo site_url('ActivityArchieve/get') ?>")
            .done(function(data, status) {

                var response = $.parseJSON(data)

                chartData = response.chartData
                totalActivity = response.totalActivity
                totalActivityCurrentMonth = response.totalActivityCurrentMonth

                $.each(response.library, function(index, data) {

                    libraryID = data.Id_perpustakaan
                    libraryName = data.nama
                    $('#library-name-add').append(`<option value="` + libraryID + `" >` + libraryName + `</option>`)
                    $('#library-name-export').append(`<option selected value="` + libraryID + `">` + libraryName + `</option>`)

                })

                if (totalActivity != false) {

                    $('.main-container').show()
                    $('#summary').empty()
                    $('.not-found').hide()

                    drawChart()

                    counting(totalActivity, totalActivityCurrentMonth)

                    $.each(response.summary, function(index, data) {

                        libraryID = data.id
                        libraryName = data.name
                        libraryCount = data.count
                        indexActivitiesGroup = index

                        $('#summary').append(`<div class="card z-depth-0 bordered">
                            <div class="card-header" id="heading` + indexActivitiesGroup + `">
                                <h5 class="mb-0">
                                    <button id="btn-get-activity-` + indexActivitiesGroup + `" onclick="getActivities(` + libraryID + `, ` + indexActivitiesGroup + `)" class="btn  btn-link" type="button" data-toggle="collapse" data-target="#collapse` + indexActivitiesGroup + `" aria-expanded="true" aria-controls="collapse` + indexActivitiesGroup + `">
                                    ` + libraryName + ` <span class="badge black ml-2">` + libraryCount + ` </span>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse` + indexActivitiesGroup + `" class="collapse" aria-labelledby="heading` + indexActivitiesGroup + `" data-parent="#summary">
                                <div id="reportsGroup-row-` + indexActivitiesGroup + `" class="card-body">
                                    <div id="loading` + indexActivitiesGroup + `" class="books-loading d-flex justify-content-center">
                                        <div class="books-loading spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`)

                    })

                } else {

                    $('.main-container').hide()
                    $('.not-found').show()

                }
            })
            .fail(function(e, status, thrown) {

            })
    }


    function showButtonLoading(button) {
        $(button).html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled')
    }

    function hideButtonLoading(button, text, icon) {
        $(button).html(`<i class="fas ` + icon + ` fa-lg mr-1"></i>` + text + ``).removeClass('disabled')
    }


    function counting(totalReportCount, currentMonthReportCount) {
        $('#total-activity-count').attr("data-to", totalReportCount).counter();
        $('#current-month-activity-count').attr("data-to", currentMonthReportCount).counter();
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