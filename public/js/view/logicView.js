//Set Keadaan Function Ready untuk Dipanggil
$(document).ready(function() {
    moment.locale("id");

    //Fungsi Element Saat Di Klik
    $("[id^=tombollokasiotomatis]").click(function () {
        var jenis = $(this).data('jenis');
        mapInit(jenis);
    });

    //Sembunyikan Element
    $("#infoAlamat").hide();

    //Panggil Function Penampilan Data Pada DataTables dan Fungsi Hapus Pada Masing-Masing Halaman
    table_pendaftar();
    table_petugas();
    hapus_petugas();
    table_jadwal();
    hapus_jadwal();
    table_jenis();
    hapus_jenis();
    table_kategori();
    hapus_kategori();
    table_lokasi();
    hapus_lokasi();
});

//Custom Function
function IDRFormatter(angka, prefix) {
    var number_string = angka.toString().replace(/[^,\d]/g, ''),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

//Peserta
function table_pendaftar(){
    $(document).ajaxStart(function() { Pace.restart(); });
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabel_data_pendaftar').on( 'error.dt', function ( e, settings, techNote, message ) {
        console.log( 'An error has been reported by DataTables: ', message );
    } ) ;
    $('#tabel_data_pendaftar').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: url,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 8 },
            { targets:6, render:function(data, type, row, meta){
                return `[${row.jadwal.hari_jadwal}] - ${moment(row.jadwal.tanggal_jadwal).format('LL')}`;
            }}, 
            { responsivePriority: 3, targets:7, render:function(data){
                var status;
                switch(data) {
                    case '':
                       status = '<div class="badge badge-warning">Sedang Ditinjau</div>';
                    break;
                    case 'diterima':
                       status = '<div class="badge badge-primary">Diterima</div>';
                    break;
                    case 'ditolak':
                        status = '<div class="badge badge-danger">Ditolak</div>';
                    break;
                }
                return status;
            }},
        ],
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nama_seka_pendaftar', name: 'nama_seka_pendaftar'},
            {data: 'email_pendaftar', name: 'email_pendaftar'},
            {data: 'alamat_pendaftar', name: 'alamat_pendaftar'},
            {data: 'kategori.kategori_layangan', name: 'kategori.kategori_layangan'},
            {data: 'jenis.jenis_layangan', name: 'jenis.jenis_layangan'},
            {data: 'jadwal.tanggal_jadwal', name: 'jadwal.tanggal_jadwal'},
            {data: 'status_pendaftar', name: 'status_pendaftar'},
            {data: 'aksi', name: 'aksi', orderable: false, searchable: false}
        ]
    });
}


//Jadwal
function hapus_jadwal(){
    $('#tabel_data_jadwal').on('click', '#btn-delete-jadwal[data-remote]', function (e) { 
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var remote = $(this).data('remote');
        var tanggal_jadwal = $(this).data('tanggal_jadwal');

        Swal.fire({
            title: 'Hapus Data?',
            text: "Apakah Anda Ingin Menghapus Jadwal "+ tanggal_jadwal +".?",
            type: 'warning',
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonText: 'Ya'
          }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: remote,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {method: '_DELETE', submit: true},
                }).always(function (data) {
                    Swal.fire(
                        data.label,
                        data.status,
                        data.ikon)
                    $('#tabel_data_jadwal').DataTable().draw(false);
                });
            }
          })
    });
}

function table_jadwal(){
    $(document).ajaxStart(function() { Pace.restart(); });
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabel_data_jadwal').on( 'error.dt', function ( e, settings, techNote, message ) {
        console.log( 'An error has been reported by DataTables: ', message );
    } ) ;
    $('#tabel_data_jadwal').DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { targets:2, render:function(data){
                return moment(data).format('LL'); 
            }},
            { targets:3, render:function(data){
                return moment(data, 'HH:mm:ss').format('HH.mm');
            }}
        ],
        columns: [
            {data: 'DT_RowIndex', name: 'id'},
            {data: 'hari_jadwal', name: 'hari_jadwal'},
            {data: 'tanggal_jadwal', name: 'tanggal_jadwal'},
            {data: 'waktu_jadwal', name: 'waktu_jadwal'},
            {data: 'lokasi.tempat_lokasi', name: 'lokasi.tempat_lokasi'},
            {data: 'aksi', name: 'aksi', orderable: false, searchable: false}
        ]
    });
}

//Petugas
function hapus_petugas(){
    $('#tabel_data_petugas').on('click', '#btn-delete-petugas[data-remote]', function (e) { 
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var remote = $(this).data('remote');
        var nama_petugas = $(this).data('nama');

        Swal.fire({
            title: 'Hapus Data?',
            text: "Apakah Anda Ingin Menghapus Petugas "+ nama_petugas +".?",
            type: 'warning',
            showCancelButton: true,
            reverseButtons: true,
            input: 'password',
            confirmButtonText: 'Ya',
            preConfirm: (result) => {
                if (result) {
                    $.ajax({
                        url: remote,
                        type: 'DELETE',
                        dataType: 'json',
                        data: { method: '_DELETE', submit: true, password: result },
                        processData: true,
                        success: function (data) {
                            Swal.fire(
                                data.label,
                                data.status,
                                data.ikon)
                            switch (data.label) {
                                case 'Berhasil':
                                    $('#tabel_data_petugas').DataTable().draw(false);
                                break;
                            };
                        }
                    });
                } else {
                    Swal.showValidationMessage('Harap masukan Password untuk konfirmasi penghapusan petugas.!')
                }
            }
          }).then((result) => {
            if (!result.value) {
                Swal.fire({
                    type: 'info',
                    title: 'Dibatalkan',
                    text: 'Penghapusan Petugas Dibatalkan.',
                    showConfirmButton: false,
                })
            }
          })
    });
}

function table_petugas(){
    $(document).ajaxStart(function() { Pace.restart(); });
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabel_data_petugas').on( 'error.dt', function ( e, settings, techNote, message ) {
    console.log( 'An error has been reported by DataTables: ', message );
    } ) ;
    $('#tabel_data_petugas').DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columnDefs: [
            { responsivePriority: 1, targets: 0 }
        ],
        columns: [
            {data: 'DT_RowIndex', name: 'id',"width": "5%"},
            {data: 'photo', name: 'photo',"width": "5%"},
            {data: 'name_pengguna', name: 'name_pengguna'},
            {data: 'aksi', name: 'aksi', "width": "5%",orderable: false, searchable: false}
        ]
    });
}


//Jenis
function hapus_jenis(){
    $('#tabel_data_jenis').on('click', '#btn-delete-jenis[data-remote]', function (e) { 
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var remote = $(this).data('remote');
        var jenis_layangan = $(this).data('jenis_layangan');

        Swal.fire({
            title: 'Hapus Data?',
            text: "Apakah Anda Ingin Menghapus Jenis "+ jenis_layangan +".?",
            type: 'warning',
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonText: 'Ya'
          }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: remote,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {method: '_DELETE', submit: true},
                }).always(function (data) {
                    Swal.fire(
                        data.label,
                        data.status,
                        data.ikon)
                    $('#tabel_data_jenis').DataTable().draw(false);
                });
            }
          })
    });
}

function table_jenis(){
    $(document).ajaxStart(function() { Pace.restart(); });
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabel_data_jenis').on( 'error.dt', function ( e, settings, techNote, message ) {
    console.log( 'An error has been reported by DataTables: ', message );
    } ) ;
    $('#tabel_data_jenis').DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columnDefs: [
            { responsivePriority: 1, targets: 0 }
        ],
        columns: [
            {data: 'DT_RowIndex', name: 'id',"width": "5%"},
            {data: 'jenis_layangan', name: 'jenis_layangan'},
            {data: 'aksi', name: 'aksi', "width": "15%",orderable: false, searchable: false}
        ]
    });
}

//Kategori
function hapus_kategori() {
    $('#tabel_data_kategori').on('click', '#btn-delete-kategori[data-remote]', function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var remote = $(this).data('remote');
        var kategori_layangan = $(this).data('kategori_layangan');

        Swal.fire({
            title: 'Hapus Data?',
            text: "Apakah Anda Ingin Menghapus Kategori " + kategori_layangan + ".?",
            type: 'warning',
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: remote,
                    type: 'DELETE',
                    dataType: 'json',
                    data: { method: '_DELETE', submit: true },
                }).always(function (data) {
                    Swal.fire(
                        data.label,
                        data.status,
                        data.ikon)
                    $('#tabel_data_kategori').DataTable().draw(false);
                });
            }
        })
    });
}

function table_kategori() {
    $(document).ajaxStart(function () { Pace.restart(); });
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabel_data_kategori').on('error.dt', function (e, settings, techNote, message) {
        console.log('An error has been reported by DataTables: ', message);
    });
    $('#tabel_data_kategori').DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { targets:2, render:function(data){
                return IDRFormatter(data, "Rp. ");
            }}
        ],
        columns: [
            { data: 'DT_RowIndex', name: 'id', "width": "5%" },
            { data: 'kategori_layangan', name: 'kategori_layangan' },
            { data: 'biaya', name: 'biaya' },
            { data: 'aksi', name: 'aksi', "width": "15%", orderable: false, searchable: false }
        ]
    });
}

//Kategori
function hapus_lokasi() {
    $('#tabel_data_lokasi').on('click', '#btn-delete-lokasi[data-remote]', function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var remote = $(this).data('remote');
        var tempat_lokasi = $(this).data('tempat_lokasi');

        Swal.fire({
            title: 'Hapus Data?',
            text: "Apakah Anda Ingin Menghapus Lokasi " + tempat_lokasi + ".?",
            type: 'warning',
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: remote,
                    type: 'DELETE',
                    dataType: 'json',
                    data: { method: '_DELETE', submit: true },
                }).always(function (data) {
                    Swal.fire(
                        data.label,
                        data.status,
                        data.ikon)
                    $('#tabel_data_lokasi').DataTable().draw(false);
                });
            }
        })
    });
}

function table_lokasi() {
    $(document).ajaxStart(function () { Pace.restart(); });
    $.fn.dataTable.ext.errMode = 'none';
    $('#tabel_data_lokasi').on('error.dt', function (e, settings, techNote, message) {
        console.log('An error has been reported by DataTables: ', message);
    });
    $('#tabel_data_lokasi').DataTable({
        processing: true,
        serverSide: true,
        ajax: url,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            {
                targets: 6, render: function (data) {
                    return '<a class="btn btn-xs btn-success btn-flat" href="' + data + '" target="_blank"><i class="far fa-eye"></i></a>'; 
                }
            }
        ],
        columns: [
            { data: 'DT_RowIndex', name: 'id', "width": "5%" },
            { data: 'tempat_lokasi', name: 'tempat_lokasi', "width": "5%"  },
            { data: 'jalan_lokasi', name: 'jalan_lokasi' },
            { data: 'kecamatan_lokasi', name: 'kecamatan_lokasi' },
            { data: 'lat_lokasi', name: 'lat_lokasi' },
            { data: 'lng_lokasi', name: 'lng_lokasi' },
            { data: 'link_lokasi', name: 'link_lokasi' },
            { data: 'aksi', name: 'aksi', "width": "15%", orderable: false, searchable: false }
        ]
    });
}

//Custom Map
function mapInit(jenis) {
    $('#map-canvas').html("<div id='map'></div>");
    var modalElm = $('#lokasiotomatis');

    var map = L.map("map", {
        zoom: 10,
        center: [-8.65977227887551, 115.21739959716798],
        zoomControl: true,
        attributionControl: false
    });


    var theMarker = {};
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var geocodeService = L.esri.Geocoding.geocodeService();

    map.on('click', function (e) {
        geocodeService.reverse().latlng(e.latlng).run(function (error, result) {
            var defObject = $.Deferred();
            defObject.resolve(result.address.Match_addr);
            $.when(defObject.promise()).done(function (r) {
                result = r;
                var address = result;
                var splitAddress = new Array();
                splitAddress = address.split(",");
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;
                $("#infoAlamat").show();
                $('#infoAlamat').html("Lokasi Yang Di Pilih : " + splitAddress[0] + ", " + splitAddress[1] + ", " + splitAddress[2] + ", " + splitAddress[3]);
                switch (jenis) {
                    case 'tambah':
                        $("#kecamatan_lokasi_tambah").val(splitAddress[2]);
                        $("#kabupaten_lokasi_tambah").val(splitAddress[3]);
                        $("#jalan_lokasi_tambah").val(splitAddress[0] + ", " + splitAddress[1]);
                        $("#lat_lokasi_tambah").val(lat.toString().substring(0, 9));
                        $("#lng_lokasi_tambah").val(lng.toString().substring(0, 9));
                        $("#link_lokasi_tambah").val('http://google.com/maps?q=' + e.latlng.lat + ',' + e.latlng.lng);
                        break;
                    case 'edit':
                        $("#kecamatan_lokasi_edit").val(splitAddress[2]);
                        $("#kabupaten_lokasi_edit").val(splitAddress[3]);
                        $("#jalan_lokasi_edit").val(splitAddress[0] + ", " + splitAddress[1]);
                        $("#lat_lokasi_edit").val(lat.toString().substring(0, 9));
                        $("#lng_lokasi_edit").val(lng.toString().substring(0, 9));
                        $("#link_lokasi_edit").val('http://google.com/maps?q=' + e.latlng.lat + ',' + e.latlng.lng);
                        break;
                }
            })
            map.removeLayer(theMarker);
            theMarker = L.marker(e.latlng).addTo(map);
        });
    });

    map.addControl(new L.Control.Search({
        url: 'https://nominatim.openstreetmap.org/search?format=json&q={s}',
        jsonpParam: 'json_callback',
        propertyName: 'display_name',
        propertyLoc: ['lat', 'lon'],
        marker: L.circleMarker([0, 0], {
            radius: 30,
            color: '#f03',
            fillColor: '#f03',
            fillOpacity: 0.80
        }),
        autoCollapse: true,
        autoType: false,
        minLength: 2
    }));

    modalElm.modal('show');
    modalElm.on('shown.bs.modal', function () {
        setTimeout(function () {
            map.invalidateSize();
        }, 10);
    });
    $(document).on('hidden.bs.modal', '.modal', function () {
        $('.modal:visible').length && $(document.body).addClass('modal-open');
    });
}