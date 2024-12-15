function menuOpcji(event) {

    const clickedCard = event.currentTarget;
    const selectedPopUp = document.getElementById('selectedPopUp');
    const tableActionMenu = document.getElementById('tableActionMenu');
    const tableCreationMenu = document.getElementById('tableCreationMenu');

    selectedPopUp.style.display = 'flex';
    document.body.style.overflow = 'hidden';

    if (clickedCard.classList.contains('dodaj')) {
        tableActionMenu.style.display = 'none';
        tableCreationMenu.style.display = 'flex';
    } 
    else {
    const cardTitleElement = clickedCard.querySelector('.opisOpcji');
    const cardIconElement = clickedCard.querySelector('.okladkaOpcji use');
    
        const cardTitle = cardTitleElement.innerText;
        const cardIcon = cardIconElement.cloneNode(true); 


        const primaryButton = document.querySelector('.primaryButton');
        const actionMenuTitle = document.getElementById('actionMenuTitle');
        const actionMenuIcon = document.querySelector('.tableActionMenu use');
        const cardStyle = window.getComputedStyle(clickedCard);
        const backgroundColor = cardStyle.backgroundColor;
     
        actionMenuTitle.innerText = cardTitle;
        actionMenuIcon.replaceWith(cardIcon); 
        tableActionMenu.style.backgroundColor = backgroundColor;
        primaryButton.style.color = backgroundColor;

        tableActionMenu.style.display = 'flex';  
        tableCreationMenu.style.display = 'none';

        if (primaryButton) {
            primaryButton.onclick = function() {
                const tableName = document.getElementById('actionMenuTitle').innerText;
                const url = `../Podstrony/comparison.php?table_name=${tableName}`;
                window.location.href = url;  // Redirect to the URL
            };
        }
    
        const secondaryButton = document.querySelector('.secondaryButton');
        if (secondaryButton) {
            secondaryButton.onclick = function() {
                const tableName = document.getElementById('actionMenuTitle').innerText;
                const url = `../Podstrony/modify-table.php?table_name=${tableName}`;
                window.location.href = url; 
            };
        }
    }
    }
    
document.querySelectorAll('.Opcja').forEach(card => {
    card.addEventListener('click', menuOpcji);
});

function closeMenuOpcji(){
    const selectedPopUp = document.querySelector('.selectedPopUp');
    const tableActionMenu = document.getElementById('tableActionMenu');
    const tableCreationMenu = document.getElementById('tableCreationMenu');

         selectedPopUp.style.display = 'none';
         tableActionMenu.style.display = 'none';
         tableCreationMenu.style.display = 'none';

        document.body.style.overflow = '';
}
document.querySelectorAll('.actionMenuAbsoluteButton.exit').forEach(button => {
    button.addEventListener('click', closeMenuOpcji);
});

function selectTableIconMenu(){
    const iconSelection = document.querySelector('.iconSelection');
    const iconSelectionMenu = document.querySelector('.iconSelectionMenu');
    iconSelection.style.display = 'none';
    iconSelectionMenu.style.display = 'grid';
}
document.querySelector('.iconSelection').addEventListener('click', selectTableIconMenu);

function selectTableIcon(event){
    const iconSelectionMenu = document.querySelector('.iconSelectionMenu');
    const selectedIcon = event.currentTarget;
    const selectedIconElement = selectedIcon.querySelector('.iconOption use');
    
    const iconSelection = document.querySelector('.iconSelection');
    const iconSelectionElement = document.querySelector('.iconSelection use')


    const selectedIconStyle = selectedIconElement.cloneNode(true); 
    iconSelectionElement.replaceWith(selectedIconStyle); 

    const selectedIconId = selectedIconElement.getAttribute('value');
    document.getElementById('iconInput').value = selectedIconId;

    iconSelection.style.display = 'flex';
    iconSelectionMenu.style.display = 'none';
    console.log('Selected Icon ID:', selectedIconId);
}

document.querySelectorAll('.iconOption').forEach(option => {
    option.addEventListener('click', selectTableIcon);
});

document.querySelectorAll('.submitting').forEach(button => {
    button.addEventListener('click', (event) => {
        // Prevent the default form submission
        event.preventDefault();

        const tableInput = document.getElementById('tableInput');
        const iconInput = document.getElementById('iconInput');
        const sourceInput = document.getElementById('sourceInput');
        const tableNameInput = document.getElementById('addTableName');

        tableInput.value = tableNameInput.value;
        sourceInput.value = button.value;

        console.log('Table:', tableInput.value);
        console.log('Icon:', iconInput.value);
        console.log('Source:', sourceInput.value);
        
        if (!tableInput.value || !iconInput.value || !sourceInput.value) {
            alert('Please fill all required fields!');
            return;
        }

        document.getElementById('tableForm').submit();
    });
});

function deleteTable(button){
    button.preventDefault();
    var databaseTitle = document.getElementById('actionMenuTitle').innerText;
    var deletionInput = document.getElementById('deletionInput');
    deletionInput.value = databaseTitle;
    if(!deletionInput.value){
        alert('Deletion failed');
    }
    document.getElementById('deletionForm').submit();
}
document.querySelectorAll('.delete').forEach(button => {
    button.addEventListener('click', deleteTable);
})

