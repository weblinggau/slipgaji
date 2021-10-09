<div class="container-fluid">

          <div class="row">

            <div class="col-lg-8 mb-4">

              <!-- Illustrations -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Absen Dosen <span class="badge badge-warning">Periode <?= array_search($bulan,$bulans).' tahun '.$tahun; ?></span></h6>
                  </div>
                  <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <div>
                    <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Nip</th>
                          <th>Masuk</th>
                          <th>Absen</th>
                          <th>Sakit</th>
                          <th>Sakit Non Skd</th>
                          <th>Izin</th>
                          <th>Cuti</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no = 1;
                          foreach ($absen as $ab) {
                           ?>
                          <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $ab->nama; ?></td>
                            <td><?= $ab->nip; ?></td>
                            <td><?= $ab->masuk; ?></td>
                            <td><?= $ab->absen; ?></td>
                            <td><?= $ab->sakit_skd; ?></td>
                            <td><?= $ab->sakit_non_skd; ?></td>
                            <td><?= $ab->izin; ?></td>
                            <td><?= $ab->cuti; ?></td>
                            <td>
                                <a href="" data-toggle="modal" data-target="#editabsen" data-id="<?= $ab->id_absen; ?>">
                                <span class="badge badge-success">Edit</span>
                                </a>
                                <a href="<?= base_url("absen/hapusdosen/").$ab->id_absen;?>">
                                <span class="badge badge-danger">Hapus</span>
                                </a>
                            </td>
                          </tr>
                        <?php }?>
                      </tbody>
                    </table>
                  </div>        
              </table>
            </div>
                  </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">

              <!-- Illustrations -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Instructions</h6>
                  </div>
                  <div class="card-body">
                    <div>
                      <div class="card">
                        <div class="card-header">
                          Filter Periode
                        </div>
                        <div class="card-body">
                            <form class="" method="post" action="<?= base_url("absen/dosen");?>">
                              <div class="form-group row g-3">
                                  <div class="col-md-7">
                                    <label class="form-label">Bulan</label>
                                    <select class="form-control" name="bulan">
                                      <option selected>Pilih Bulan</option>
                                      <option value="01">Januari</option>
                                      <option value="02">Februari</option>
                                      <option value="03">Maret</option>
                                      <option value="04">April</option>
                                      <option value="05">Mei</option>
                                      <option value="06">Juni</option>
                                      <option value="07">Juli</option>
                                      <option value="08">Agustus</option>
                                      <option value="09">September</option>
                                      <option value="10">Oktober</option>
                                      <option value="11">November</option>
                                      <option value="12">Desember</option>
                                    </select>
                                  </div>
                                  <div class="col-md-5">
                                    <label class="form-label">Tahun</label>
                                    <input type="number" class="form-control" name="tahun">
                                  </div>
                              </div>
                              <button type="submit" class="btn btn-primary btn-user">
                                  Cari Data</button>
                            </form>
                        </div>
                      </div>
                    <div><br><br>
                      <p>Untuk menambahkan klik tombol berikut</p>
                      <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#absen">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="text">Input Absen</span>
                      </a>
                    </div>
                    
                  </div>
                </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <div class="modal fade" id="absen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Input Data Absensi</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="user" method="post" action="<?= base_url("absen/adddosen");?>">
                <div class="form-group">
                  <label>Nama Dosen</label>
                  <select class="form-control" name="dosen" required>
                    <option selected>Pilih Nama Dosen..</option>
                    <?php foreach ($dosen as $dos) {
                      
                    ?>
                    <option value="<?= $dos->id_dosen; ?>"><?= $dos->nama; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group row g-3">
                  <div class="col-md-6">
                    <label>Periode Bulan</label>
                    <select class="form-control" name="bulan" required>
                      <option selected>Pilih Bulan..</option>
                      <option value="01">Januari</option>
                      <option value="02">Februari</option>
                      <option value="03">Maret</option>
                      <option value="04">April</option>
                      <option value="05">Mei</option>
                      <option value="06">Juni</option>
                      <option value="07">Juli</option>
                      <option value="08">Agustus</option>
                      <option value="09">September</option>
                      <option value="10">Oktober</option>
                      <option value="11">November</option>
                      <option value="12">Desember</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label>tahun</label>
                  <input type="number" class="form-control"  name="tahun" required>
                  </div>
                </div><br>
                <p>Input Jumlah Absen 1 Bulan</p>
                <div class="form-group row g-3">
                  <div class="col-md-4">
                    <label>Masuk</label>
                    <input type="number" class="form-control"  name="masuk">
                  </div>
                  <div class="col-md-4">
                    <label>Absen</label>
                    <input type="number" class="form-control"  name="absen">
                  </div>
                  <div class="col-md-4">
                    <label>Sakit</label>
                    <input type="number" class="form-control"  name="sakit">
                  </div>
                  <div class="col-md-4">
                    <label>Sakit Non SKD</label>
                    <input type="number" class="form-control"  name="stskd">
                  </div>
                  <div class="col-md-4">
                    <label>Izin</label>
                    <input type="number" class="form-control"  name="izin">
                  </div>
                  <div class="col-md-4">
                    <label>Cuti</label>
                    <input type="number" class="form-control"  name="cuti">
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary btn-user">Save Data</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal fade" id="editabsen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Data Absensi Dosen</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
            <form class="prodi" method="post" action="<?= base_url("absen/updatedosen")?>">
              <div class="modal-data"></div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary btn-user">Edit Data</button>
            </div>
            </form>
          </div>
        </div>
      </div>
  <script type="text/javascript">
    $(document).ready(function(){
        $('#editabsen').on('show.bs.modal', function (e) {
            var userDat = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '<?= base_url("absen/dosenpraedit") ?>',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'idabsen='+ userDat,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>