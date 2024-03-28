jQuery(document).ready(function($) {
    $("#submit-btn").click(function (e) {
		var status = false;
    	/** Priority **/
		if ($('input[name=priority]:checked', '#marketing-form').val()) {
			status = true;
			document.getElementById('priority-error').innerHTML = '*';
		} else {
			status = false;
			document.getElementById('priority-error').innerHTML = '* Please select Priority';
		}

    	/** requestedby **/
    	if ($('#user_id').val()) {
			status = true;
			document.getElementById('requestedby-error').innerHTML = '*';    		
    	} else {
			status = false;
			document.getElementById('requestedby-error').innerHTML = '* Please select user';
		}

    	/** Duedate **/
    	if ($('#user_id').val()) {
			status = true;
			document.getElementById('duedate-error').innerHTML = '*';
    	} else {
			status = false;
			document.getElementById('duedate-error').innerHTML = '* Select Due Date';
		}

    	/** company **/
		 if ($('#counties').val()) {
		 	status = true;
		 	document.getElementById('company-error').innerHTML = '*';		 	
		 } else {
			status = false;
			document.getElementById('company-error').innerHTML = '* Please select any Company';
		}

    	/** newprojecttitle **/
		 if ($('#newprojecttitle').val()) {
		 	status = true;
		 	document.getElementById('title-error').innerHTML = '*';		 	
		 } else {
			status = false;
			document.getElementById('title-error').innerHTML = '* Please write Project title';
		}

    	/** newprojecttitle **/
		 if ($('#instructions').val()) {
		 	status = true;
		 	document.getElementById('instruction-error').innerHTML = '*';		 	
		 } else {
			status = false;
			document.getElementById('instruction-error').innerHTML = '* Please write down instructions';
		}

    	/** category **/
		 if ($('input[name=category]:checked', '#marketing-form').val()) {
		     status = true;
			 document.getElementById('category-error').innerHTML = '*';		 	
		 } else {
			status = false;
			document.getElementById('category-error').innerHTML = '* Please select related Category';
		}

		if (status) {
			$('#error-class').css('display','none');
			return true;
		} else {
			$('#error-class').css('display','block');
			e.preventDefault();
    		e.stopPropagation();
    		return false;
		}
    });
});