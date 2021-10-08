		<div class="container-fluid">

	          <!-- Page Heading -->
	          <div class="d-sm-flex align-items-center justify-content-between mb-4">
	            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
	          </div>
	        <div class="row">

	            <div class="col-lg-12 mb-4">

	              <!-- Illustrations -->
	                <div class="card shadow mb-4">
	                  <div class="card-header py-3">
	                    <h6 class="m-0 font-weight-bold text-primary">Selamat Datang Kembali di halaman <?= $this->session->userdata('role_user');?></h6>
	                  </div>
	                  <div class="card-body">
	                    <div class="text-center">
	                      <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="<?= base_url('assets/'); ?>img/undraw_posting_photo.svg" alt="">
	                    </div><center>
	                    <p>Ini Adalah halaman utama untuk aplikasi slip gaji pegawai</p>
	                    </center>
	                  </div>
	                </div>
	            </div>
	          </div>
	        </div>
        <!-- /.container-fluid -->
      </div>