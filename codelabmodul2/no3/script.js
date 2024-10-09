function validateForm() {
    // Get the form values
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const address = document.getElementById('address').value.trim();

    // Check if any field is empty
    if (!name || !email || !address) {
        alert('Semua data harus diisi.');
        return;
    }

    // Check if the email contains "@" symbol
    if (!email.includes('@')) {
        alert('Email harus mengandung simbol @.');
        return;
    }

    alert('Form berhasil dikirim!');
    // Perform further actions such as sending the data to a server.
}
