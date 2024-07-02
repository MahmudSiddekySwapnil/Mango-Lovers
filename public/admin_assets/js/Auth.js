
document.getElementById("submitLoginForm").addEventListener("click", function (event) {
    event.preventDefault();
    const csrfTokenInput = document.querySelector('input[name="_token"]');
    const csrfTokenValue = csrfTokenInput.value;
    console.log(csrfTokenValue);
    let requestBody = {
    email_address: $('#emailaddress').val(),
    password: $('#password').val(),
    };
    console.log(requestBody);
    let url='/user_auth_data';
    fetch(url, {
    method: 'POST',
    body: JSON.stringify(requestBody),

    headers: {
    "Content-Type": "application/json",
    'X-CSRF-TOKEN': csrfTokenValue,
},
    }).then(response => response.json()) // Parse the JSON response
        .then(data => {
            let message = data.auth_message;
            if (message === "successful") {
                window.location.href = data.url;
            } else {
                console.log("e");
                Swal.fire({
                    icon: 'warning',
                    title: 'Login Failed',
                    text: "please check your email and password!",
                    timer:2000
                });
            }
        }).catch((err) => {
        console.error(err);

    }).finally(() => {
    });
    });
