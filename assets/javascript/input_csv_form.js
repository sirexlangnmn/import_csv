$('#input_csv_form').on('submit', function(event) {
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: base_url + "import-csv",
        dataType: "JSON",
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        type: "POST",
        beforeSend: function () {
			$("#btnSubmit").html(
				'<span class="spinner-border spinner-border-sm" mr-1" role="status" aria-hidden="true"></span> Please wait...'
			);
		},
		success: function (data) {
			// validationInput(data.input_csv, "input_csv");

			Swal.fire({
				icon: data.type,
				title: data.title,
				text: data.text,
			});

			$("#btnSubmit").html("Submit");
		},
    });
});