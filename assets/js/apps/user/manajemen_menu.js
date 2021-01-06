$(document).ready(function(){
	var username;
	function loadMenu(user) {
		var config = {
			url: baseUrl + 'ajax/Menu/jstree?username=' + user,
			dataType: 'json'
		}

		blockUI();

		$.ajax(config)
		.done(function(data) {
			$('#jstree-menu').jstree("destroy");
			$("#jstree-menu").jstree({
                plugins: ["wholerow", "checkbox", "types"],
                core: {
                    themes: {
                        responsive: !1
                    },
                    data: data.menu
                },
                checkbox: {
			        cascade: 'undetermined',
			        visible: true,
			        three_state: false
			    },
                types: {
                    default: {
                        icon: "fa fa-folder icon-state-warning icon-lg"
                    },
                    file: {
                        icon: "fa fa-file icon-state-warning icon-lg"
                    }
                }
			});
			
			unBlockUI();
		})
		.fail(function(e) {
			toastr.error('Terjadi kesalahan saat memuat data');
			unBlockUI();
		});
	}

	var tbUser = $("#tb_user").DataTable({
		processing: true,
		ajax: {
			url: baseUrl + 'ajax/Menu/dt_user'
		}
	});

	$("#btn-cari").click(function() {
		$("#modal-sm").modal('show');
	});

	$(document).on('click', '.select-user', function() {
		username = $(this).data('username');

		$("#simpan-jstree").removeClass('d-none');
		$("#username").val(username);
		$("#modal-sm").modal('hide');

		loadMenu(username);
	});

	$("#simpan-jstree").click(function() {
		var arr = $("#jstree-menu").jstree('get_checked');
	    $("#jstree-menu").find(".jstree-undetermined").each(
	        function(i, element) {
	            arr.push( $(element).closest('.jstree-node').attr("id") );
	        }
	    );

	    var config = {
	    	url: baseUrl + 'ajax/Menu/simpan',
	    	dataType: 'json',
	    	data: {
	    		'menu': arr,
	    		'username': username
	    	}
	    }

	    blockUI();

	    $.ajax(config)
	    .done(function(data) {
	    	(data.status == 1) ? toastr.success(data.message) : Swal.fire('', data.message, 'error');

	    	unBlockUI();
	    })
	    .fail(function(e) {
	    	toastr.error('Terjadi kesalahan saat menyimpan data');

	    	unBlockUI();
	    });
	});
});