// Define form element
const form = document.getElementById('kt_sign_in_form');


// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
var validator = FormValidation.formValidation(
    form,
    {
        fields: {
            'signupuserName': {
                validators: {
                    notEmpty: {
                        message: 'Email/Username is required'
                    },
                }
            },
            'signupPassword':{
                validators: {
                    notEmpty: {
                        message: 'Password is required'
                    },
                } 
            }
        },

        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
                rowSelector: '.fv-row',
                eleInvalidClass: '',
                eleValidClass: ''
            })
        }
    }
);

// Submit button handler
const submitButton = document.getElementById('kt_sign_in_submit');
submitButton.addEventListener('click', function (e) {
    // Prevent default button action
    e.preventDefault();

    // Validate form before submit
    if (validator) {
        validator.validate().then(function (status) {
           

            if (status == 'Valid') {
                // Show loading indication
                submitButton.setAttribute('data-kt-indicator', 'on');

                // Disable button to avoid multiple click
                submitButton.disabled = true;

                var $username = $("#signupuserName").val();
      var $password = $("#signupPassword").val();

      $.ajax({
        type: "POST",
        enctype: "multipart/form-data",
        url: base_url + "welcome/signinauthentication",
        data: { username: $username, password: $password },
        cache: false,
        dataType: "json",
        success: function (data) {
          if (data) {
            var e = data;
            if (e.status == "Yes") {
              window.location.href = base_url + e.url;
            } else {
                submitButton.removeAttribute('data-kt-indicator');
                submitButton.disabled = false;
              swal.fire("Sorry", e.Message, "error");

            }
          }
        },
      });



                // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                // setTimeout(function () {
                //     // Remove loading indication
                //     submitButton.removeAttribute('data-kt-indicator');

                //     // Enable button
                //     submitButton.disabled = false;

                //     // Show popup confirmation
                //     // Swal.fire({
                //     //     text: "Form has been successfully submitted!",
                //     //     icon: "success",
                //     //     buttonsStyling: false,
                //     //     confirmButtonText: "Ok, got it!",
                //     //     customClass: {
                //     //         confirmButton: "btn btn-primary"
                //     //     }
                //     // });

                //      // Submit form
                // }, 2000);
            }
        });
    }
});
