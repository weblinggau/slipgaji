<div class="container-fluid">

          <div class="row">

            <div class="col-lg-8 mb-4">

              <!-- Illustrations -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Admin</h6>
                  </div>
                  <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <div>
                    <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Jenjang</th>
                          <th>Gelar</th>
                          <th>Bidang Studi</th>
                          <th>Institusi</th>
                          <th>Tahun Masuk</th>
                          <th>Tahun Lulus</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- <?php 
                        $no = 1;
                        foreach ($pendik as $pn) {
                         ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $pn->jenjang; ?></td>
                          <td><?= $pn->gelar; ?></td>
                          <td><?= $pn->bidang_studi; ?></td>
                          <td><?= $pn->institusi; ?></td>
                          <td><?= $pn->tahun_masuk; ?></td>
                          <td><?= $pn->tahun_lulus; ?></td>
                          <td>
                              <a href="" data-toggle="modal" data-target="#editpendik" data-id="<?= $pn->id_pendidikan; ?>">
                              <span class="badge badge-success">Edit</span>
                              </a>
                              <a href="<?= base_url("pendidikan/hapus/").$pn->id_pendidikan;?>">
                              <span class="badge badge-danger">Hapus</span>
                              </a>
                          </td>
                        </tr>
                        <?php } ?> -->
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
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <div class="modal fade" id="pendik" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pendidikan</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="user" method="post" action="<?= base_url("pendidikan/add");?>">
                <div class="form-group">
                  <label>Jenjang</label>
                  <input type="text" class="form-control"  name="jenjang">
                </div>
                <div class="form-group">
                  <label>Gelar</label>
                  <input type="text" class="form-control"  name="gelar">
                </div>
                <div class="form-group">
                  <label>Bidang Studi</label>
                  <input type="text" class="form-control"  name="studi">
                </div>
                 <div class="form-group">
                  <label>Institusi</label>
                  <input type="text" class="form-control"  name="stut">
                </div>
                 <div class="form-group">
                  <label>Tahun Masuk</label>
                  <input type="text" class="form-control"  name="masuk">
                </div>
                 <div class="form-group">
                  <label>Tahun Lulus</label>
                  <input type="text" class="form-control"  name="lulus">
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
      <div class="modal fade" id="editpendik" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Data Pendidikan</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
            <form class="prodi" method="post" action="<?= base_url("pendidikan/update")?>">
              <div class="modal-data"></div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary btn-user">Edit Data Pendidikan</button>
            </div>
            </form>
          </div>
        </div>
      </div>
  <script type="text/javascript">
    $(document).ready(function(){
        $('#editpendik').on('show.bs.modal', function (e) {
            var userDat = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '<?= base_url("pendidikan/praedit") ?>',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'pendik='+ userDat,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>