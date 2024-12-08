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

document.querySelectorAll('button[type="submit"]').forEach(button => {
    button.addEventListener('click', (event) => {
        // Prevent the default form submission
        event.preventDefault();

        // Set input values
        const tableInput = document.getElementById('tableInput');
        const iconInput = document.getElementById('iconInput');
        const sourceInput = document.getElementById('sourceInput');
        const tableNameInput = document.getElementById('addTableName');

        // Set values
        tableInput.value = tableNameInput.value;
        sourceInput.value = button.value;

        // Log values for debugging
        console.log('Table:', tableInput.value);
        console.log('Icon:', iconInput.value);
        console.log('Source:', sourceInput.value);
        
        // Validate fields
        if (!tableInput.value || !iconInput.value || !sourceInput.value) {
            alert('Please fill all required fields!');
            return;
        }

        // If all validations pass, submit the form
        document.getElementById('tableForm').submit();
    });
});

// document.getElementById('tableForm').onsubmit = function(event) {
//     // Get references to input elements
//     const tableInput = document.getElementById('tableInput');
//     const iconInput = document.getElementById('iconInput');
//     const sourceInput = document.getElementById('sourceInput');
//     const tableNameInput = document.getElementById('addTableName');

//     // Set values
//     tableInput.value = tableNameInput.value;
//     sourceInput.value = event.submitter.value;

//     // Log values for debugging
//     console.log('Table:', tableInput.value);
//     console.log('Icon:', iconInput.value);
//     console.log('Source:', sourceInput.value);
    
//     // Validate fields
//     if (!tableInput.value || !iconInput.value || !sourceInput.value) {
//         alert('Please fill all required fields!');
//         event.preventDefault(); // Stop the form from submitting
//         return false;
//     }

//     // If all validations pass, form will submit normally
//     return true;
// };