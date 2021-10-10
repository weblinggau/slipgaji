<div class="container-fluid">

          <div class="row">

            <div class="col-lg-4 mb-4">

              <!-- Illustrations -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Dasar</span></h6>
                  </div>
                  <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                    <div>
                      <div class="card">
                        <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Data Pokok</h6>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-bordered">
                              <tbody>
                                  <tr>
                                    <th scope="row">Nama </th>
                                    <th colspan="2"><?= $dosen->nama; ?></th>
                                  </tr>
                                  <tr>
                                    <th scope="row">NIP </th>
                                    <th colspan="2"><?= $dosen->nip; ?></th>
                                  </tr>
                                  <tr>
                                    <th scope="row">Jabatan </th>
                                    <th colspan="2"><?= $dosen->nama_jabatan; ?></th>
                                  </tr>
                                  <tr>
                                    <th scope="row">Jenjang </th>
                                    <th colspan="2"><?= $dosen->nama_jenjang; ?></th>
                                  </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div><br>
                      <div class="card">
                        <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Data Absensi</h6>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-bordered">
                              <tbody>
                                  <tr>
                                    <th scope="row">Masuk </th>
                                    <th colspan="2"><?= $absen->masuk; ?></th>
                                  </tr>
                                  <tr>
                                    <th scope="row">Absen </th>
                                    <th colspan="2"><?= $absen->absen; ?></th>
                                  </tr>
                                  <tr>
                                    <th scope="row">Sakit SKD </th>
                                    <th colspan="2"><?= $absen->sakit_skd; ?></th>
                                  </tr>
                                  <tr>
                                    <th scope="row">Sakit NON SKD </th>
                                    <th colspan="2"><?= $absen->sakit_non_skd; ?></th>
                                  </tr>
                                  <tr>
                                    <th scope="row">Izin </th>
                                    <th colspan="2"><?= $absen->izin; ?></th>
                                  </tr>
                                  <tr>
                                    <th scope="row">Cuti </th>
                                    <th colspan="2"><?= $absen->cuti; ?></th>
                                  </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
              <!-- Illustrations -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Gaji</h6>
                  </div>
                  <div class="card-body">
                    <div>
                      <div class="card">
                        <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Detail Pendapatan</h6>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-bordered">
                              <tbody>
                                  <tr>
                                    <th scope="row">Gaji Pokok </th>
                                    <th colspan="2" style="text-align: right;"><?= 'Rp. '.number_format($gaji->gapok, 0, ",", "."); ?></th>
                                  </tr>
                                  <tr>
                                    <th scope="row">Tunjangan Jabatan</th>
                                    <th colspan="2" style="text-align: right;"><?= 'Rp. '.number_format($gaji->tj_jabatan, 0, ",", "."); ?></th>
                                  </tr>
                                  <tr>
                                    <th scope="row">Uang Makan </th>
                                    <th colspan="2" style="text-align: right;"><?= 'Rp. '.number_format($gaji->uang_makan, 0, ",", "."); ?></th>
                                  </tr>
                                  <tr>
                                    <th scope="row">Transport</th>
                                    <th colspan="2" style="text-align: right;"><?= 'Rp. '.number_format($gaji->transport, 0, ",", "."); ?></th>
                                  </tr>
                                  <tr>
                                    <th scope="row">Bonus</th>
                                    <th colspan="2" style="text-align: right;"><?= 'Rp. '.number_format($gaji->bonus, 0, ",", "."); ?></th>
                                  </tr>
                                  <tr>
                                    <th scope="row">THR</th>
                                    <th colspan="2" style="text-align: right;"><?= 'Rp. '.number_format($gaji->thr, 0, ",", "."); ?></th>
                                  </tr>
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th scope="row">Total Pendapatan</th>
                                  <th colspan="2" style="text-align: right;"><?= 'Rp. '.number_format($rekap['ttpendapatan'], 0, ",", "."); ?></th>
                                </tr>
                              </tfoot> 
                            </table>
                          </div>
                        </div>
                      </div><br>
                      <div class="card">
                        <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Detail Potongan</h6>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-bordered">
                              <tbody>
                                  <tr>
                                    <th scope="row">Cicilan Pinjaman</th>
                                    <th colspan="2" style="text-align: right;"><?= 'Rp. '.number_format($gaji->cicilan_pinjaman, 0, ",", "."); ?></th>
                                  </tr>
                                  <tr>
                                    <th scope="row">Jamsostek</th>
                                    <th colspan="2" style="text-align: right;"><?= 'Rp. '.number_format($gaji->jamsostek, 0, ",", "."); ?></th>
                                  </tr>
                                  <tr>
                                    <th scope="row">Potongan Telat</th>
                                    <th colspan="2" style="text-align: right;"><?= 'Rp. '.number_format($gaji->pt_telat, 0, ",", "."); ?></th>
                                  </tr>
                                  <tr>
                                    <th scope="row">Potongan Absen</th>
                                    <th colspan="2" style="text-align: right;"><?= 'Rp. '.number_format($gaji->pt_absen, 0, ",", "."); ?></th>
                                  </tr>
                                  <tr>
                                    <th scope="row">PPH21</th>
                                    <th colspan="2" style="text-align: right;"><?= 'Rp. '.number_format($gaji->pph21, 0, ",", "."); ?></th>
                                  </tr>
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th scope="row">Total Potongan</th>
                                  <th colspan="2" style="text-align: right;"><?= 'Rp. '.number_format($rekap['ttpotongan'], 0, ",", "."); ?></th>
                                </tr>
                              </tfoot> 
                            </table>
                          </div>
                        </div>
                      </div><br>
                    </div>
                    
                  </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
              <!-- Illustrations -->
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Rekapetulasi</h6>
                  </div>
                  <div class="card-body">
                    <div>
                      <p><strong>Periode <?= array_search($gaji->bulan,$bulans).' tahun '.$gaji->tahun; ?></strong></p>
                      <div class="table-responsive">
                            <table class="table table-bordered">
                              <tbody>
                                  <tr>
                                    <th scope="row">Total Pendapatan</th>
                                    <th colspan="2" style="text-align: right;"><?= 'Rp. '.number_format($rekap['ttpendapatan'], 0, ",", "."); ?></th>
                                  </tr>
                                  <tr>
                                    <th scope="row">Total Potongan</th>
                                    <th colspan="2" style="text-align: right;"><?= 'Rp. '.number_format($rekap['ttpotongan'], 0, ",", "."); ?></th>
                                  </tr>
                              </tbody>
                              <tfoot>
                                <tr>
                                  <th scope="row">Jumlah Gaji Diterima</th>
                                  <th colspan="2" style="text-align: right;"><?= 'Rp. '.number_format($rekap['jumlahgaji'], 0, ",", "."); ?></th>
                                </tr>
                              </tfoot> 
                            </table>
                          </div>
                    </div>
                    
                  </div>
                </div>
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Instructions</h6>
                  </div>
                  <div class="card-body">
                    <div>
                      <a href="<?= base_url("gaji/dosencetak/").$gaji->id_gaji;?>" class="btn btn-warning btn-icon-split" >
                        <span class="icon text-white-50">
                            <i class="fas fa-print"></i>
                        </span>
                        <span class="text">Cetak Slip Gaji</span>
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