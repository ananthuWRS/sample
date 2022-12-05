/**
 * Created by Binil on 10/2022.
 */

function taskCategory() {
	var save_method;
	var table;
	table = $("#kt_table_category").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		order: [],
		ajax: {
			url: base_url + "admin/ajaxtaskcategorylist",
			type: "POST",
			data: function (data) {
				data.search.value = $(".search-in-table").val();
			},
		},
		language: {
			emptyTable: "No category available....!",
			processing: "Loading category ",
		},
		columnDefs: [
			{
				targets: "no-sort",
				orderable: false,
			},
		],
	});

	$(document).on("click", "#btn-filter", function (event) {
		table.ajax.reload();
	});
	$(document).on("keyup", ".search-in-table", function (event) {
		table.ajax.reload();
	});

	$(document).on("click", "#btn-reset", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", "#btn-cancel", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", ".addTaskCategory", function () {
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "admin/addTaskCategory",
			data: {
				pagename: "addTaskCategory",
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".commonmodal").modal("show");
			},
		});
	});

	$(document).on("click", ".categoryEdit", function () {
		$editid = $(this).data("item");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "admin/categoryEdit",
			data: {
				pagename: "addTaskCategory",
				editid: $editid,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".commonmodal").modal("show");
			},
		});
	});

	$(document).on("click", "#kt_add_category_submit", function () {
		$("#kt_add_category_submit").attr("data-kt-indicator", "on");
		$("#kt_add_category_submit").attr("disabled", true);
		$("#kt_modal_add_category_form").parsley().validate();
		if ($("#kt_modal_add_category_form").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "admin/categorySubmitProcess",
				data: $("#kt_modal_add_category_form").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_add_category_submit").removeAttr("data-kt-indicator");
						$("#kt_add_category_submit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_add_category_submit").removeAttr("data-kt-indicator");
			$("#kt_add_category_submit").attr("disabled", false);
		}
	});

	$(document).on("click", ".deleteCategory", function () {
		var itemid = $(this).data("itemid");

		swal
			.fire({
				title: "Are you sure?",
				text: "you wish to change this item status?",
				icon: "info",
				buttonsStyling: false,
				showCancelButton: true,
				confirmButtonText: "Ok",
				cancelButtonText: "No, cancel it",
				customClass: {
					confirmButton: "btn btn-primary",
					cancelButton: "btn btn-danger",
				},
			})
			.then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: base_url + "admin/deleteCategory/" + itemid,
						type: "POST",
						dataType: "text",
						success: function (retObj) {
							window.location.reload();
						},
					});
				}
			});
	});
}

function taskDepartments() {
	var save_method;
	var table;
	table = $("#kt_table_Departments").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		order: [],
		ajax: {
			url: base_url + "admin/ajaxdepartmentlist",
			type: "POST",
			data: function (data) {
				data.search.value = $(".search-in-table").val();
			},
		},
		language: {
			emptyTable: "No departments available....!",
			processing: "Loading departments ",
		},
		columnDefs: [
			{
				targets: "no-sort",
				orderable: false,
			},
		],
	});

	$(document).on("click", "#btn-filter", function (event) {
		table.ajax.reload();
	});
	$(document).on("keyup", ".search-in-table", function (event) {
		table.ajax.reload();
	});

	$(document).on("click", "#btn-reset", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", "#btn-cancel", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", ".addTaskDepartments", function () {
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "admin/addTaskDepartments",
			data: {
				pagename: "addTaskDepartments",
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".commonmodal").modal("show");
			},
		});
	});

	$(document).on("click", ".departmentEdit", function () {
		$editid = $(this).data("item");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "admin/departmentEdit",
			data: {
				pagename: "addTaskDepartments",
				editid: $editid,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".commonmodal").modal("show");
			},
		});
	});

	$(document).on("click", "#kt_add_category_submit", function () {
		$("#kt_add_category_submit").attr("data-kt-indicator", "on");
		$("#kt_add_category_submit").attr("disabled", true);
		$("#kt_modal_add_category_form").parsley().validate();
		if ($("#kt_modal_add_category_form").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "admin/departmentSubmitProcess",
				data: $("#kt_modal_add_category_form").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_add_category_submit").removeAttr("data-kt-indicator");
						$("#kt_add_category_submit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_add_category_submit").removeAttr("data-kt-indicator");
			$("#kt_add_category_submit").attr("disabled", false);
		}
	});

	$(document).on("click", ".deleteDepartment", function () {
		var itemid = $(this).data("itemid");

		swal
			.fire({
				title: "Are you sure?",
				text: "you wish to change this item status?",
				icon: "info",
				buttonsStyling: false,
				showCancelButton: true,
				confirmButtonText: "Ok",
				cancelButtonText: "No, cancel it",
				customClass: {
					confirmButton: "btn btn-primary",
					cancelButton: "btn btn-danger",
				},
			})
			.then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: base_url + "admin/deleteDepartment/" + itemid,
						type: "POST",
						dataType: "text",
						success: function (retObj) {
							window.location.reload();
						},
					});
				}
			});
	});
}
function taskCampus() {
	var save_method;
	var table;
	table = $("#kt_table_Campus").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		order: [],
		ajax: {
			url: base_url + "admin/ajaxcampuslist",
			type: "POST",
			data: function (data) {
				data.search.value = $(".search-in-table").val();
			},
		},
		language: {
			emptyTable: "No school available....!",
			processing: "Loading school ",
		},
		columnDefs: [
			{
				targets: "no-sort",
				orderable: false,
			},
		],
	});

	$(document).on("click", "#btn-filter", function (event) {
		table.ajax.reload();
	});
	$(document).on("keyup", ".search-in-table", function (event) {
		table.ajax.reload();
	});

	$(document).on("click", "#btn-reset", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", "#btn-cancel", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", ".addTaskCampus", function () {
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "admin/addTaskCampus",
			data: {
				pagename: "addTaskCampus",
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".commonmodal").modal("show");
			},
		});
	});

	$(document).on("click", ".campusEdit", function () {
		$editid = $(this).data("item");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "admin/campusEdit",
			data: {
				pagename: "addTaskCampus",
				editid: $editid,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".commonmodal").modal("show");
			},
		});
	});

	$(document).on("click", "#kt_add_category_submit", function () {
		$("#kt_add_category_submit").attr("data-kt-indicator", "on");
		$("#kt_add_category_submit").attr("disabled", true);
		$("#kt_modal_add_category_form").parsley().validate();
		if ($("#kt_modal_add_category_form").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "admin/campusSubmitProcess",
				data: $("#kt_modal_add_category_form").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_add_category_submit").removeAttr("data-kt-indicator");
						$("#kt_add_category_submit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_add_category_submit").removeAttr("data-kt-indicator");
			$("#kt_add_category_submit").attr("disabled", false);
		}
	});

	$(document).on("click", ".deleteCampus", function () {
		var itemid = $(this).data("itemid");

		swal
			.fire({
				title: "Are you sure?",
				text: "you wish to change this item status?",
				icon: "info",
				buttonsStyling: false,
				showCancelButton: true,
				confirmButtonText: "Ok",
				cancelButtonText: "No, cancel it",
				customClass: {
					confirmButton: "btn btn-primary",
					cancelButton: "btn btn-danger",
				},
			})
			.then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: base_url + "admin/deleteCampus/" + itemid,
						type: "POST",
						dataType: "text",
						success: function (retObj) {
							window.location.reload();
						},
					});
				}
			});
	});
}

function taskProgram() {
	var save_method;
	var table;
	table = $("#kt_table_Program").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		order: [],
		ajax: {
			url: base_url + "admin/ajaxprogramlist",
			type: "POST",
			data: function (data) {
				data.search.value = $(".search-in-table").val();
			},
		},
		language: {
			emptyTable: "No program available....!",
			processing: "Loading program ",
		},
		columnDefs: [
			{
				targets: "no-sort",
				orderable: false,
			},
		],
	});

	$(document).on("click", "#btn-filter", function (event) {
		table.ajax.reload();
	});
	$(document).on("keyup", ".search-in-table", function (event) {
		table.ajax.reload();
	});

	$(document).on("click", "#btn-reset", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", "#btn-cancel", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", ".addTaskProgram", function () {
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "admin/addTaskProgram",
			data: {
				pagename: "addTaskProgram",
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".commonmodal").modal("show");
			},
		});
	});

	$(document).on("click", ".programEdit", function () {
		$editid = $(this).data("item");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "admin/programEdit",
			data: {
				pagename: "addTaskProgram",
				editid: $editid,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".commonmodal").modal("show");
			},
		});
	});

	$(document).on("click", "#kt_add_category_submit", function () {
		$("#kt_add_category_submit").attr("data-kt-indicator", "on");
		$("#kt_add_category_submit").attr("disabled", true);
		$("#kt_modal_add_category_form").parsley().validate();
		if ($("#kt_modal_add_category_form").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "admin/programSubmitProcess",
				data: $("#kt_modal_add_category_form").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_add_category_submit").removeAttr("data-kt-indicator");
						$("#kt_add_category_submit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_add_category_submit").removeAttr("data-kt-indicator");
			$("#kt_add_category_submit").attr("disabled", false);
		}
	});

	$(document).on("click", ".deleteProgram", function () {
		var itemid = $(this).data("itemid");

		swal
			.fire({
				title: "Are you sure?",
				text: "you wish to change this item status?",
				icon: "info",
				buttonsStyling: false,
				showCancelButton: true,
				confirmButtonText: "Ok",
				cancelButtonText: "No, cancel it",
				customClass: {
					confirmButton: "btn btn-primary",
					cancelButton: "btn btn-danger",
				},
			})
			.then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: base_url + "admin/deleteProgram/" + itemid,
						type: "POST",
						dataType: "text",
						success: function (retObj) {
							window.location.reload();
						},
					});
				}
			});
	});
}

function taskSubcategory() {
	var save_method;
	var table;
	table = $("#kt_table_category").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		order: [],
		ajax: {
			url: base_url + "admin/ajaxtasksubcategorylist",
			type: "POST",
			data: function (data) {
				data.search.value = $(".search-in-table").val();
			},
		},
		language: {
			emptyTable: "No sub category available....!",
			processing: "Loading sub category ",
		},
		columnDefs: [
			{
				targets: "no-sort",
				orderable: false,
			},
		],
	});

	$(document).on("click", "#btn-filter", function (event) {
		table.ajax.reload();
	});
	$(document).on("keyup", ".search-in-table", function (event) {
		table.ajax.reload();
	});

	$(document).on("click", "#btn-reset", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", "#btn-cancel", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", ".addTaskSubCategory", function () {
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "admin/addTaskSubCategory",
			data: {
				pagename: "addTaskSubCategory",
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".form-select").select2();
				$(".commonmodal").modal("show");
			},
		});
	});

	$(document).on("click", ".subCategoryEdit", function () {
		$editid = $(this).data("item");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "admin/subCategoryEdit",
			data: {
				pagename: "addTaskSubCategory",
				editid: $editid,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".form-select").select2();
				$(".commonmodal").modal("show");
			},
		});
	});

	$(document).on("click", "#kt_add_category_submit", function () {
		$("#kt_add_category_submit").attr("data-kt-indicator", "on");
		$("#kt_add_category_submit").attr("disabled", true);
		$("#kt_modal_add_category_form").parsley().validate();
		if ($("#kt_modal_add_category_form").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "admin/subCategorySubmitProcess",
				data: $("#kt_modal_add_category_form").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_add_category_submit").removeAttr("data-kt-indicator");
						$("#kt_add_category_submit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_add_category_submit").removeAttr("data-kt-indicator");
			$("#kt_add_category_submit").attr("disabled", false);
		}
	});

	$(document).on("click", ".deleteSubCategory", function () {
		var itemid = $(this).data("itemid");

		swal
			.fire({
				title: "Are you sure?",
				text: "you wish to change this item status?",
				icon: "info",
				buttonsStyling: false,
				showCancelButton: true,
				confirmButtonText: "Ok",
				cancelButtonText: "No, cancel it",
				customClass: {
					confirmButton: "btn btn-primary",
					cancelButton: "btn btn-danger",
				},
			})
			.then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: base_url + "admin/deleteSubCategory/" + itemid,
						type: "POST",
						dataType: "text",
						success: function (retObj) {
							window.location.reload();
						},
					});
				}
			});
	});
}

function profilesettings() {
	// Define form element
	const form = document.getElementById("kt_account_profile_details_form");
	// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
	var validator = FormValidation.formValidation(form, {
		fields: {
			fname: {
				validators: {
					notEmpty: {
						message: "First name is required",
					},
				},
			},
			email: {
				validators: {
					notEmpty: {
						message: "Email is required",
					},
					emailAddress: {
						message: "The value is not a valid email address",
					},
				},
			},
			phone: {
				validators: {
					phone: {
						country: "IN",
						message: "The value is not a valid phone number",
					},
				},
			},
		},

		plugins: {
			trigger: new FormValidation.plugins.Trigger(),
			bootstrap: new FormValidation.plugins.Bootstrap5({
				rowSelector: ".fv-row",
				eleInvalidClass: "",
				eleValidClass: "",
			}),
		},
	});

	// Submit button handler
	const submitButton = document.getElementById(
		"kt_account_profile_details_submit"
	);
	submitButton.addEventListener("click", function (e) {
		// Prevent default button action
		e.preventDefault();

		// Validate form before submit
		if (validator) {
			validator.validate().then(function (status) {
				if (status == "Valid") {
					// Show loading indication
					submitButton.setAttribute("data-kt-indicator", "on");

					// Disable button to avoid multiple click
					submitButton.disabled = true;

					$.ajax({
						type: "POST",
						enctype: "multipart/form-data",
						url: base_url + "welcome/updateprofile",
						data: $("#kt_account_profile_details_form").serialize(),
						cache: false,
						dataType: "json",
						success: function (data) {
							if (data) {
								var e = data;
								if (e.status == "Yes") {
									window.location.reload();
								} else {
									submitButton.removeAttribute("data-kt-indicator");
									submitButton.disabled = false;
									swal.fire("Sorry", e.Message, "error");
								}
							}
						},
					});
				} else {
					submitButton.removeAttribute("data-kt-indicator");
					submitButton.disabled = false;
				}
			});
		}
	});

	$(document).on(
		"click",
		"#kt_signin_password_button,#kt_password_cancel",
		function () {
			$("#kt_signin_password_edit").toggleClass("d-none");
			$("#kt_signin_password,#kt_signin_password_button").toggle();
		}
	);

	// Define form element
	const formpassword = document.getElementById("kt_signin_change_password");
	// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
	var validatorpassword = FormValidation.formValidation(formpassword, {
		fields: {
			currentpassword: {
				validators: { notEmpty: { message: "Current Password is required" } },
			},
			newpassword: {
				validators: { notEmpty: { message: "New Password is required" } },
			},
			confirmpassword: {
				validators: {
					notEmpty: { message: "Confirm Password is required" },
					identical: {
						compare: function () {
							return n.querySelector('[name="newpassword"]').value;
						},
						message: "The password and its confirm are not the same",
					},
				},
			},
		},

		plugins: {
			trigger: new FormValidation.plugins.Trigger(),
			bootstrap: new FormValidation.plugins.Bootstrap5({
				rowSelector: ".fv-row",
				eleInvalidClass: "",
				eleValidClass: "",
			}),
		},
	});

	// Submit button handler
	const submitButtonPassword = document.getElementById("kt_password_submit");
	submitButtonPassword.addEventListener("click", function (e) {
		// Prevent default button action
		e.preventDefault();

		// Validate form before submit
		if (validatorpassword) {
			validatorpassword.validate().then(function (status) {
				if (status == "Valid") {
					// Show loading indication
					submitButtonPassword.setAttribute("data-kt-indicator", "on");

					// Disable button to avoid multiple click
					submitButtonPassword.disabled = true;

					$.ajax({
						type: "POST",
						enctype: "multipart/form-data",
						url: base_url + "welcome/changepasswordprocess",
						data: $("#kt_signin_change_password").serialize(),
						cache: false,
						dataType: "json",
						success: function (data) {
							if (data) {
								var e = data;
								if (e.status == "Yes") {
									window.location.reload();
								} else {
									submitButtonPassword.removeAttribute("data-kt-indicator");
									submitButtonPassword.disabled = false;
									swal.fire("Sorry", e.Message, "error");
								}
							}
						},
					});
				} else {
					submitButtonPassword.removeAttribute("data-kt-indicator");
					submitButtonPassword.disabled = false;
				}
			});
		}
	});
}

function userList() {
	var save_method;
	var table;
	table = $("#kt_table_users").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		order: [],
		ajax: {
			url: base_url + "admin/ajaxstafflist",
			type: "POST",
			data: function (data) {
				data.search.value = $(".search-in-table").val();
			},
		},
		language: {
			emptyTable: "No staff available....!",
			processing: "Loading staff ",
		},
		columnDefs: [
			{
				targets: "no-sort",
				orderable: false,
			},
		],
	});

	$(document).on("click", "#btn-filter", function (event) {
		table.ajax.reload();
	});
	$(document).on("keyup", ".search-in-table", function (event) {
		table.ajax.reload();
	});

	$(document).on("click", "#btn-reset", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", "#btn-cancel", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});

	$(document).on("click", ".assignReportingPerson", function () {
		$editid = $(this).data("item");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "admin/assignReportingPerson",
			data: {
				pagename: "assignReportingPerson",
				editid: $editid,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".form-select").select2();
				$(".commonmodal").modal("show");
			},
		});
	});

	$(document).on("click", ".viewReportingPerson", function () {
		$editid = $(this).data("item");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "admin/viewReportingPerson",
			data: {
				pagename: "viewReportingPerson",
				editid: $editid,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".form-select").select2();
				$(".commonmodal").modal("show");
			},
		});
	});

	$(document).on("click", "#kt_add_category_submit", function () {
		$("#kt_add_category_submit").attr("data-kt-indicator", "on");
		$("#kt_add_category_submit").attr("disabled", true);
		$("#kt_modal_add_category_form").parsley().validate();
		if ($("#kt_modal_add_category_form").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "admin/reportingPersonSubmitProcess",
				data: $("#kt_modal_add_category_form").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_add_category_submit").removeAttr("data-kt-indicator");
						$("#kt_add_category_submit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_add_category_submit").removeAttr("data-kt-indicator");
			$("#kt_add_category_submit").attr("disabled", false);
		}
	});

	$(document).on("click", ".deleteReportingPerson", function () {
		var itemid = $(this).data("itemid");

		swal
			.fire({
				title: "Are you sure?",
				text: "you wish to change this item status?",
				icon: "info",
				buttonsStyling: false,
				showCancelButton: true,
				confirmButtonText: "Ok",
				cancelButtonText: "No, cancel it",
				customClass: {
					confirmButton: "btn btn-primary",
					cancelButton: "btn btn-danger",
				},
			})
			.then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: base_url + "admin/deleteReportingPerson/" + itemid,
						type: "POST",
						dataType: "text",
						success: function (retObj) {
							window.location.reload();
						},
					});
				}
			});
	});
}

function reportingStaffList() {
	var save_method;
	var table;
	table = $("#kt_table_users").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		order: [],
		ajax: {
			url: base_url + "admin/ajaxreportingstafflist",
			type: "POST",
			data: function (data) {
				data.search.value = $(".search-in-table").val();
			},
		},
		language: {
			emptyTable: "No staff available....!",
			processing: "Loading staff ",
		},
		columnDefs: [
			{
				targets: "no-sort",
				orderable: false,
			},
		],
	});

	$(document).on("click", "#btn-filter", function (event) {
		table.ajax.reload();
	});
	$(document).on("keyup", ".search-in-table", function (event) {
		table.ajax.reload();
	});

	$(document).on("click", "#btn-reset", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", "#btn-cancel", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});

	$(document).on("click", ".viewAssignedStaffs", function () {
		$id = $(this).data("id");
		$auth = $(this).data("auth");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "admin/viewAssignedStaffs",
			data: {
				pagename: "viewAssignedStaffs",
				auth: $auth,
				id: $id,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);

				$(".commonmodal").modal("show");
			},
		});
	});
}

function stafftasks() {
	var save_method;
	var table;
	table = $("#kt_table_users").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		order: [],
		ajax: {
			url: base_url + "staff/ajaxstafftaskslist",
			type: "POST",
			data: function (data) {
				data.search.value = $(".search-in-table").val();
				data.tasktype = 1;
			},
		},
		language: {
			emptyTable: "No tasks available....!",
			processing: "Loading tasks ",
		},
		columnDefs: [
			{
				targets: "no-sort",
				orderable: false,
			},
		],
	});

	$(document).on("click", "#btn-filter", function (event) {
		table.ajax.reload();
	});
	$(document).on("keyup", ".search-in-table", function (event) {
		table.ajax.reload();
	});

	$(document).on("click", "#btn-reset", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", "#btn-cancel", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", ".updateTaskStatus", function () {
		$editid = $(this).data("item");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/updateTaskStatus",
			data: {
				pagename: "updateTaskStatus",
				editid: $editid,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".form-select").select2();
				$(".commonmodal").modal("show");
				$("#task_execution_date").flatpickr({
					// minDate: "today",
					dateFormat: "d-m-Y",
				});
			},
		});
	});
	$(document).on("click", "#kt_add_category_submit", function () {
		$("#kt_add_category_submit").attr("data-kt-indicator", "on");
		$("#kt_add_category_submit").attr("disabled", true);
		$("#kt_modal_add_category_form").parsley().validate();
		if ($("#kt_modal_add_category_form").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "staff/updateTaskStatusDetails",
				data: $("#kt_modal_add_category_form").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_add_category_submit").removeAttr("data-kt-indicator");
						$("#kt_add_category_submit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_add_category_submit").removeAttr("data-kt-indicator");
			$("#kt_add_category_submit").attr("disabled", false);
		}
	});

	$(document).on("click", ".deleteTaskDetails", function () {
		var itemid = $(this).data("itemid");

		swal
			.fire({
				title: "Are you sure?",
				text: "you wish to change this item status?",
				icon: "info",
				buttonsStyling: false,
				showCancelButton: true,
				confirmButtonText: "Ok",
				cancelButtonText: "No, cancel it",
				customClass: {
					confirmButton: "btn btn-primary",
					cancelButton: "btn btn-danger",
				},
			})
			.then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: base_url + "staff/deleteTaskDetails/" + itemid,
						type: "POST",
						dataType: "text",
						success: function (retObj) {
							window.location.reload();
						},
					});
				}
			});
	});
}
function finishedtasks() {
	var save_method;
	var table;
	table = $("#kt_table_users").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		order: [],
		ajax: {
			url: base_url + "staff/ajaxstafffinishedtaskslist",
			type: "POST",
			data: function (data) {
				data.search.value = $(".search-in-table").val();
				data.tasktype = 2;
			},
		},
		language: {
			emptyTable: "No tasks available....!",
			processing: "Loading tasks ",
		},
		columnDefs: [
			{
				targets: "no-sort",
				orderable: false,
			},
		],
	});

	$(document).on("click", "#btn-filter", function (event) {
		table.ajax.reload();
	});
	$(document).on("keyup", ".search-in-table", function (event) {
		table.ajax.reload();
	});

	$(document).on("click", "#btn-reset", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", "#btn-cancel", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", ".updateTaskStatus", function () {
		$editid = $(this).data("item");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/updateTaskStatus",
			data: {
				pagename: "updateTaskStatus",
				editid: $editid,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".form-select").select2();
				$(".commonmodal").modal("show");
				$("#task_execution_date").flatpickr({
					// minDate: "today",
					dateFormat: "d-m-Y",
				});
			},
		});
	});
	$(document).on("click", "#kt_add_category_submit", function () {
		$("#kt_add_category_submit").attr("data-kt-indicator", "on");
		$("#kt_add_category_submit").attr("disabled", true);
		$("#kt_modal_add_category_form").parsley().validate();
		if ($("#kt_modal_add_category_form").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "staff/updateTaskStatusDetails",
				data: $("#kt_modal_add_category_form").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_add_category_submit").removeAttr("data-kt-indicator");
						$("#kt_add_category_submit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_add_category_submit").removeAttr("data-kt-indicator");
			$("#kt_add_category_submit").attr("disabled", false);
		}
	});

	$(document).on("click", ".deleteTaskDetails", function () {
		var itemid = $(this).data("itemid");

		swal
			.fire({
				title: "Are you sure?",
				text: "you wish to change this item status?",
				icon: "info",
				buttonsStyling: false,
				showCancelButton: true,
				confirmButtonText: "Ok",
				cancelButtonText: "No, cancel it",
				customClass: {
					confirmButton: "btn btn-primary",
					cancelButton: "btn btn-danger",
				},
			})
			.then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: base_url + "staff/deleteTaskDetails/" + itemid,
						type: "POST",
						dataType: "text",
						success: function (retObj) {
							window.location.reload();
						},
					});
				}
			});
	});
}
function staffaddtask() {
	let addStatusArray = [];
	$(document).on("change", "#category", function () {
		$("#subcategory").empty();
		$catid = $("#category option:selected").val();
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/getSubCategory",
			data: {
				catid: $catid,
			},
			success: function (data) {
				$("#subcategory").empty();
				$("#subcategory").append(data);
				$("#subcategory").select2();
			},
		});
	});

	

	$("#task_execution_date").flatpickr({
		// minDate: "today",
		dateFormat: "d-m-Y",
	});
	$("#task_date").flatpickr({
		// minDate: "today",
		dateFormat: "d-m-Y",
	});
	$("#task_end_date").flatpickr({
		// minDate: "today",
		dateFormat: "d-m-Y",
	});

	$(".addTaskExecutionDetails").hide();
	
	

	$("#kt_table_task_details").DataTable();

	$(document).on("click", ".addTaskStatus", function () {	
		var lastArray= addStatusArray[addStatusArray.length - 1];
		var startcount =1;
		
		if(addStatusArray.length>0){
			
			startcount=lastArray['status'];
		}
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/addTaskStatus",
			data: {
				pagename: "addTaskStatus",	
				startcount:startcount			
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_task_form").parsley();				
				$(".commonmodal").modal("show");
				$("#task_execution_date").flatpickr({					
					dateFormat: "d-m-Y",
				});
			},
		});
	});
	
	$(document).on("click", "#kt_add_task_submit", function () {
		$("#kt_add_task_submit").attr("data-kt-indicator", "on");
		$("#kt_add_task_submit").attr("disabled", true);
		$("#kt_modal_add_task_form").parsley().validate();
		
			
			  
			 if ($("#kt_modal_add_task_form").parsley().isValid() ) {


				
			 //console.log
			 var statusItem = {};
			statusItem["status"] = $("#task_completion_status").val();
			statusItem["date"] = $("#task_execution_date").val();
			statusItem["hours"] = $("#task_time_spend_hours").val();
			statusItem["minutes"] = $("#task_time_spend_mins").val();
			statusItem["remarks"] = $("#task_remarks").val();
			addStatusArray.push(statusItem);

			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "staff/addTaskStatusDetails",
				data: {items:addStatusArray},
				cache: false,
				timeout: 600000,
				success: function (data) {
					
					if (data) {
						
						$(".statusDisplay").html(data);
						$(".commonmodal").modal("hide");
						$(".commonmodal").remove();
					} else {
						$("#kt_add_task_submit").removeAttr("data-kt-indicator");
						$("#kt_add_task_submit").attr("disabled", false);
						swal.fire("Sorry", 'Error occurred please try again ', "error");
					}
				},
			});
		} else {
			$("#kt_add_task_submit").removeAttr("data-kt-indicator");
			$("#kt_add_task_submit").attr("disabled", false);
		}
	});

	$(document).on("click", ".editAddTaskStatusDetails", function () {
		var editid = $(this).data("item");
		var editaddStatusArray = addStatusArray.filter(function(value, index){ 
			return editid === index;
		});
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/editAddTaskStatusDetails",
			data: {
				pagename: "editAddTaskStatusDetails",
				editid: editid,
				editdata:editaddStatusArray
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_task_form").parsley();				
				$(".commonmodal").modal("show");
				$("#task_execution_date").flatpickr({					
					dateFormat: "d-m-Y",
				});
			},
		});
	});

	$(document).on("click", "#kt_add_task_edit_submit", function () {
		$("#kt_add_task_edit_submit").attr("data-kt-indicator", "on");
		$("#kt_add_task_edit_submit").attr("disabled", true);
		$("#kt_modal_add_task_form").parsley().validate();
		if ($("#kt_modal_add_task_form").parsley().isValid()) {

			var editid=$(this).data('editid');


			var statusItem = {};
			statusItem["status"] = $(".task_completion_status").val();
			statusItem["date"] = $("#task_execution_date").val();
			statusItem["hours"] = $("#task_time_spend_hours").val();
			statusItem["minutes"] = $("#task_time_spend_mins").val();
			statusItem["remarks"] = $("#task_remarks").val();
			addStatusArray[editid]=statusItem;

			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "staff/addTaskStatusDetails",
				data: {items:addStatusArray},
				cache: false,
				timeout: 600000,
				success: function (data) {					
					if (data) {
						$(".statusDisplay").html(data);
						$(".commonmodal").modal("hide");
						$(".commonmodal").remove();
					} else {
						$("#kt_add_task_edit_submit").removeAttr("data-kt-indicator");
						$("#kt_add_task_edit_submit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_add_task_edit_submit").removeAttr("data-kt-indicator");
			$("#kt_add_task_edit_submit").attr("disabled", false);
		}
	});
	$(document).on("click", ".deleteAddTaskStatusDetails", function () {
		var editid = $(this).data("item");
		 addStatusArray = addStatusArray.filter(function(value, index){ 
			return editid != index;
		});

		
		$.ajax({
			type: "POST",
			enctype: "multipart/form-data",
			url: base_url + "staff/addTaskStatusDetails",
			data: {items:addStatusArray},
			cache: false,
			timeout: 600000,
			success: function (data) {	
					$(".statusDisplay").html(data);
					$(".commonmodal").modal("hide");
					$(".commonmodal").remove();				
			},
		});
	});

	$(document).on("change", "#task_completion_status", function () {
		var status = $(this).val();
        
		var arrayStatusValueCheck = addStatusArray.filter(function(value, index){ 
			return parseInt(value['status']) >= parseInt(status) ;
		});

		var lastArray= addStatusArray[addStatusArray.length - 1];		
		 if(typeof lastArray !='undefined' &&  lastArray.length>0){
			if(status > lastArray.status){
				$(this).val(status);
			}else{
				$(this).val('');
			}
			
		 }else{
		
		if (arrayStatusValueCheck.length>0) {
			$(this).val('');
		}else{
			$(this).val(status);
		}
	}
	});



	$(document).on("change", "#task_execution_date", function () {
			var exeDate=$(this).val();
			var lastCheckArray= addStatusArray[addStatusArray.length - 1];
			
			if(typeof lastCheckArray !='undefined' &&  typeof lastCheckArray.date !='undefined'  &&  lastCheckArray.date !=''){

				var existingDate = new Date(lastCheckArray.date);
              var newDate = new Date(exeDate);
			  
				if(newDate > existingDate){
					
					$("#task_execution_date").val(exeDate);
				}else{
					
					
					$("#task_execution_date").val('');
					swal.fire("Sorry", 'Execution date should be greater than previous entry', "error");
				}
				
			 }
	});

	$(document).on("change", ".task_completion_status", function () {
		var status = $(this).val();
        
		var arrayStatusValueCheck = addStatusArray.filter(function(value, index){ 
			return parseInt(value['status']) = parseInt(status) ;
		});
		
		if (arrayStatusValueCheck.length>0) {
			$(this).val('');
		}else{
			$(this).val(status);
		}
	});


	$(document).on("click", "#submitTask", function () {
		$("#addTaskForm").parsley({
			excluded:
				"input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden",
		});

		$("#submitTask").attr("data-kt-indicator", "on");
		$("#submitTask").attr("disabled", true);
		$("#addTaskForm").parsley().validate();
		if ($("#addTaskForm").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "staff/taskSubmitProcess",
				data: $("#addTaskForm").serialize()+'&'+$.param({ 'statusdata': addStatusArray }),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.href = base_url + "staff/tasks";
					} else {
						$("#submitTask").removeAttr("data-kt-indicator");
						$("#submitTask").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#submitTask").removeAttr("data-kt-indicator");
			$("#submitTask").attr("disabled", false);
		}
	});
	
}

function staffedittask() {
	$(document).on("change", "#category", function () {
		$("#subcategory").empty();
		$catid = $("#category option:selected").val();
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/getSubCategory",
			data: {
				catid: $catid,
			},
			success: function (data) {
				$("#subcategory").empty();
				$("#subcategory").append(data);
				$("#subcategory").select2();
			},
		});
	});

	$(document).on("click", "#submitTask", function () {
		$("#addTaskForm").parsley({
			excluded:
				"input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden",
		});

		$("#submitTask").attr("data-kt-indicator", "on");
		$("#submitTask").attr("disabled", true);
		$("#addTaskForm").parsley().validate();
		if ($("#addTaskForm").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "staff/taskSubmitProcess",
				data: $("#addTaskForm").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.href = base_url + "staff/tasks";
					} else {
						$("#submitTask").removeAttr("data-kt-indicator");
						$("#submitTask").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#submitTask").removeAttr("data-kt-indicator");
			$("#submitTask").attr("disabled", false);
		}
	});

	$("#task_execution_date").flatpickr({
		// minDate: "today",
		dateFormat: "d-m-Y",
	});
	$("#task_date").flatpickr({
		// minDate: "today",
		dateFormat: "d-m-Y",
	});
	$("#task_end_date").flatpickr({
		// minDate: "today",
		dateFormat: "d-m-Y",
	});

	$(".addTaskExecutionDetails").hide();
	$("#task_status").on("keyup change", function () {
		var status = $(this).val();
		if ($(this).val() > 100) {
			$(this).val("100");
		}

		if ($(this).val() >= 1) {
			$(".addTaskExecutionDetails").show();
		} else {
			$(".addTaskExecutionDetails").hide();
		}
	});
	// $(document).on("change", "#task_completion_status", function () {
	// 	var status = $(this).val();
	// 	var previous = $(this).data("previous");
	// 	if ($(this).val() <= previous) {
	// 		$(this).val('');
	// 	}
	// });

	$("#kt_table_task_details").DataTable();

	$(document).on("click", ".updateTaskStatus", function () {
		$editid = $(this).data("item");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/updateTaskStatus",
			data: {
				pagename: "updateTaskStatus",
				editid: $editid,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".form-select").select2();
				$(".commonmodal").modal("show");
				$("#task_execution_date").flatpickr({
					// minDate: "today",
					dateFormat: "d-m-Y",
				});
			},
		});
	});

	$(document).on("click", "#kt_add_category_submit", function () {
		$("#kt_add_category_submit").attr("data-kt-indicator", "on");
		$("#kt_add_category_submit").attr("disabled", true);
		$("#kt_modal_add_category_form").parsley().validate();
		if ($("#kt_modal_add_category_form").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "staff/updateTaskStatusDetails",
				data: $("#kt_modal_add_category_form").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_add_category_submit").removeAttr("data-kt-indicator");
						$("#kt_add_category_submit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_add_category_submit").removeAttr("data-kt-indicator");
			$("#kt_add_category_submit").attr("disabled", false);
		}
	});

	$(document).on("click", ".editTaskStatusDetails", function () {
		$editid = $(this).data("item");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/editTaskStatusDetails",
			data: {
				pagename: "editTaskStatusDetails",
				editid: $editid,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".form-select").select2();
				$(".commonmodal").modal("show");
				$("#task_execution_date").flatpickr({
					// minDate: "today",
					dateFormat: "d-m-Y",
				});
			},
		});
	});

	$(document).on("click", "#kt_add_task_status_edit", function () {
		$("#kt_add_task_status_edit").attr("data-kt-indicator", "on");
		$("#kt_add_task_status_edit").attr("disabled", true);
		$("#kt_modal_add_category_form").parsley().validate();
		if ($("#kt_modal_add_category_form").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "staff/editTaskStatusDetailsProcess",
				data: $("#kt_modal_add_category_form").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_add_task_status_edit").removeAttr("data-kt-indicator");
						$("#kt_add_task_status_edit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_add_task_status_edit").removeAttr("data-kt-indicator");
			$("#kt_add_task_status_edit").attr("disabled", false);
		}
	});
	$(document).on("click", ".viewTaskStatusDetails", function () {
		$editid = $(this).data("item");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/viewTaskStatusDetails",
			data: {
				pagename: "viewTaskStatusDetails",
				editid: $editid,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".commonmodal").modal("show");
			},
		});
	});
}
function admintasks() {
	var save_method;
	var table;
	table = $("#kt_table_users").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		order: [],
		ajax: {
			url: base_url + "admin/ajaxstafftaskslist",
			type: "POST",
			data: function (data) {
				data.search.value = $(".search-in-table").val();
			},
		},
		language: {
			emptyTable: "No tasks available....!",
			processing: "Loading tasks ",
		},
		columnDefs: [
			{
				targets: "no-sort",
				orderable: false,
			},
		],
	});

	$(document).on("click", "#btn-filter", function (event) {
		table.ajax.reload();
	});
	$(document).on("keyup", ".search-in-table", function (event) {
		table.ajax.reload();
	});

	$(document).on("click", "#btn-reset", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", "#btn-cancel", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", ".deleteTaskDetails", function () {
		var itemid = $(this).data("itemid");

		swal
			.fire({
				title: "Are you sure?",
				text: "you wish to change this item status?",
				icon: "info",
				buttonsStyling: false,
				showCancelButton: true,
				confirmButtonText: "Ok",
				cancelButtonText: "No, cancel it",
				customClass: {
					confirmButton: "btn btn-primary",
					cancelButton: "btn btn-danger",
				},
			})
			.then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: base_url + "staff/deleteTaskDetails/" + itemid,
						type: "POST",
						dataType: "text",
						success: function (retObj) {
							window.location.reload();
						},
					});
				}
			});
	});
}

function teamList() {
	table = $("#kt_table_Team").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		order: [],
		ajax: {
			url: base_url + "admin/ajaxteamlist",
			type: "POST",
			data: function (data) {
				data.search.value = $(".search-in-table").val();
			},
		},
		language: {
			emptyTable: "No team available....!",
			processing: "Loading team ",
		},
		columnDefs: [
			{
				targets: "no-sort",
				orderable: false,
			},
		],
	});

	$(document).on("click", "#btn-filter", function (event) {
		table.ajax.reload();
	});
	$(document).on("keyup", ".search-in-table", function (event) {
		table.ajax.reload();
	});

	$(document).on("click", "#btn-reset", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", "#btn-cancel", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});

	$(document).on("click", ".addTaskTeam", function () {
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "admin/addTaskTeam",
			data: {
				pagename: "addTaskTeam",
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".commonmodal").modal("show");
				$(".form-select").select2();
			},
		});
	});

	$(document).on("click", ".teamEdit", function () {
		$editid = $(this).data("item");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "admin/teamEdit",
			data: {
				pagename: "addTaskTeam",
				editid: $editid,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".commonmodal").modal("show");
				$(".form-select").select2();
			},
		});
	});

	$(document).on("click", "#kt_add_category_submit", function () {
		$("#kt_add_category_submit").attr("data-kt-indicator", "on");
		$("#kt_add_category_submit").attr("disabled", true);
		$("#kt_modal_add_category_form").parsley().validate();
		if ($("#kt_modal_add_category_form").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "admin/teamSubmitProcess",
				data: $("#kt_modal_add_category_form").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_add_category_submit").removeAttr("data-kt-indicator");
						$("#kt_add_category_submit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_add_category_submit").removeAttr("data-kt-indicator");
			$("#kt_add_category_submit").attr("disabled", false);
		}
	});

	$(document).on("click", ".deleteTeam", function () {
		var itemid = $(this).data("itemid");

		swal
			.fire({
				title: "Are you sure?",
				text: "you wish to change this item status?",
				icon: "info",
				buttonsStyling: false,
				showCancelButton: true,
				confirmButtonText: "Ok",
				cancelButtonText: "No, cancel it",
				customClass: {
					confirmButton: "btn btn-primary",
					cancelButton: "btn btn-danger",
				},
			})
			.then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: base_url + "admin/deleteTeam/" + itemid,
						type: "POST",
						dataType: "text",
						success: function (retObj) {
							window.location.reload();
						},
					});
				}
			});
	});

	$(document).on("click", ".teamView", function () {
		$editid = $(this).data("item");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "admin/teamView",
			data: {
				pagename: "teamView",
				editid: $editid,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$(".commonmodal").modal("show");
				$(".teamdetailsTable").DataTable();
			},
		});
	});
}

function adminaddtask() {
	$(document).on("change", "#category", function () {
		$("#subcategory").empty();
		$catid = $("#category option:selected").val();
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/getSubCategory",
			data: {
				catid: $catid,
			},
			success: function (data) {
				$("#subcategory").empty();
				$("#subcategory").append(data);
				$("#subcategory").select2();
			},
		});
	});

	$(document).on("click", "#submitTask", function () {
		$("#addTaskForm").parsley({
			excluded:
				"input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden",
		});

		$("#submitTask").attr("data-kt-indicator", "on");
		$("#submitTask").attr("disabled", true);
		$("#addTaskForm").parsley().validate();
		if ($("#addTaskForm").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "admin/taskSubmitProcess",
				data: $("#addTaskForm").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.href = base_url + "admin/manage_tasks";
					} else {
						$("#submitTask").removeAttr("data-kt-indicator");
						$("#submitTask").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#submitTask").removeAttr("data-kt-indicator");
			$("#submitTask").attr("disabled", false);
		}
	});

	$("#task_date").flatpickr({
		// minDate: "today",
		dateFormat: "d-m-Y",
	});
	$("#task_end_date").flatpickr({
		// minDate: "today",
		dateFormat: "d-m-Y",
	});

	$(document).on("click", ".assign_type", function () {
		var assign_type = $('input[name="assign_type"]:checked').val();
		if (assign_type == "1") {
			$(".individualList").show();
			$(".teamList").hide();
		} else if (assign_type == "2") {
			$(".individualList").hide();
			$(".teamList").show();
		} else {
			$(".individualList").hide();
			$(".teamList").hide();
		}
	});
	
}
function editstaff(){
	$(document).on("click", "#submitTask", function () {
		$("#addTaskForm").parsley({
			excluded:
				"input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden",
		});

		$("#submitTask").attr("data-kt-indicator", "on");
		$("#submitTask").attr("disabled", true);
		$("#addTaskForm").parsley().validate();
		if ($("#addTaskForm").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "admin/editStaffSubmitProcess",
				data: $("#addTaskForm").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#submitTask").removeAttr("data-kt-indicator");
						$("#submitTask").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#submitTask").removeAttr("data-kt-indicator");
			$("#submitTask").attr("disabled", false);
		}
	});
}

function viewassignedlist() {
	table = $("#kt_table_task_users_assigned").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		order: [],
		ajax: {
			url: base_url + "admin/ajaxtaskassignedstafflist",
			type: "POST",
			data: function (data) {
				data.search.value = $(".search-in-table").val();
				data.viewtaskid = $("#viewtaskid").val();
			},
		},
		language: {
			emptyTable: "No assigned staff available....!",
			processing: "Loading assigned staff ",
		},
		columnDefs: [
			{
				targets: "no-sort",
				orderable: false,
			},
		],
	});

	$(document).on("click", "#btn-filter", function (event) {
		table.ajax.reload();
	});
	$(document).on("keyup", ".search-in-table", function (event) {
		table.ajax.reload();
	});

	$(document).on("click", "#btn-reset", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", "#btn-cancel", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});

	$(document).on("click", ".viewStaffTaskStatusDetails", function () {
		$taskid = $(this).data("taskid");
		$staff = $(this).data("staff");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "admin/viewStaffTaskStatusDetails",
			data: {
				pagename: "viewStaffTaskStatusDetails",
				taskid: $taskid,
				staff: $staff,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$(".commonmodal").modal("show");
				$(".statusdetailsTable").DataTable();
			},
		});
	});

	$(document).on('change','.form-check-input',function(){
		var count = $("input[name='allusers[]']:checked").length;
		if(count > 0){
			$(".approveTaskStatus").show();
			$(".rejectTaskStatus").show();
		}else{
			$(".approveTaskStatus").hide();
			$(".rejectTaskStatus").hide();
		}
	});

	$(".allcheck").click(function(){
		$('input:checkbox').not(this).prop('checked', this.checked);
	});

	$(document).on("click", ".approveTaskStatus", function () {
			$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/approveAllTaskStatus",
			data: {
				pagename: "approveTaskStatus",				
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();				
				$(".commonmodal").modal("show");
				
			},
		});
	});

	$(document).on("click", "#kt_form_approve_task_submit", function () {
		$("#kt_form_approve_task_submit").attr("data-kt-indicator", "on");
		$("#kt_form_approve_task_submit").attr("disabled", true);
		$("#kt_modal_add_task_form").parsley().validate();
		if ($("#kt_modal_add_task_form").parsley().isValid()) {

			

			const checkedList = [];
			$("input[name='allusers[]']:checked").each(function () {
				var ischecked = $(this).is(":checked");
				if (ischecked) {
					checkedList.push($(this).val());
				}
			});

			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "staff/approveAllTaskProcess",
				data: {checkedList:checkedList},
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_form_approve_task_submit").removeAttr("data-kt-indicator");
						$("#kt_form_approve_task_submit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_form_approve_task_submit").removeAttr("data-kt-indicator");
			$("#kt_form_approve_task_submit").attr("disabled", false);
		}
	});
	$(document).on("click", ".rejectTaskStatus", function () {		
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/approveAllTaskStatus",
			data: {
				pagename: "rejectTaskStatus",				
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();				
				$(".commonmodal").modal("show");
				
			},
		});
	});

	$(document).on("click", "#kt_form_reject_task_submit", function () {
		$("#kt_form_reject_task_submit").attr("data-kt-indicator", "on");
		$("#kt_form_reject_task_submit").attr("disabled", true);
		$("#kt_modal_add_task_form").parsley().validate();
		if ($("#kt_modal_add_task_form").parsley().isValid()) {
			const checkedList = [];
			$("input[name='allusers[]']:checked").each(function () {
				var ischecked = $(this).is(":checked");
				if (ischecked) {
					checkedList.push($(this).val());
				}
			});
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "staff/rejectAllTaskProcess",
				data: {checkedList:checkedList},
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_form_reject_task_submit").removeAttr("data-kt-indicator");
						$("#kt_form_reject_task_submit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_form_reject_task_submit").removeAttr("data-kt-indicator");
			$("#kt_form_reject_task_submit").attr("disabled", false);
		}
	});
}

function viewstaff() {
	$(document).on("click", ".adminStaffProfileAddTask", function () {
		$id=$(this).data('id');
		$auth=$(this).data('auth');
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "admin/adminStaffProfileAddTask",
			data: {
				pagename: "adminStaffProfileAddTask",
				auth:$auth,
				id:$id
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#addTaskForm").parsley();
				$(".form-select").select2();
				$("#task_date").flatpickr({
					// minDate: "today",
					dateFormat: "d-m-Y",
				});
				$("#task_end_date").flatpickr({
					// minDate: "today",
					dateFormat: "d-m-Y",
				});
				$(".commonmodal").modal("show");
			},
		});
	});


	$(document).on("change", "#category", function () {
		$("#subcategory").empty();
		$catid = $("#category option:selected").val();
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/getSubCategory",
			data: {
				catid: $catid,
			},
			success: function (data) {
				$("#subcategory").empty();
				$("#subcategory").append(data);
				$("#subcategory").select2();
			},
		});
	});

	$(document).on("click", "#submitTask", function () {
		$("#addTaskForm").parsley({
			excluded:
				"input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden",
		});

		$("#submitTask").attr("data-kt-indicator", "on");
		$("#submitTask").attr("disabled", true);
		$("#addTaskForm").parsley().validate();
		if ($("#addTaskForm").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "admin/profileTaskSubmitProcess",
				data: $("#addTaskForm").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.href = base_url + "admin/manage_tasks";
					} else {
						$("#submitTask").removeAttr("data-kt-indicator");
						$("#submitTask").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#submitTask").removeAttr("data-kt-indicator");
			$("#submitTask").attr("disabled", false);
		}
	});

	$("#task_date").flatpickr({
		// minDate: "today",
		dateFormat: "d-m-Y",
	});
	$("#task_end_date").flatpickr({
		// minDate: "today",
		dateFormat: "d-m-Y",
	});
}
function viewtaskdetails() {
	

	$("#task_execution_date").flatpickr({
		// minDate: "today",
		dateFormat: "d-m-Y",
	});
	$("#task_date").flatpickr({
		// minDate: "today",
		dateFormat: "d-m-Y",
	});
	$("#task_end_date").flatpickr({
		// minDate: "today",
		dateFormat: "d-m-Y",
	});

	
	$("#task_status").on("keyup change", function () {
		var status = $(this).val();
		if ($(this).val() > 100) {
			$(this).val("100");
		}

		if ($(this).val() >= 1) {
			$(".addTaskExecutionDetails").show();
		} else {
			$(".addTaskExecutionDetails").hide();
		}
	});
	// $(document).on("change", "#task_completion_status", function () {
	// 	var status = $(this).val();
	// 	var previous = $(this).data("previous");
	// 	if ($(this).val() <= previous) {
	// 		$(this).val(previous+1);
	// 	}
	// });

	$("#kt_table_task_details").DataTable();

	$(document).on("click", ".updateTaskStatus", function () {
		$editid = $(this).data("item");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/updateTaskStatus",
			data: {
				pagename: "updateTaskStatus",
				editid: $editid,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".form-select").select2();
				$(".commonmodal").modal("show");
				$("#task_execution_date").flatpickr({
					// minDate: "today",
					dateFormat: "d-m-Y",
				});
			},
		});
	});

	$(document).on("click", "#kt_add_category_submit", function () {
		$("#kt_add_category_submit").attr("data-kt-indicator", "on");
		$("#kt_add_category_submit").attr("disabled", true);
		$("#kt_modal_add_category_form").parsley().validate();
		if ($("#kt_modal_add_category_form").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "staff/updateTaskStatusDetails",
				data: $("#kt_modal_add_category_form").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_add_category_submit").removeAttr("data-kt-indicator");
						$("#kt_add_category_submit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_add_category_submit").removeAttr("data-kt-indicator");
			$("#kt_add_category_submit").attr("disabled", false);
		}
	});

	$(document).on("click", ".editTaskStatusDetails", function () {
		$editid = $(this).data("item");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/editTaskStatusDetails",
			data: {
				pagename: "editTaskStatusDetails",
				editid: $editid,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".form-select").select2();
				$(".commonmodal").modal("show");
				$("#task_execution_date").flatpickr({
					// minDate: "today",
					dateFormat: "d-m-Y",
				});
			},
		});
	});

	$(document).on("click", "#kt_add_task_status_edit", function () {
		$("#kt_add_task_status_edit").attr("data-kt-indicator", "on");
		$("#kt_add_task_status_edit").attr("disabled", true);
		$("#kt_modal_add_category_form").parsley().validate();
		if ($("#kt_modal_add_category_form").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "staff/editTaskStatusDetailsProcess",
				data: $("#kt_modal_add_category_form").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_add_task_status_edit").removeAttr("data-kt-indicator");
						$("#kt_add_task_status_edit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_add_task_status_edit").removeAttr("data-kt-indicator");
			$("#kt_add_task_status_edit").attr("disabled", false);
		}
	});
	$(document).on("click", ".viewTaskStatusDetails", function () {
		$editid = $(this).data("item");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/viewTaskStatusDetails",
			data: {
				pagename: "viewTaskStatusDetails",
				editid: $editid,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".commonmodal").modal("show");
			},
		});
	});
}

function reportingstafftasks() {
	var save_method;
	var table;
	table = $("#kt_table_users").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		order: [],
		ajax: {
			url: base_url + "staff/ajaxreportingstafftaskslist",
			type: "POST",
			data: function (data) {
				data.search.value = $(".search-in-table").val();				
			},
		},
		language: {
			emptyTable: "No tasks available....!",
			processing: "Loading tasks ",
		},
		columnDefs: [
			{
				targets: "no-sort",
				orderable: false,
			},
		],
	});

	$(document).on("click", "#btn-filter", function (event) {
		table.ajax.reload();
	});
	$(document).on("keyup", ".search-in-table", function (event) {
		table.ajax.reload();
	});

	$(document).on("click", "#btn-reset", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", "#btn-cancel", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	
}
function viewtaskbyreporting(){
	$("#kt_table_task_details").DataTable();
	$(document).on("click", ".viewTaskStatusDetails", function () {
		$editid = $(this).data("item");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/viewTaskStatusDetails",
			data: {
				pagename: "viewTaskStatusDetails",
				editid: $editid,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".commonmodal").modal("show");
			},
		});
	});

	$(document).on("click", ".approveTaskStatus", function () {
		$stafftaskid = $(this).data("stafftaskid");
		$taskid = $(this).data("item");
		$staffid = $(this).data("staffid");

		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/approveTaskStatus",
			data: {
				pagename: "approveTaskStatus",
				stafftaskid: $stafftaskid,
				taskid: $taskid,
				staffid : $staffid
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();				
				$(".commonmodal").modal("show");
				
			},
		});
	});

	$(document).on("click", "#kt_form_approve_task_submit", function () {
		$("#kt_form_approve_task_submit").attr("data-kt-indicator", "on");
		$("#kt_form_approve_task_submit").attr("disabled", true);
		$("#kt_modal_add_task_form").parsley().validate();
		if ($("#kt_modal_add_task_form").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "staff/approveTaskProcess",
				data: $("#kt_modal_add_task_form").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_form_approve_task_submit").removeAttr("data-kt-indicator");
						$("#kt_form_approve_task_submit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_form_approve_task_submit").removeAttr("data-kt-indicator");
			$("#kt_form_approve_task_submit").attr("disabled", false);
		}
	});
	$(document).on("click", ".rejectTaskStatus", function () {
		$stafftaskid = $(this).data("stafftaskid");
		$taskid = $(this).data("item");
		$staffid = $(this).data("staffid");

		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/approveTaskStatus",
			data: {
				pagename: "rejectTaskStatus",
				stafftaskid: $stafftaskid,
				taskid: $taskid,
				staffid : $staffid
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();				
				$(".commonmodal").modal("show");
				
			},
		});
	});

	$(document).on("click", "#kt_form_reject_task_submit", function () {
		$("#kt_form_reject_task_submit").attr("data-kt-indicator", "on");
		$("#kt_form_reject_task_submit").attr("disabled", true);
		$("#kt_modal_add_task_form").parsley().validate();
		if ($("#kt_modal_add_task_form").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "staff/rejectTaskProcess",
				data: $("#kt_modal_add_task_form").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_form_reject_task_submit").removeAttr("data-kt-indicator");
						$("#kt_form_reject_task_submit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_form_reject_task_submit").removeAttr("data-kt-indicator");
			$("#kt_form_reject_task_submit").attr("disabled", false);
		}
	});

	
}

function reportingaddtask() {
	$(document).on("change", "#category", function () {
		$("#subcategory").empty();
		$catid = $("#category option:selected").val();
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/getSubCategory",
			data: {
				catid: $catid,
			},
			success: function (data) {
				$("#subcategory").empty();
				$("#subcategory").append(data);
				$("#subcategory").select2();
			},
		});
	});

	$(document).on("click", "#submitTask", function () {
		$("#addTaskForm").parsley({
			excluded:
				"input[type=button], input[type=submit], input[type=reset], input[type=hidden], [disabled], :hidden",
		});

		$("#submitTask").attr("data-kt-indicator", "on");
		$("#submitTask").attr("disabled", true);
		$("#addTaskForm").parsley().validate();
		if ($("#addTaskForm").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "staff/reportingTaskSubmitProcess",
				data: $("#addTaskForm").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.href = base_url + "staff/reportingstafftasks";
					} else {
						$("#submitTask").removeAttr("data-kt-indicator");
						$("#submitTask").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#submitTask").removeAttr("data-kt-indicator");
			$("#submitTask").attr("disabled", false);
		}
	});

	$("#task_execution_date").flatpickr({
		// minDate: "today",
		dateFormat: "d-m-Y",
	});
	$("#task_date").flatpickr({
		// minDate: "today",
		dateFormat: "d-m-Y",
	});
	$("#task_end_date").flatpickr({
		// minDate: "today",
		dateFormat: "d-m-Y",
	});

	
	$(document).on("click", ".assign_type", function () {
		var assign_type = $('input[name="assign_type"]:checked').val();
		if (assign_type == "1") {
			$(".individualList").show();
			$(".teamList").hide();
		} else if (assign_type == "2") {
			$(".individualList").hide();
			$(".teamList").show();
		} else {
			$(".individualList").hide();
			$(".teamList").hide();
		}
	});

	
}
function reportingstafftasksfinished() {
	var save_method;
	var table;
	table = $("#kt_table_users").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		order: [],
		ajax: {
			url: base_url + "staff/ajaxreportingstafftasksfinishedlist",
			type: "POST",
			data: function (data) {
				data.search.value = $(".search-in-table").val();				
			},
		},
		language: {
			emptyTable: "No tasks available....!",
			processing: "Loading tasks ",
		},
		columnDefs: [
			{
				targets: "no-sort",
				orderable: false,
			},
		],
	});

	$(document).on("click", "#btn-filter", function (event) {
		table.ajax.reload();
	});
	$(document).on("keyup", ".search-in-table", function (event) {
		table.ajax.reload();
	});

	$(document).on("click", "#btn-reset", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", "#btn-cancel", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on('change','.form-check-input',function(){
		var count = $("input[name='allusers[]']:checked").length;
		if(count > 0){
			$(".approveTaskStatus").show();
			$(".rejectTaskStatus").show();
		}else{
			$(".approveTaskStatus").hide();
			$(".rejectTaskStatus").hide();
		}
	});
	$(".allcheck").click(function(){
		$('input:checkbox').not(this).prop('checked', this.checked);
	});

	$(document).on("click", ".approveTaskStatus", function () {
			$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/approveAllTaskStatus",
			data: {
				pagename: "approveTaskStatus",				
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();				
				$(".commonmodal").modal("show");
				
			},
		});
	});

	$(document).on("click", "#kt_form_approve_task_submit", function () {
		$("#kt_form_approve_task_submit").attr("data-kt-indicator", "on");
		$("#kt_form_approve_task_submit").attr("disabled", true);
		$("#kt_modal_add_task_form").parsley().validate();
		if ($("#kt_modal_add_task_form").parsley().isValid()) {

			

			const checkedList = [];
			$("input[name='allusers[]']:checked").each(function () {
				var ischecked = $(this).is(":checked");
				if (ischecked) {
					checkedList.push($(this).val());
				}
			});

			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "staff/approveAllTaskProcess",
				data: {checkedList:checkedList},
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_form_approve_task_submit").removeAttr("data-kt-indicator");
						$("#kt_form_approve_task_submit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_form_approve_task_submit").removeAttr("data-kt-indicator");
			$("#kt_form_approve_task_submit").attr("disabled", false);
		}
	});
	$(document).on("click", ".rejectTaskStatus", function () {		
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/approveAllTaskStatus",
			data: {
				pagename: "rejectTaskStatus",				
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();				
				$(".commonmodal").modal("show");
				
			},
		});
	});

	$(document).on("click", "#kt_form_reject_task_submit", function () {
		$("#kt_form_reject_task_submit").attr("data-kt-indicator", "on");
		$("#kt_form_reject_task_submit").attr("disabled", true);
		$("#kt_modal_add_task_form").parsley().validate();
		if ($("#kt_modal_add_task_form").parsley().isValid()) {
			const checkedList = [];
			$("input[name='allusers[]']:checked").each(function () {
				var ischecked = $(this).is(":checked");
				if (ischecked) {
					checkedList.push($(this).val());
				}
			});
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "staff/rejectAllTaskProcess",
				data: {checkedList:checkedList},
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_form_reject_task_submit").removeAttr("data-kt-indicator");
						$("#kt_form_reject_task_submit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_form_reject_task_submit").removeAttr("data-kt-indicator");
			$("#kt_form_reject_task_submit").attr("disabled", false);
		}
	});
	
}
function staffcalendar(){
	var green =  KTUtil.getCssVariableValue("--kt-success-active");
	var red =  KTUtil.getCssVariableValue("--kt-danger-active");

var todayDate = moment().startOf("day");

var TODAY = todayDate.format("YYYY-MM-DD");


var calendarEl = document.getElementById("kt_calendar_app");
var calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
    },

    height: 800,
    contentHeight: 780,
    aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

    nowIndicator: true,
    now: TODAY + "T09:25:00", // just for demo

    views: {
        dayGridMonth: { buttonText: "month" },
        timeGridWeek: { buttonText: "week" },
        timeGridDay: { buttonText: "day" }
    },

    initialView: "dayGridMonth",
    initialDate: TODAY,

    editable: true,
    dayMaxEvents: true, // allow "more" link when too many events
    navLinks: true,
	displayEventTime: false,
    events: {
		url: base_url+'staff/gettallstafftask',
		
	},
	eventClick: function(info) {
		// alert('Event: ' + info.event.title);
		// alert('Event: ' + );
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/taskCalendarView",
			data: {
				pagename: "taskCalendarView",
				editid: info.event.id,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
							
				$(".commonmodal").modal("show");
				$("#kt_table_task_details_pop").DataTable();
				
			},
		});

		// alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
		// alert('View: ' + info.view.type);
	
		// change the border color just for fun
		//info.el.style.borderColor = 'red';
	  }
	// eventRender: function (event, element, view) {
	// 	if (event.allDay === 'true') {
	// 		event.allDay = true;
	// 	} else {
	// 		event.allDay = false;
	// 	}
	// },
    // eventContent: function (info) {
    //     var element = $(info.el);

    //     if (info.event.extendedProps && info.event.extendedProps.description) {
    //         if (element.hasClass("fc-day-grid-event")) {
    //             element.data("content", info.event.extendedProps.description);
    //             element.data("placement", "top");
    //             KTApp.initPopover(element);
    //         } else if (element.hasClass("fc-time-grid-event")) {
    //             element.find(".fc-title").append("<div class="fc-description">" + info.event.extendedProps.description + "</div>");
    //         } else if (element.find(".fc-list-item-title").lenght !== 0) {
    //             element.find(".fc-list-item-title").append("<div class="fc-description">" + info.event.extendedProps.description + "</div>");
    //         }
    //     }
    // }
});

calendar.render();


}

function rejectedtasks() {
	var save_method;
	var table;
	table = $("#kt_table_users").DataTable({
		destroy: true,
		processing: true,
		serverSide: true,
		order: [],
		ajax: {
			url: base_url + "staff/ajaxstaffrejectedtaskslist",
			type: "POST",
			data: function (data) {
				data.search.value = $(".search-in-table").val();
				data.tasktype = 3;
			},
		},
		language: {
			emptyTable: "No tasks available....!",
			processing: "Loading tasks ",
		},
		columnDefs: [
			{
				targets: "no-sort",
				orderable: false,
			},
		],
	});

	$(document).on("click", "#btn-filter", function (event) {
		table.ajax.reload();
	});
	$(document).on("keyup", ".search-in-table", function (event) {
		table.ajax.reload();
	});

	$(document).on("click", "#btn-reset", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", "#btn-cancel", function (event) {
		$("#form-filter")[0].reset();
		table.ajax.reload();
	});
	$(document).on("click", ".updateTaskStatus", function () {
		$editid = $(this).data("item");
		$.ajax({
			dataType: "html",
			type: "POST",
			url: base_url + "staff/updateTaskStatus",
			data: {
				pagename: "updateTaskStatus",
				editid: $editid,
			},
			success: function (data) {
				$(".commonmodal").remove();
				$(document.body).append(data);
				$("#kt_modal_add_category_form").parsley();
				$(".form-select").select2();
				$(".commonmodal").modal("show");
				$("#task_execution_date").flatpickr({
					// minDate: "today",
					dateFormat: "d-m-Y",
				});
			},
		});
	});
	$(document).on("click", "#kt_add_category_submit", function () {
		$("#kt_add_category_submit").attr("data-kt-indicator", "on");
		$("#kt_add_category_submit").attr("disabled", true);
		$("#kt_modal_add_category_form").parsley().validate();
		if ($("#kt_modal_add_category_form").parsley().isValid()) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + "staff/updateTaskStatusDetails",
				data: $("#kt_modal_add_category_form").serialize(),
				cache: false,
				timeout: 600000,
				success: function (data) {
					var e = JSON.parse(data);
					if (e.status == "Yes") {
						window.location.reload();
					} else {
						$("#kt_add_category_submit").removeAttr("data-kt-indicator");
						$("#kt_add_category_submit").attr("disabled", false);
						swal.fire("Sorry", e.Message, "error");
					}
				},
			});
		} else {
			$("#kt_add_category_submit").removeAttr("data-kt-indicator");
			$("#kt_add_category_submit").attr("disabled", false);
		}
	});

	$(document).on("click", ".deleteTaskDetails", function () {
		var itemid = $(this).data("itemid");

		swal
			.fire({
				title: "Are you sure?",
				text: "you wish to change this item status?",
				icon: "info",
				buttonsStyling: false,
				showCancelButton: true,
				confirmButtonText: "Ok",
				cancelButtonText: "No, cancel it",
				customClass: {
					confirmButton: "btn btn-primary",
					cancelButton: "btn btn-danger",
				},
			})
			.then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: base_url + "staff/deleteTaskDetails/" + itemid,
						type: "POST",
						dataType: "text",
						success: function (retObj) {
							window.location.reload();
						},
					});
				}
			});
	});
}

function staffcalendarreporting(){
	$(document).on("change", ".dataselectfilter", function () {
		
		$month = $("#month option:selected").val();
		$year = $("#year option:selected").val();
		window.location.href=base_url+'staff/staffcalendar/'+$month+'/'+$year;
	});
}
$(document).on("click", ".deleteItems", function () {
	$id = $(this).data("id");
	$auth = $(this).data("auth");
	$url = $(this).data("url");

	swal({
		title: "Are you sure?",
		text: "You want to change  this status!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type: "POST",
				enctype: "multipart/form-data",
				url: base_url + $url,
				data: { id: $id, auth: $auth },
				cache: false,
				success: function (data) {
					window.location.reload();
				},
			});
		}
	});
});

(function ($) {
	"use strict";
	$(function () {
		$("#facilitylogo").on("change", function () {
			var filename = $("input[type=file]")
				.val()
				.replace(/C:\\fakepath\\/i, "");
			$(".custom-file-label").html(filename);
		});
	});
})(jQuery);
