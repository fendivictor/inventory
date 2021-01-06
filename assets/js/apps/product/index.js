$(() => {
	let btnAdd = $("#add_new");
	let dtTable = $("#dt-table");
	let modalForm = $("#modal-form");
	let form = $("#form-data");

	let tbData = dtTable.DataTable({
		processing: true,
		serverSide: false,
		ajax: {
			url: `${baseUrl}ajax/Datatable/dt_products`
		},
		columnDefs: [
			{targets: 0, data: 'no'},
			{targets: 1, data: 'nama'},
			{targets: 2, data: 'foto'},
			{targets: 3, data: 'harga', className: 'text-right'},
			{targets: 4, data: 'stok', className: 'text-right'},
			{targets: 5, data: 'deskripsi'},
			{targets: 6, data: 'insert_at'},
			{targets: 7, data: 'user_insert'},
			{targets: 8, data: 'update_at'},
			{targets: 9, data: 'user_update'},
			{targets: 10, data: 'tools'}
		]
	})

	btnAdd.click(function() {
		modalForm.modal('show');
		form.trigger('reset');
		$("#id").val('');
		$("#img-edit").html('');
	});

	form.submit(function(e) {
		e.preventDefault();
		let formData = new FormData($(this)[0]);
		let config = {
			url: `${baseUrl}ajax/Ajax/add_products`,
			dataType: 'json',
			data: formData,
			type: 'post',
			contentType: false,
			processData: false
		}

		blockUI();

		$.ajax(config)
			.done(function(data) {
				unBlockUI();
				(data.status === 1) ? toastr.success(data.message) : Swal.fire('', 'error', data.message);

				modalForm.modal('hide');
				tbData.ajax.reload(null, false);
			})
			.fail(function(err) {
				toastr.error('Terjadi kesalahan saat menyimpan data');
				unBlockUI();
			});

		return false;
	});

	$(document).on('click', '.btn-edit', function() {
		let id = $(this).data('id');

		blockUI();

		$.get(`${baseUrl}ajax/Ajax/product_id?id=${id}`)
			.done(function(data) {
				unBlockUI();
				modalForm.modal('show');

				form.trigger('reset');
				$("#img-edit").html('');
				$("#id").val(data.id);
				$("#nama").val(data.nama);
				$("#harga").val(data.harga);
				$("#stok").val(data.stok);
				$("#deskripsi").val(data.deskripsi);
				$("#img-edit").append(`<img src="${baseUrl}assets/uploads/product/${data.foto}" width="200" class="img-thumbnail img-product" >`);
			})
			.fail(function(err) {
				unBlockUI();
				toastr.error('Terjadi kesalahan saat memuat data');
			});
	});

	$(document).on('click', '.btn-delete', function() {
		let id = $(this).data('id');

		swalWithBootstrapButtons.fire(defaultDeleteConfirmation)
			.then((result) => {
			  	if (result.value) {
			  		blockUI();

			  		$.post(`${baseUrl}ajax/Ajax/delete_product`, {id: id})
			  			.done(function(data) {
			  				unBlockUI();
							(data.status == 1) ? toastr.success(data.message) : toastr.error(data.message);

							tbData.ajax.reload(null, false);
			  			})
			  			.fail(function(err) {
			  				unBlockUI();
		  					toastr.error(msg.fail.delete);
			  			});
			  	}
			});
	});
});