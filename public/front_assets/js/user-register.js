document.getElementById('user-form').addEventListener('submit', async function (event) {
    event.preventDefault(); // Prevent the default form submission

    const form = event.target;
    const formData = new FormData(form);

    // Convert FormData to a plain object
    const formDataObj = Object.fromEntries(formData.entries());

    // Get the CSRF token from the meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Send the form data as a POST request using Fetch API
    try {
        const response = await fetch('/user_registration_process', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': csrfToken // Include the CSRF token in the headers
            },
            body: JSON.stringify(formDataObj)
        });
        if (response.ok) {
            // If the response status is in the range 200-299
            // Handle success
            const data = await response.json(); // Parse response body as JSON
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Form submitted successfully!',
                    showConfirmButton: false,
                    timer: 1500 // Automatically close the alert after 1.5 seconds
                }).then(() => {
                    // Redirect to the login page after the alert closes
                    window.location.href = '/user_login';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.errorMessage || 'Something went wrong!',
                    footer: '<a href="#">Contact Support</a>' // You can customize the footer with a link to contact support or any other helpful information
                });
            }
        } else {
            throw new Error('Network response was not ok.');
        }
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
            footer: '<a href="#">Contact Support</a>' // You can customize the footer with a link to contact support or any other helpful information
        });
    }
});
