@extends('base_layout.admin_layout',$datapetugas)
@section('lokasi_kontent',"Pengaturan Profile")
@section('kontent')
<section class="section">
    <div class="section-header">
    <h1>Profile</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item">Profile</div>
    </div>
    </div>
    <div class="section-body">
    <h2 class="section-title">Hi, {{Auth::user()->name_pengguna}}</h2>
    <p class="section-lead">
        Ubah informasi tentang anda pada halaman ini.
    </p>

			<div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                  <div class="profile-widget-header">
					<figure class="avatar mr-2 avatar-xl profile-widget-picture">
					  <img src="{{ asset('images/profile/'.Auth::user()->photo_pengguna)}}" alt="...">
					  <i style="color: #191d21; background: #fff0; cursor: pointer;" class="fa fa-camera avatar-icon" aria-hidden="true"></i>
					</figure>
				  </div>
				  <div class="profile-widget-description">
						<div class="profile-widget-name">{{Auth::user()->name_pengguna}} <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> Administrator</div></div>
					</div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-7">
                <div class="card">
                  <form method="post" class="needs-validation" novalidate="">
                    <div class="card-header">
                      <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                          <div class="form-group col-md-6 col-12">
                            <label>First Name</label>
                            <input type="text" class="form-control" value="Ujang" required="">
                            <div class="invalid-feedback">
                              Please fill in the first name
                            </div>
                          </div>
                          <div class="form-group col-md-6 col-12">
                            <label>Last Name</label>
                            <input type="text" class="form-control" value="Maman" required="">
                            <div class="invalid-feedback">
                              Please fill in the last name
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-7 col-12">
                            <label>Email</label>
                            <input type="email" class="form-control" value="ujang@maman.com" required="">
                            <div class="invalid-feedback">
                              Please fill in the email
                            </div>
                          </div>
                          <div class="form-group col-md-5 col-12">
                            <label>Phone</label>
                            <input type="tel" class="form-control" value="">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-12">
                            <label>Bio</label>
                            <textarea class="form-control summernote-simple">Ujang maman is a superhero name in <b>Indonesia</b>, especially in my family. He is not a fictional character but an original hero in my family, a hero for his children and for his wife. So, I use the name as a user in this template. Not a tribute, I'm just bored with <b>'John Doe'</b>.</textarea>
                          </div>
                        </div>
						<div class="row">
							<div class="form-group col-12">
									<label for="konfirmasi_pengubahan">Konfirmasi Pengubahan</label>
									<div class="input-group">
										<input type="password" class="form-control" id="konfirmasi_pengubahan" name="konfirmasi_pengubahan">
											<div class="input-group-append" data-toggle="tooltip" data-placement="right" title="" data-original-title="Anda harus memasukan password sebelumnya sebagai konfirmasi pengubahan data petugas!">
												<div class="input-group-text" style="background: #e9ecef;"><i class="fa fa-exclamation-triangle"></i></div>
											</div>
									</div>
							</div>
                </div>
                    </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary">Save Changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
    </div>
</section>
@endsection