document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('form').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default form submission

        // Get values from inputs
        var email = document.querySelector('[name="email"]').value;
        var username = document.querySelector('[name="username"]').value;
        var password = document.querySelector('[name="password"]').value;
        var confirmPassword = document.querySelector('[name="confirm_password"]').value;

        // Simulated list of registered emails (in a real application, this would be checked on the server)
        var registeredEmails = ['existing@example.com', 'user@example.com'];

        // Check if all inputs are filled
        if (email === '' || username === '' || password === '' || confirmPassword === '') {
            Swal.fire({
                icon: 'error',
                title: 'Gagal mendaftar',
                text: 'Semua kolom harus diisi.',
                confirmButtonText: 'OK'
            });
            return; // Stop form submission
        }

        // Check if passwords match
        if (password !== confirmPassword) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal mendaftar',
                text: 'Password dan Konfirmasi Password tidak cocok.',
                confirmButtonText: 'OK'
            });
            return; // Stop form submission
        }

        // Check if email is already registered
        if (registeredEmails.includes(email)) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal mendaftar',
                text: 'Email telah terdaftar.',
                confirmButtonText: 'OK'
            });
            return; // Stop form submission
        }

        // If all checks pass, show success message and submit the form
        Swal.fire({
            icon: 'success',
            title: 'Berhasil mendaftar',
            text: 'Akun Anda telah berhasil dibuat.',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
});
