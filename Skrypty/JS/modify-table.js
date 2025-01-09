function deleteRecord(event) {
    event.preventDefault();

    const row = event.target.closest('tr');
    const recordName = row.querySelector('td').innerText;

    const databaseTitle = document.getElementById('databaseTitle').innerText;
    const tableInput = document.getElementById('tableInput');
    tableInput.value = databaseTitle;

    const recordNameInput = document.getElementById('recordNameInput');
    recordNameInput.value = recordName;

    document.getElementById('deletionForm').submit();

}

document.querySelectorAll('.deleteEntryButton').forEach(button => {
    button.addEventListener('click', deleteRecord);
});


function addRecord(event) {
    event.preventDefault();

    const databaseTitle = document.getElementById('databaseTitle').innerText;
    const tableAdditionInput = document.getElementById('tableAdditionInput');
    tableAdditionInput.value = databaseTitle;

    document.getElementById('additionForm').submit();

}

document.getElementById("addEntryButton").addEventListener('click', addRecord);
