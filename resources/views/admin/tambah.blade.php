<div class="modal fade" id="modal-default">
      <form id="tambahPengadaan" enctype="multipart/form-data" action="/tambahpengadaan" method="post" role="form" >
      {{ csrf_field() }}
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Data Pengadaan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                  <div class="form-group">
                    <label>Nama Pengadaan</label>
                    <input type="text" name="nama_pengadaan" class="form-control" id="nama_pengadaan" placeholder="Masukan Nama Pengadaan">
                  </div>
                  <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control" id="gambar" accept="image/png, image/gif, image/jpeg">
                  </div>                  
                  <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" placeholder="Masukan Deskripsi"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Anggaran : <input type="" name="" class="labelRp" disabled style="border:none; background-color: white; color: black;"></label>
                    <input type="text" name="anggaran" class="form-control" id="anggaran" placeholder="Masukan Anggaran" onkeyup="curencyy()">
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