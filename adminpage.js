function submitForm() {
    const nama = document.getElementById('nama').value;
    const email = document.getElementById('email').value;
    const nik = document.getElementById('nik').value;
    const tanggalLahir = document.getElementById('tanggalLahir').value;
    const jenisKelamin = document.getElementById('jenisKelamin').value;
    const agama = document.getElementById('agama').value;
    const nomorHandphone = document.getElementById('nomorHandphone').value;
    const alamatRumah = document.getElementById('alamatRumah').value;
    const umur = document.getElementById('umur').value;
    const programStudi = document.getElementById('programStudi').value;

    const data = {
        nama, email, nik, tanggalLahir, jenisKelamin, agama, nomorHandphone, alamatRumah, umur, programStudi
    };

    let url = 'add_student.php';  // PHP script to handle adding a student
    if (editingIndex !== -1) {
        data.index = editingIndex;
        url = 'edit_student.php';  // PHP script to handle editing a student
    }

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            location.reload();  // Reload the page to fetch updated data
        } else {
            alert('Error: ' + result.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

document.addEventListener("DOMContentLoaded", function() {
    fetch('adminpage.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('table-body');
            data.forEach((item, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.nama}</td>
                    <td>${item.email}</td>
                    <td>${item.nik}</td>
                    <td>${item.tanggalLahir}</td>
                    <td>${item.jenisKelamin}</td>
                    <td>${item.agama}</td>
                    <td>${item.nomorHandphone}</td>
                    <td>${item.alamatRumah}</td>
                    <td>${item.umur}</td>
                    <td>${item.programStudi}</td>
                    <td>
                        <button onclick="hapusAnggota(${index})">Hapus</button>
                        <button onclick="editAnggota(${index})">Edit</button>
                        <button onclick="cetakKartu(${index})">Cetak</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});

function hapusAnggota(index) {
    if (confirm('Are you sure you want to delete this entry?')) {
        fetch('delete_student.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ index })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                location.reload();  // Reload the page to fetch updated data
            } else {
                alert('Error: ' + result.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

function editAnggota(index) {
    fetch(`get_student.php?index=${index}`)
        .then(response => response.json())
        .then(data => {
            editingIndex = index;
            document.getElementById('modalTitle').innerText = 'Edit Anggota';
            document.getElementById('modalButton').innerText = 'Update';
            document.getElementById('anggotaModal').style.display = 'block';

            document.getElementById('nama').value = data.nama;
            document.getElementById('email').value = data.email;
            document.getElementById('nik').value = data.nik;
            document.getElementById('tanggalLahir').value = data.tanggalLahir;
            document.getElementById('jenisKelamin').value = data.jenisKelamin;
            document.getElementById('agama').value = data.agama;
            document.getElementById('nomorHandphone').value = data.nomorHandphone;
            document.getElementById('alamatRumah').value = data.alamatRumah;
            document.getElementById('umur').value = data.umur;
            document.getElementById('programStudi').value = data.programStudi;
        })
        .catch(error => console.error('Error fetching student data:', error));
}
