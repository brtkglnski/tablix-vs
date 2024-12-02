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

    iconSelection.style.display = 'flex';
    iconSelectionMenu.style.display = 'none';
}

document.querySelectorAll('.iconOption').forEach(option => {
    option.addEventListener('click', selectTableIcon);
});
