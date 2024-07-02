document.getElementById("submitCompanyFactForm").addEventListener("click", function (event) {
    event.preventDefault();
    const csrfTokenInput = document.querySelector('input[name="_token"]');
    const csrfTokenValue = csrfTokenInput.value;
    const formData = new FormData();
    formData.append('project_no', $('#project_no').val());
    formData.append('project_des', $('#project_des').val());
    formData.append('client_no', $('#client_no').val());
    formData.append('client_des', $('#client_des').val());
    formData.append('happy_client_no', $('#happy_client_no').val());
    formData.append('happy_client_des', $('#happy_client_des').val());
    let url = '/company_service_fact_processor';
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
                    text: 'Banner uploaded successfully',
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









