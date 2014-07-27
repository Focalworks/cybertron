/*This is where common javascript will go*/
$(document).ready(function() {
    /* handling the events for the new password text box */
    var newPasswordPass = false;
    handleNewPasswordEvents();

    handleConfPasswordEvents(newPasswordPass);
});

/*This function is handling the events for new password text box.*/
function handleNewPasswordEvents() {
    $('#warning-for-new-pass').hide();
    $('#success-for-new-pass').hide();
    $('#newPassword').focusout(
	    function() {
		var strNewPass = $(this).val();
		if (strNewPass != "") {
		    /* if the password is less than minimum chars */
		    if (strNewPass.length < 8) {
			$(this).closest('.form-group').addClass('has-warning')
				.addClass('has-feedback').removeClass(
					'has-success');
			$('#warning-for-new-pass').show();
			$('#success-for-new-pass').hide();
		    }
		    /* else we get success */
		    else {
			newPasswordPass = true;
			$(this).closest('.form-group').addClass('has-success')
				.addClass('has-feedback').removeClass(
					'has-warning');
			$('#success-for-new-pass').show();
			$('#warning-for-new-pass').hide();
		    }
		}
		/* if the text is empty then nothing to do */
		else {
		    $(this).closest('.form-group').removeClass('has-warning')
			    .removeClass('has-feedback').removeClass(
				    'has-success');
		    $('#warning-for-new-pass').hide();
		    $('#success-for-new-pass').hide();
		}
	    });
}

/*This function is handling the events for confirm password text box.*/
function handleConfPasswordEvents() {
    $('#warning-for-conf-pass').hide();
    $('#success-for-conf-pass').hide();
    $("#confPassword").focusout(
	    function() {
		var strConfPass = $(this).val();
		var strNewPass = $("#newPassword").val();
		if (strConfPass == "") {
		    $('#success-for-conf-pass').hide();
		    $('#warning-for-conf-pass').hide();
		    $(this).closest('.form-group').removeClass('has-warning')
		    .removeClass('has-feedback')
		    .removeClass('has-success');
		}
		else if (strConfPass != strNewPass) {
		    $(this).closest('.form-group').addClass('has-warning')
			    .addClass('has-feedback')
			    .removeClass('has-success');
		    $('#warning-for-conf-pass').show();
		    $('#success-for-conf-pass').hide();
		} else {
		    $(this).closest('.form-group').addClass('has-success')
			    .addClass('has-feedback')
			    .removeClass('has-warning');
		    $('#success-for-conf-pass').show();
		    $('#warning-for-conf-pass').hide();
		}
	    });
}