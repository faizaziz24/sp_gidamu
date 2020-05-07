
$(document).ready(function(){
	
	var editUserForm = $("#editolduser");
	
	var validator = editUserForm.validate({
		
		rules:{
			fname :{ required : true },
			email : { required : true, email : true },
			cpassword : {equalTo: "#password"},
			mobile : { required : true, digits : true },
			role : { required : true, selected : true}
		},
		messages:{
			fname :{ required : "Bagian ini  harus diisi" },
			email : { required : "Bagian ini harus diisi", email : "Silahkan masukkan email yang valid" },
			cpassword : { equalTo: "Silahkan masukkan password yang sama" },
			phone : { required : "Bagian ini harus diisi", digits : "Silahkan masukkan angka saja" },
			role : { required : "Bagian ini harus diisi", selected : "Silahkan memilih satu opsi" }
		}
	});

	var editPatientForm = $("#editoldpatient");
	
	var validator = editPatientForm.validate({
		
		rules:{
			fname :{ required : true },
			address :{ required : true },			
			gender :{ required : true },
			datepicker:{required: true, date: true}
		},
		messages:{
			fname :{ required : "Bagian ini harus diisi" },
			address :{ required : "Bagian ini harus diisi" },
			gender : { required : "Bagian ini harus dipilih" },	
			datepicker : { required : "Masukkan tanggal sesuai dengan strukturnya", date: "Hanya terdiri atas angka"}		
		}
	});

	var editDiseaseForm = $("#editolddisease");
	
	var validator = editDiseaseForm.validate({
		
		rules:{
			dname :{ required : true },
			explain :{ required : true },			
			healing :{ required : true },
			preventing :{required: true }
		},
		messages:{
			dname :{ required : "Bagian ini harus diisi" },
			explain :{ required : "Bagian ini harus diisi" },
			healing : { required : "Bagian ini harus diisi" },	
			preventing : { required : "Bagian ini harus diisi" }		
		}
	});

	var editSymptomForm = $("#editoldsymptom");
	
	var validator = editSymptomForm.validate({
		
		rules:{
			sname :{ required : true },
			squest : { required : true},
			syes : { required : true, selected : true},
			sno : { required : true, selected : true},		
			sstart :{ required : true },		
			send :{ required : true }
		},
		messages:{
			sname :{ required : "Bagian ini  harus diisi" },
			squest : { required : "Bagian ini harus diisi" },
			syes : { required : "Bagian ini harus diisi", selected : "Silahkan memilih satu opsi" },
			sno : { required : "Bagian ini harus diisi", selected : "Silahkan memilih satu opsi" },
			sstart : { required : "Bagian ini harus dipilih" },
			send : { required : "Bagian ini harus dipilih" }		
		}
	});

	var editRuleForm = $("#editoldrule");
	
	var validator = editRuleForm.validate({
		
		rules:{
			drole : { required : true, selected : true},
			srole : { required : true, selected : true, remote : { url : baseURL + "checkSymptomExists", type :"post", data : { drole : function(){ return $("#drole").val();  } } } },
			cfvalue : { required : true}
		},
		messages:{
			drole : { required : "Bagian ini harus dipilih", selected : "Silahkan memilih satu opsi" },
			srole : { required : "Bagian ini harus dipilih", selected : "Silahkan memilih opsi", remote : "Gejala sudah digunakan"},
			cfvalue :{ required : "Bagian ini harus diisi" }	
		}
	});

	var editProfileForm = $("#editProfile");
	
	var validator = editProfileForm.validate({
		
		rules:{
			fname :{ required : true },
			mobile : { required : true, digits : true },
			password : { required : true },
			npassword : { required : true },
			cpassword : {required : true, equalTo: "#npassword"}
		},
		messages:{
			fname :{ required : "This field is required" },
			mobile : { required : "This field is required", digits : "Silahkan masukkan angka saja" },
			password :{ required : "Bagian ini harus diisi" },
			npassword :{ required : "Bagian ini harus diisi" },
			cpassword : { required : "Bagian ini harus diisi", equalTo: "Silahkan masukkan password yang sama" }
		}
	});

});