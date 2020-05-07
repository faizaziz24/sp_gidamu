
jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".delete-user", function(){
		var userCode = $(this).data("usercode"),
			hitURL = baseURL + "delete-user",
			currentRow = $(this);
		
		var confirmation = confirm("Apakah Anda setuju untuk menghapus pengguna ini ?");
		
		if(confirmation)
		{
			jQuery.ajax({
				type : "POST",
				dataType : "json",
				url : hitURL,
				data : { userCode : userCode } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status == true) { alert("Data pengguna berhasil dihapus."); }
				else if(data.status == false) { alert("Data pengguna masih digunakan."); }
				else { alert("Akses ditolak ..!"); }
			});
		}
	});

	jQuery(document).on("click", ".delete-disease", function(){
		var diseaseCode = $(this).data("diseasecode"),
			hitURL = baseURL + "delete-disease",
			currentRow = $(this);
		
		var confirmation = confirm("Apakah Anda setuju untuk menghapus penyakit ini ?");
		
		if(confirmation)
		{
			jQuery.ajax({
				type : "POST",
				dataType : "json",
				url : hitURL,
				data : { diseaseCode : diseaseCode } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status == true) { alert("Data penyakit berhasil dihapus."); }
				else if(data.status == false) { alert("Data penyakit masih digunakan."); }
				else { alert("Akses ditolak ..!"); }
			});
		}
	});

	jQuery(document).on("click", ".delete-symptom", function(){
		var symptomCode = $(this).data("symptomcode"),
			hitURL = baseURL + "delete-symptom",
			currentRow = $(this);
		
		var confirmation = confirm("Apakah Anda setuju untuk menghapus gejala ini ?");
		
		if(confirmation)
		{
			jQuery.ajax({
				type : "POST",
				dataType : "json",
				url : hitURL,
				data : { symptomCode : symptomCode } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status == true) { alert("Data gejala berhasil dihapus."); }
				else if(data.status == false) { alert("Data gejala masih digunakan."); }
				else { alert("Akses ditolak ..!"); }
			});
		}
	});

	jQuery(document).on("click", ".delete-rule", function(){
		var ruleCode = $(this).data("rulecode"),
			hitURL = baseURL + "delete-rule",
			currentRow = $(this);
		
		var confirmation = confirm("Apakah Anda setuju untuk menghapus aturan ini ?");
		
		if(confirmation)
		{
			jQuery.ajax({
				type : "POST",
				dataType : "json",
				url : hitURL,
				data : { ruleCode : ruleCode } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status == true) { alert("Data aturan berhasil dihapus"); }
				else if(data.status == false) { alert("Data aturan masih digunakan."); }
				else { alert("Akses ditolak ..!"); }
			});
		}
	});

	jQuery(document).on("click", ".delete-diagnosis", function(){
		var diagnosisCode = $(this).data("diagnosiscode"),
			hitURL = baseURL + "delete-diagnosis",
			currentRow = $(this);
		
		var confirmation = confirm("Apakah Anda setuju untuk menghapus hasil rekam medis ini ?");
		
		if(confirmation)
		{
			jQuery.ajax({
				type : "POST",
				dataType : "json",
				url : hitURL,
				data : { diagnosisCode : diagnosisCode } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status == true) { alert("Hasil rekam medis berhasil dihapus"); }
				else if(data.status == false) { alert("Hasil rekam medis gagal dihapus"); }
				else { alert("Akses ditolak ..!"); }
			});
		}
	});

});
