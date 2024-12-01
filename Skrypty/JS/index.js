function menuOpcji(event) {

    const clickedCard = event.currentTarget;

    const cardTitleElement = clickedCard.querySelector('.opisOpcji');
    const cardIconElement = clickedCard.querySelector('.okladkaOpcji use');
    
        const cardTitle = cardTitleElement.innerText;
        const cardIcon = cardIconElement.cloneNode(true); 


        const primaryButton = document.querySelector('.primaryButton');
        const tableActionMenu = document.getElementById('tableActionMenu');
        const actionMenuTitle = document.getElementById('actionMenuTitle');
        const actionMenuIcon = document.querySelector('.tableActionMenu use');
        const cardStyle = window.getComputedStyle(clickedCard);
        const backgroundColor = cardStyle.backgroundColor;
     
        actionMenuTitle.innerText = cardTitle;
        actionMenuIcon.replaceWith(cardIcon); 
        tableActionMenu.style.backgroundColor = backgroundColor;
        primaryButton.style.color = backgroundColor;
  
        const selectedPopUp = document.querySelector('.selectedPopUp');
        selectedPopUp.style.display = 'flex';  

        document.body.style.overflow = 'hidden';
    }

document.querySelectorAll('.Opcja').forEach(card => {
    card.addEventListener('click', menuOpcji);
});
function closeMenuOpcji(){
    const selectedPopUp = document.querySelector('.selectedPopUp');
        selectedPopUp.style.display = 'none';  

        document.body.style.overflow = '';
}
document.querySelector('.actionMenuAbsoluteButton.exit').addEventListener('click', closeMenuOpcji);
