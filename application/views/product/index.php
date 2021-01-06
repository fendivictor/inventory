<div class="card card-primary card-outline">
	<div class="card-header">
		<h3 class="card-title"><?= $title; ?></h3>
	</div> <!-- /.card-body -->
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-success" id="add_new"><i class="fa fa-plus"></i> Tambah Data</button>
			</div>
			<div class="col-md-12" style="margin-top: 20px;">
				<div class="table-responsive">
					<table class="table table-hovered" id="dt-table">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama</th>
								<th>Foto</th>
								<th>Harga</th>
								<th>Stok</th>
								<th>Deskripsi</th>
								<th>Waktu Input</th>
								<th>User Input</th>
								<th>Waktu Update</th>
								<th>User Update</th>
								<th>
									<i class="fa fa-bars"></i>
								</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-form">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header">
				<h4 class="modal-title">Form <?= $title ?></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<form action="#" id="form-data">
				<div class="modal-body">
					<div class="form-group">
						<label for="">Nama <span class="text-danger">*</span></label>
						<input type="hidden" name="id" id="id">
						<input type="text" name="nama" id="nama" class="form-control" required="required">
					</div>

					<div class="form-group">
						<label for="">Foto <span class="text-danger">*</span></label>
						<input type="file" name="foto" id="foto" class="form-control" required="required" accept="image/x-png,image/gif,image/jpeg">
						<div id="img-edit"></div>
					</div>

					<div class="form-group">
						<label for="">Harga <span class="text-danger">*</span></label>
						<input type="number" name="harga" id="harga" class="form-control" required="required">
					</div>

					<div class="form-group">
						<label for="">Stok <span class="text-danger">*</span></label>
						<input type="number" name="stok" id="stok" class="form-control" required="required">
					</div>

					<div class="form-group">
						<label for="">Deskripsi </label>
						<textarea name="deskripsi" id="deskripsi" cols="10" rows="5" class="form-control"></textarea>
					</div>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Simpan</button>
	        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      		</div>
	      	</form>

		</div>
	</div>
</div>