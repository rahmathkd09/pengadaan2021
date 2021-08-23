


<!-- Modal -->
<div class="modal fade" id="ubahPasswordAdm">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ganti Password Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="/ubahpasswordadm" method="post" role="form">
            {{csrf_field()}}

                <div class="form-group col-md-6">
              <label for="name">Password Lama</label>
              <input type="password" class="form-control" name="passwordlama" id="passwordlama" required>
            </div>

          <div class="form-group col-md-6">
            <label for="name">Password Baru</label>
            <input type="password" class="form-control" name="password" id="password" required>
          </div>

        </div>
        <div class="modal-footer ">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>
          </div>
            </div>
              </div>
                </div>
