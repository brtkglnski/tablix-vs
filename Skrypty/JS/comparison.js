let topScore = parseInt(localStorage.getItem("topScore"), 10);
var currentScore = 0;
if (isNaN(topScore)) {
    topScore = 0; 
}
function setTopScore(score) {
    localStorage.setItem("topScore", score);
}

document.addEventListener("mousemove", (event) => {
    const selectedPopUp = document.querySelector(".selectedPopUp");
    if (selectedPopUp && selectedPopUp.style.display === 'flex') {
        return;
    }
    const leftOption = document.querySelector(".leftOption");
    const rightOption = document.querySelector(".rightOption");
    const leftText = leftOption.querySelector("p");
    const rightText = rightOption.querySelector("p");
  
    const mouseX = event.clientX / window.innerWidth;
  
    const rightWidth = 50 + (mouseX - 0.5) * 20;
    const leftWidth = 100 - rightWidth;
  
    leftOption.style.flex = leftWidth;
    rightOption.style.flex = rightWidth;
    

    const baseSize = 1;
    const maxIncrease = 1;
    
    const leftTextSize = baseSize + maxIncrease * (1 - mouseX);
    const rightTextSize = baseSize + maxIncrease * mouseX;
    
    leftText.style.fontSize = `${leftTextSize}rem`;
    rightText.style.fontSize = `${rightTextSize}rem`;
  });

  async function fetchNewOptions() {
    try {
        const tableName = new URLSearchParams(window.location.search).get('table_name');
        const response = await fetch(`../Skrypty/PHP/random_records.php?table_name=${tableName}`);
        const data = await response.json();

        if (data.error) {
            console.error(data.error);
            return;
        }

        const leftOptionElement = document.querySelector('.leftOption');
        const rightOptionElement = document.querySelector('.rightOption');

        leftOptionElement.querySelector('p').textContent = data.left.name;
        rightOptionElement.querySelector('p').textContent = data.right.name;

        leftOptionElement.dataset.value = parseFloat(data.left.data);
        rightOptionElement.dataset.value = parseFloat(data.right.data);

    } catch (error) {
        console.error("Błąd podczas pobierania nowych opcji:", error);
    }
}

const newRecordMessage = document.createElement('h3');
newRecordMessage.textContent = 'Nowy rekord!';
function gameOver(){
    document.querySelector(".selectedPopUp").style.display = 'flex';
    if(currentScore>topScore){
        setTopScore(currentScore);
        document.querySelector('.scoreInfo').appendChild(newRecordMessage);
        topScore = currentScore;
      }
    document.getElementById("currentScore").textContent = "Wynik: " + currentScore;
    document.getElementById("topScore").textContent = "Najlepszy wynik: " + topScore;
    
}
function playAgain(){
    document.querySelector(".selectedPopUp").style.display = 'none';
    newRecordMessage.remove();
    fetchNewOptions();

}
function exit(){
    window.location.href = "../index/index.php"
}

function returnButton(){
    if(currentScore==0){
        window.location.href = "../index/index.php"
    }
    else{
        gameOver()
    }
}

function handleChoice(selectedOption) {
  const otherOption = selectedOption.classList.contains('leftOption')
      ? document.querySelector('.rightOption')
      : document.querySelector('.leftOption');


  const selectedValue = parseFloat(selectedOption.dataset.value);
  const otherValue = parseFloat(otherOption.dataset.value);

  if (selectedValue > otherValue || selectedValue == otherValue) {
      currentScore++;
      document.querySelector('.currentScore p').textContent = currentScore;
      fetchNewOptions();
  } 
   else {
      gameOver();
      currentScore = 0;
      document.querySelector('.currentScore p').textContent = currentScore;
  }

}
document.querySelector('.returnButton').addEventListener('click', () => returnButton())
document.querySelector('.leftOption').addEventListener('click', () => handleChoice(document.querySelector('.leftOption')));
document.querySelector('.rightOption').addEventListener('click', () => handleChoice(document.querySelector('.rightOption')));
document.addEventListener("DOMContentLoaded", (event) => {
  fetchNewOptions();
});
