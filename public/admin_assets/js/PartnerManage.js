document.getElementById("partnerSubmitForm").addEventListener("click", function (event) {
    event.preventDefault();
    const csrfTokenInput = document.querySelector('input[name="_token"]');
    const csrfTokenValue = csrfTokenInput.value;
    const formData = new FormData();
    formData.append('picture', document.getElementById('partner').files[0]);
    formData.append('title', $('#partner_title').val());
    let url = '/manage_partner_status';
    fetch(url, {
        method: 'POST',
        body: formData,

        headers: {
            'X-CSRF-TOKEN': csrfTokenValue,
        },
    }).then(response => response.json()) // Parse the JSON response
        .then(data => {
            let message = data.message;
            if (data.message === 'successful') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Partner Logo Uploaded Successfully',
                    timer: 3000,
                    showConfirmButton: false, // Hide the "OK" button
                });
                setTimeout(function() {
                    // Redirect to the specified URL after the timer expires
                    window.location.href = data.url;
                }, 3000); // Delay in milliseconds, matches the timer duration in Swal
            }else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Failed',
                    text:data.message,
                    timer:3000
                });
            }
        }).catch((err) => {
        console.error(err);

    }).finally(() => {
        $('#exampleModal').modal('hide');
    });
});









