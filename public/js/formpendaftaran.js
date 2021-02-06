$(function(){
$("#wizard").steps({
	headerTag: "h4",
	bodyTag: "section",
	transitionEffect: "fade",
	enablePagination: false,
	transitionEffectSpeed: 300,
	onStepChanging: function (event, currentIndex, newIndex) { 
		if (currentIndex > newIndex)
		{
			return true;
		}
		
		if (currentIndex < newIndex)
		{
			$(this).find(".body:eq(" + newIndex + ") label.is-invalid").remove();
			$(this).find(".body:eq(" + newIndex + ") .is-invalid").removeClass("is-invalid");
		}
		
		$(this).validate().settings.ignore = ":disabled,:hidden";
		return $(this).valid();
	},
	onStepChanged: function (event, currentIndex, newIndex){
		if ( currentIndex === 0 ) {
			$("#box-step1").addClass("wizard-step-active");
            $("#box-step2").removeClass("wizard-step-active");
			$("#box-step3").removeClass("wizard-step-active");
		}

		if ( currentIndex === 1 ) {
			$("#box-step1").removeClass("wizard-step-active");
			$("#box-step2").addClass("wizard-step-active");
            $("#box-step3").removeClass("wizard-step-active");
		}

		if ( currentIndex === 2 ) {
			$("#box-step1").removeClass("wizard-step-active");
			$("#box-step2").removeClass("wizard-step-active");
            $("#box-step3").addClass("wizard-step-active");
			$("#nama_pendtfr").html($("#nama_seka_pendaftar").val());
            $("#email_pendtfr").html($("#email_pendaftar").val());
            $("#alamat_pendtfr").html($("#alamat_pendaftar").val());
            $("#kategori_pendtfr").html($("#kategori_layangan_pendaftar option:selected").text());
            $("#jenis_pendtfr").html($("#jenis_layangan_pendaftar option:selected").text());
            $("#jadwal_pendtfr").html($("#jadwal_pendaftar option:selected").text());
			$("#jumlah_pendtfr").html(IDRFormatter($("#kategori_layangan_pendaftar option:selected").data('biaya'),"Rp. "));
		}

	}
}).validate({
	errorClass: "is-invalid",
	errorPlacement: function errorPlacement(error, element) { 
		error.appendTo( element.parent("div"));
	},
	rules: {
		
	},
	messages: {
		nama_seka_pendaftar: "Nama Seka Harus Diisi",
		email_pendaftar: "E-Mail Harus Diisi",
		alamat_pendaftar: "Alamat Harus Diisi",
		kategori_layangan_pendaftar: "Kategori Layangan Harus Dipilih",
		jenis_layangan_pendaftar: "Jenis Layangan Harus Dipilih",
		jadwal_pendaftar: "Jenis Layangan Harus Dipilih",
		gambar_layangan_pendaftar: "Harap Memilih Gambar (Maksimal 2 Gambar!)"
	  }
});
})