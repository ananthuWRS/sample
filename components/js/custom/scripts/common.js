$(document).on("click", ".syncEmployeesList", function () {
	$(".syncEmployeesList").attr("data-kt-indicator", "on");
	$(".syncEmployeesList").attr("disabled", true);
	$.ajax({
		dataType: "html",
		type: "POST",
		url: base_url + "admin/synStaffData",	
		dataType : "json",		
		success: function (data) {
			if(data.status=='Yes'){
				swal.fire("Done", data.Message, "success");
			}else{
				swal.fire("Sorry", data.Message, "error");
			}
			$(".syncEmployeesList").removeAttr("data-kt-indicator");
			 $(".syncEmployeesList").attr("disabled", false);
			 table.ajax.reload();
		},
	});
});