<div class="container-fluid">

          <div class="row">

            <div class="col-lg-8 mb-4">

              <!-- Illustrations -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Gaji Dosen <span class="badge badge-warning">Periode <?= array_search($bulan,$bulans).' tahun '.$tahun; ?></span></h6>
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
                          <th>Total Pendapatan</th>
                          <th>Total Potongan</th>
                          <th>Jumlah Gaji</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no = 1;
                          foreach ($gaji as $gaj) {
                              $totalpd = array(
                              'gapok' => $gaj->gapok,
                              'tj_jabatan' => $gaj->tj_jabatan,
                              'uang_makan' => $gaj->uang_makan,
                              'lembur' => $gaj->lembur,
                              'transport' => $gaj->transport,
                              'bonus' => $gaj->bonus,
                              'thr' => $gaj->thr,
                              );
                              $ttpdtan = array_sum($totalpd);

                              $totalpt = array(
                              'cicilan' => $gaj->cicilan_pinjaman,
                              'jamsostek' => $gaj->jamsostek,
                              'telat' => $gaj->pt_telat,
                              'absen' => $gaj->pt_absen,
                              'pph' => $gaj->pph21
                              );
                              $ttptngan = array_sum($totalpt);

                              $jmlhgaji = $ttpdtan - $ttptngan;
                           ?>
                          <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $gaj->nama; ?></td>
                            <td><?= $gaj->nip; ?></td>
                            <td><?= 'Rp. '.number_format($ttpdtan, 0, ",", "."); ?></td>
                            <td><?= 'Rp. '.number_format($ttptngan, 0, ",", "."); ?></td>
                            <td><?= 'Rp. '.number_format($jmlhgaji, 0, ",", "."); ?></td>
                            <td>
                                <a href="<?= base_url("gaji/dosencetak/").$gaj->id_gaji;?>">
                                <span class="badge badge-warning">Cetak</span>
                                </a>
                                <a href="<?= base_url("gaji/detailgajidosen/").$gaj->id_gaji;?>">
                                <span class="badge badge-success">Detail</span>
                                </a>
                                <a href="" data-toggle="modal" data-target="#editgaji" data-id="<?= $gaj->id_gaji; ?>">
                                <span class="badge badge-success">Edit</span>
                                </a>
                                <a href="<?= base_url("gaji/hapusdosen/").$gaj->id_gaji.'/'.$gaj->id_pendapatan.'/'.$gaj->id_potong;?>">
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
                            <form class="" method="post" action="<?= base_url("gaji/dosen");?>">
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
                      <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#gaji">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="text">Input Gaji</span>
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
      <div class="modal fade" id="gaji" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Input Data Absensi</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="user" method="post" action="<?= base_url("gaji/adddosen");?>">
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
                <p>Input Pendapatan Gaji</p>
                <div class="form-group row g-3">
                  <div class="col-md-4">
                    <label>Gaji Pokok</label>
                    <input type="number" class="form-control"  name="gapok">
                  </div>
                  <div class="col-md-4">
                    <label>Tunjangan Jabatan</label>
                    <input type="number" class="form-control"  name="tj_jabatan">
                  </div>
                  <div class="col-md-4">
                    <label>Uang Makan</label>
                    <input type="number" class="form-control"  name="makan">
                  </div>
                  <div class="col-md-4">
                    <label>Transportasi</label>
                    <input type="number" class="form-control"  name="transport">
                  </div>
                  <div class="col-md-4">
                    <label>Bonus</label>
                    <input type="number" class="form-control"  name="bonus">
                  </div>
                  <div class="col-md-4">
                    <label>THR</label>
                    <input type="number" class="form-control"  name="thr">
                  </div>
                  <div class="col-md-4">
                    <label>Lembur</label>
                    <input type="number" class="form-control"  name="lembur">
                  </div>
                </div><br>
                <p>Input Potongan Gaji</p>
                <div class="form-group row g-3">
                  <div class="col-md-4">
                    <label>Cicilan Pinjaman</label>
                    <input type="number" class="form-control"  name="cicilan">
                  </div>
                  <div class="col-md-4">
                    <label>Jamsostek</label>
                    <input type="number" class="form-control"  name="jamsostek">
                  </div>
                  <div class="col-md-4">
                    <label>Potongan Telat</label>
                    <input type="number" class="form-control"  name="telat">
                  </div>
                  <div class="col-md-4">
                    <label>Potongan Absen</label>
                    <input type="number" class="form-control"  name="absen">
                  </div>
                  <div class="col-md-4">
                    <label>PPH21</label>
                    <input type="number" class="form-control"  name="pph">
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
      <div class="modal fade" id="editgaji" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Data Gaji Dosen</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
            <form class="prodi" method="post" action="<?= base_url("gaji/updatedosen")?>">
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
        $('#editgaji').on('show.bs.modal', function (e) {
            var userDat = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '<?= base_url("gaji/dosenpraedit") ?>',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'idgaji='+ userDat,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>