function deleteRecord(event) {
    event.preventDefault();

    const row = event.target.closest('tr');
    const recordName = row.querySelector('td').innerText;

    const databaseTitle = document.getElementById('databaseTitle').innerText;
    const tableInput = document.getElementById('tableInput');
    tableInput.value = databaseTitle;

    const recordNameInput = document.getElementById('recordNameInput');
    recordNameInput.value = recordName;

    const formData = new FormData();
    formData.append('record_name', recordName);
    formData.append('table_name', databaseTitle);

    fetch('../Skrypty/PHP/record_deletion.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            row.remove(); 
        } else {
            alert('Błąd przy usuwaniu rekordu.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Błąd przy usuwaniu rekordu.');
    });

}

document.querySelectorAll('.deleteEntryButton').forEach(button => {
    button.addEventListener('click', deleteRecord);
});


function addRecord(event) {
    event.preventDefault();

    const databaseTitle = document.getElementById('databaseTitle').innerText;
    const tableAdditionInput = document.getElementById('tableAdditionInput');
    tableAdditionInput.value = databaseTitle;
    var recordName = document.getElementById("name").value;
    recordName = recordName.trim();
    if (recordName.includes('`') || recordName.includes("'") || recordName.includes('"')) {
        alert('Nazwa tabeli nie może zawierać symboli " ` ", " \' ", ani " \" ". Spróbuj ponownie.');
        return;
    }

    document.getElementById('additionForm').submit();

}

document.getElementById("addEntryButton").addEventListener('click', addRecord);
