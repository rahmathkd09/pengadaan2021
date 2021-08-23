<div class="modal fade" id="modal-ubah">
      <form id="ubahPengadaan" enctype="multipart/form-data" action="/ubahPengadaan" method="post" role="form" >
      {{ csrf_field() }}
      <input type="hidden" name="id_pengadaan" id="id_pengadaan" class="id_pengadaan">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ubah Data Pengadaan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                    <label>Nama Pengadaan</label>
                    <input type="text" name="u_nama_pengadaan" class="form-control u_nama_pengadaan" id="u_nama_pengadaan" placeholder="Masukan Nama Pengadaan">
                  </div>
                  <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="u_deskripsi" id="u_deskripsi" class="form-control u_deskripsi" rows="3" placeholder="Masukan Deskripsi"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Anggaran : <input type="" name="" class="labelRp" disabled style="border:none; background-color: white; color: black;"></label>
                    <input type="text" name="u_anggaran" class="form-control u_anggaran" id="u_anggaran" placeholder="Masukan Anggaran" onkeyup="curencyy2()">
                   </div>
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->

        </form>
      </div>
      <!-- /.modal -->