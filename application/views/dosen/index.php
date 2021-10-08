<div class="container-fluid">

          <div class="row">

            <div class="col-lg-8 mb-4">

              <!-- Illustrations -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Dosen</h6>
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
                          <th>Username</th>
                          <th>Nip</th>
                          <th>Alamat</th>
                          <th>Jenis Kelamin</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no = 1;
                        foreach ($dosen as $dos) {
                         ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $dos->nama; ?></td>
                          <td><?= $dos->username; ?></td>
                          <td><?= $dos->nip; ?></td>
                          <td><?= $dos->alamat; ?></td>
                          <td><?= $dos->jenis_kelamin; ?></td>
                          <td>
                          <?php if ($this->session->userdata('role_user')=='dosen' || $this->session->userdata('role_user') == 'staf') {
                            echo '<a href="">
                              <span class="badge badge-danger">Hanya Lihat</span>
                              </a>';
                          }else{ ?>
                              <a href="" data-toggle="modal" data-target="#dosenedit" data-id="<?= $dos->id_dosen; ?>">
                              <span class="badge badge-success">Edit</span>
                              </a>
                              <a href="<?= base_url("dosen/hapus/").$dos->id_dosen;?>">
                              <span class="badge badge-danger">Hapus</span>
                              </a>
                          <?php } ?>
                          </td>
                          
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>        
              </table>
            </div>
                  </div>
                </div>
            </div>

            <?php if ($this->session->userdata('role_user')=='dosen' || $this->session->userdata('role_user') == 'staf') {}else{?>
            <div class="col-lg-4 mb-4">

              <!-- Illustrations -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Instructions</h6>
                  </div>
                  <div class="card-body">
                    <p>Untuk menambahkan klik tombol berikut</p>
                    <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#pendik">
                      <span class="icon text-white-50">
                          <i class="fas fa-arrow-right"></i>
                      </span>
                      <span class="text">Tambah Data</span>
                    </a>
                    
                  </div>
                </div>
            </div>
            <?php } ?>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <div class="modal fade" id="pendik" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Data Dosen</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="user" method="post" action="<?= base_url("dosen/add");?>">
                <div class="form-group">
                  <input type="hidden" name="jenis" value="dosen">
                  <label>Username</label>
                  <input type="text" class="form-control"  name="username" required>
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control"  name="nama" required>
                </div>
                 <div class="form-group">
                  <label>Nip</label>
                  <input type="text" class="form-control"  name="nip">
                </div>
                 <div class="form-group">
                  <label>Alamat</label>
                  <textarea name="alamat" class="form-control"></textarea>
                </div>
                 <div class="form-group">
                  <label>Jenis Kelamin</label>
                  <select class="form-control" name="jk">
                    <option selected>Open this select menu</option>
                    <option value="laki-laki">Laki-Laki</option>
                    <option value="perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Jabatan</label>
                  <select class="form-control" name="jabatan" required>
                    <option selected>Open this select menu</option>
                    <?php foreach ($jabatan as $jab) {
                      
                    ?>
                    <option value="<?= $jab->id_jabatan; ?>"><?= $jab->nama_jabatan; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Jenjang</label>
                  <select class="form-control" name="jenjang" required>
                    <option selected>Open this select menu</option>
                    <?php foreach ($jenjang as $jej) {
                      
                    ?>
                    <option value="<?= $jej->id_jenjang; ?>"><?= $jej->nama_jenjang; ?></option>
                    <?php } ?>
                  </select>
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
      <div class="modal fade" id="dosenedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Data Dosen</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
            <form class="prodi" method="post" action="<?= base_url("dosen/update")?>">
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
        $('#dosenedit').on('show.bs.modal', function (e) {
            var userDat = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '<?= base_url("dosen/praedit") ?>',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'dosenid='+ userDat,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>