<div class="container-fluid">

          <div class="row">

            <div class="col-lg-8 mb-4">

              <!-- Illustrations -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Dosen</h6>
                  </div>
                  <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <div>
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
                        <div class="modal-footer">
                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary btn-user">Save Data</button>
                        </div>
                      </form>
                    </div>
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
      
  