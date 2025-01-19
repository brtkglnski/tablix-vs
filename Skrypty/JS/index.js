function optionMenu(event) {
    const clickedCard = event.currentTarget;
    const selectedPopUp = document.getElementById('selectedPopUp');
    const tableActionMenu = document.getElementById('tableActionMenu');
    const tableCreationMenu = document.getElementById('tableCreationMenu');

    selectedPopUp.style.display = 'flex';
    document.body.style.overflow = 'hidden';

    if (clickedCard.classList.contains('add')) {
        tableActionMenu.style.display = 'none';
        tableCreationMenu.style.display = 'flex';

        const primaryButton = tableCreationMenu.querySelector('.primaryButton');
        const cardStyle = window.getComputedStyle(clickedCard);
        const backgroundColor = cardStyle.backgroundColor;
        primaryButton.style.color = backgroundColor;
    } 
    else {
    const cardTitleElement = clickedCard.querySelector('.optionDescription');
    const cardIconElement = clickedCard.querySelector('.optionCover use');
    
        const cardTitle = cardTitleElement.innerText;
        const cardIcon = cardIconElement.cloneNode(true); 


        const primaryButton = tableActionMenu.querySelector('.primaryButton');
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
                window.location.href = url; 
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
    
document.querySelectorAll('.Option').forEach(card => {
    card.addEventListener('click', optionMenu);
});

function closeOptionMenu(){
    const selectedPopUp = document.querySelector('.selectedPopUp');
    const tableActionMenu = document.getElementById('tableActionMenu');
    const tableCreationMenu = document.getElementById('tableCreationMenu');

         selectedPopUp.style.display = 'none';
         tableActionMenu.style.display = 'none';
         tableCreationMenu.style.display = 'none';

        document.body.style.overflow = '';
}
document.querySelectorAll('.actionMenuAbsoluteButton.exit').forEach(button => {
    button.addEventListener('click', closeOptionMenu);
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
}

document.querySelectorAll('.iconOption').forEach(option => {
    option.addEventListener('click', selectTableIcon);
});

document.querySelectorAll('.submitting').forEach(button => {
    button.addEventListener('click', (event) => {
        event.preventDefault();

        const tableInput = document.getElementById('tableInput');
        const iconInput = document.getElementById('iconInput');
        const sourceInput = document.getElementById('sourceInput');
        const tableNameInput = document.getElementById('addTableName');

        tableInput.value = tableNameInput.value.trim();
        sourceInput.value = button.value;
        
        if (tableInput.value.includes('`')) {
            alert('Nazwa tabeli nie może zawierać symbolu " ` ". Spróbuj ponownie.');
            return;
        }

        if (!tableInput.value || !iconInput.value || !sourceInput.value) {
            alert('Proszę wypełnić wszystkie pola (oraz dodać ikonę)!');
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
        alert('Usuwanie nieudane.');
    }
    document.getElementById('deletionForm').submit();
}
document.querySelectorAll('.delete').forEach(button => {
    button.addEventListener('click', deleteTable);
})

