<!-- Modal -->
<div class="modal fade" id="pengajuanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<form id="tambahpengajuan" enctype="multipart/form-data" action="/tambahpengajuan" method="post" role="form" >
      {{ csrf_field() }}

        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">AjukanPengadaan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
                  <div class="form-group">
                    <label>Nama Pengadaan</label>
                    <input type="text" name="nama_pengadaan" class="form-control nama_pengadaan" id="nama_pengadaan" class="nama_pengadaan" placeholder="Masukan Nama Pengadaan" disabled>
                  </div>
                  <div class="form-group">
                    <label>Anggaran : <input type="" name="" class="labelRp" disabled style="border:none; background-color: white; color: black;"></label>
                    <input type="text" name="anggaran" class="form-control anggaran" id="anggaran" placeholder="Masukan Anggaran" onkeyup="curency()">
                   </div>
                  <div class="form-group">
                    <label>Proposal</label>
                    <input type="file" name="proposal" class="form-control proposal" id="proposal" accept="application/pdf">
                  </div>

                  <input type="hidden" name="id_pengadaan" id="id_pengadaan"  class="id_pengadaan">

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
