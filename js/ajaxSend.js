//tracking button clicks
$('#send').on('click', function(){
	//collecting data from a form
	var firstName = $('#firstName').val().trim();
	var middleName = $('#middleName').val().trim();
	var surname = $('#Surname').val().trim();
	var email = $('#email').val();
	var phone = $('#numberPhone').val();
	var message = $('#message').val().trim();
	var datatime = $('#datatime').val();
	//accessing the block with information about validation output
	var valid = $('#valid');
	//script validation
	if (surname == ''){
		valid.removeAttr('style');
		valid.prop('class','');
		valid.prop('className', 'alert alert-danger').text('Введите фамилию');
		return false;
	} else if (firstName == ''){
		valid.removeAttr('style');
		valid.prop('class','');
		valid.prop('className', 'alert alert-danger').text('Введите имя');
		return false;
	} else if (middleName == ''){
		valid.removeAttr('style');
		valid.prop('class','');
		valid.prop('className', 'alert alert-danger').text('Введите отчество');
		return false;
	} else if (phone == ''){
		valid.removeAttr('style');
		valid.prop('class','');
		valid.prop('className', 'alert alert-danger').text('Введите телефон');
		return false;
	} else if (email == ''){
		valid.removeAttr('style');
		valid.prop('class','');
		valid.prop('className', 'alert alert-danger').text('Введите почту');
		return false;	
	} else if (datatime == ''){
		valid.removeAttr('style');
		valid.prop('class','');
		valid.prop('className', 'alert alert-danger').text('Укажите дату показа');
		return false;
	} else if (message == ''){
		valid.removeAttr('style');
		valid.prop('class','');
		valid.prop('className', 'alert alert-danger').text('Введите сообщение');
		return false;
	}
	//ajax function
	$.ajax({
		url: 'action.php',
		type: 'POST',
		cache: false,
		data: {'firstName':firstName, 'middleName':middleName, 'surname':surname, 'email':email, 'phone':phone, 'message':message, 'datatime':datatime},
		dataType: 'html',
		beforeSend: function(){
			$('#send').prop("disabled", true);
		},
		success: function(data){
			valid.prop('class','');
			valid.prop('className', 'alert alert-success').text('Заявка успешно отправлена');
			valid.delay(2500).slideUp(300);
			$("form").trigger("reset");
			$('#send').prop("disabled", false);
		}
	});
});


