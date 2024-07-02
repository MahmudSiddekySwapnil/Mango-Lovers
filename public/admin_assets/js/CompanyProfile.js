document.getElementById("submitCompanyProfileForm").addEventListener("click", function (event) {
    event.preventDefault();
    const csrfTokenInput = document.querySelector('input[name="_token"]');
    const csrfTokenValue = csrfTokenInput.value;
    const formData = new FormData();
    formData.append('title', $('#title').val());
    formData.append('description', $('#description').val());
    formData.append('company_history', $('#company_history').val());
    formData.append('mission', $('#mission').val());
    formData.append('vision', $('#vision').val());
    let url = '/company_profile_manage';
    fetch(url, {
        method: 'POST',
        body: formData,

        headers: {
            'X-CSRF-TOKEN': csrfTokenValue,
        },
    }).then(response => response.json()) // Parse the JSON response
        .then(data => {
            let message = data.message;
            if (data.message === 'Successful') {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'company profile added successfully',
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







function fetchDataAndPopulateModal() {
    // Assuming you have a server endpoint to fetch data, e.g., '/api/company-profile'
    let url = '/company_profile_data_show';
    fetch(url, {
        method: 'GET',
    }).then(response => response.json())
        .then(
            data => {
                console.log(data);
            // Assuming data is an object with properties matching your modal fields
            title.value = data[0].title;
            description.value = data[0].description;
            company_history.value = data[0].company_history;
            mission.value = data[0].mission;
            vision.value = data[0].vision;
        })
        .catch(error => console.error('Error fetching data:', error));
};





