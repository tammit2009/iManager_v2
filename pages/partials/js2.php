
<!-- Notification Scripts -->

<script>
$(document).ready(function(){ 

    // Delete pagr
    $('#listPagrs').delegate('.delete_pagr', 'click', function(e) {
        var pagrId = $(this).attr("did");
        deletePagr(pagrId);
    })

    window.start_load = function(){
	    $('body').prepend('<div id="preloader2"></div>')
	}
	  
    window.end_load = function(){
	    $('#preloader2').fadeOut('fast', function() {
	        $(this).remove();
	    })
    }

    window.start_load2 = function(){
	    var loader = document.createElement('div');
        loader.className = 'loader';
        document.body.appendChild(loader);
	}
	  
    window.end_load2 = function(){
	    loader.remove();
    }

	window.uni_modal = function(title ='' , url='', size="") {
		const fqUrl = window.location.origin + '/imanager/pages/' + url;

		// start_load()
		
		$.ajax({
			url: fqUrl,
			error:err=>{
				console.log(err);
				alert("An error occured")
			},
			success:function(response){
				if(response){

					$('#uni_modal .modal-title').html(title);
					$('#uni_modal .modal-body').html(response);

					if(size != ''){
						$('#uni_modal .modal-dialog').addClass(size);
					}else{
						$('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md");
					}

					$('#uni_modal').modal({
						show:true,
						backdrop:'static',
						keyboard:false,
						focus:true
					});

					//end_load();
				}
			}
		})
	}

	/*** Notifications ***/ 
	
	// Status Messages
	<?php if (isset($_SESSION['status'])): ?>
        // swal
        createAutoClosingAlert("#alert-msg", "<?php echo flash('msg'); ?>", "<?php echo flash('status'); ?>", 4000);
        // toastr (if required instead)
        // toastr.success("</?php echo flash('status'); ?>");
    <?php endif; ?>

	window.doConfirm = function($msg='', $func='', $params = []) {
        $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")");
	    $('#confirm_modal .modal-body').html($msg)
	    $('#confirm_modal').modal('show')
    }

    window.alert_toast= function($msg = 'TEST', $bg = 'success', $pos='') {
	   	 var Toast = Swal.mixin({
	      toast: true,
	      position: $pos || 'top-end',
	      showConfirmButton: false,
	      timer: 5000
	    });
	      
        Toast.fire({
	        icon: $bg,
	        title: $msg
	    })
	}

	// predefined icons: "warning", "error", "success", "info"
	// example: swalert_notify(rsp, 'success', 'success')
    window.swalert_notify= function($title = 'test', $text = 'success', $icon='success') {
		Swal.fire({
			title: $title,
			text: $text,
			icon: $icon,
		});
	};

	// example: swalert_prompt('test', 'success', 'success', 'Aww yiss!');
    window.swalert_prompt= function($title = 'test', $text = 'success', $icon='success', $confirmButton = 'button') {
		Swal.fire({
			title: $title,
			text: $text,
			icon: $icon,
			confirmButtonText:  $confirmButton
		}).then((result) => {
			if (result.isConfirmed)
				swal.fire("Done!", "It was succesfully deleted!", "success");
			else
				swal.fire("Error!", "Coudn't delete!", "error");
		});
	};
});

</script>

<script>
	// Toastr
	toastr.options = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": false,
		"progressBar": false,
		"positionClass": "toast-bottom-right",
		"preventDuplicates": true,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	};

</script>

<script>

	// Functions to manipulate traditional Bootstrap Alert

	function createAutoClosingAlert(selector, msg, msgtype, delay) {
        createAlert(selector, msg, msgtype);
        window.setTimeout(function() { removeAlert(selector); }, delay);
    }

    function createAlert(selector, msg, msgtype) {
		var icon = "";

        $(selector).addClass("alert alert-dismissible fade show");
        switch (msgtype) {
            case 'success':
                $(selector).addClass("alert-success");
				icon = "fa-check-circle";
                break;
            case 'error': 
                $(selector).addClass("alert-danger");
				icon = "fa-times-circle";
                break;
            case 'warning':
                $(selector).addClass("alert-warning");
				icon = "fa-exclamation-circle";
                break;
            case 'info':
                $(selector).addClass("alert-info");
				icon = "fa-info-circle";
                break;
            default:
                $(selector).addClass("alert-info");
				icon = "fa-info-circle";
                break;
        }

		var alert = `<i class="fa ${icon} mr-2"></i>${msg}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>`;
        
        $(selector).attr("role", "alert");
        $(selector).html(alert);
    }

    function removeAlert(selector) {
        $(selector).removeClass();
        $(selector).removeAttr("role");
        $(selector).html('');
    }
</script>