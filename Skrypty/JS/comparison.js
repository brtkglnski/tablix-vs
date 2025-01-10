document.addEventListener("mousemove", (event) => {
    const mainGameLayout = document.querySelector(".mainGameLayout");
    const leftOption = document.querySelector(".leftOption");
    const rightOption = document.querySelector(".rightOption");
    const leftText = leftOption.querySelector("p");
    const rightText = rightOption.querySelector("p");
  
    const mouseX = event.clientX / window.innerWidth;
  
  
    const rightWidth = 50 + (mouseX - 0.5) * 20;
    const leftWidth = 100 - rightWidth;
  
    leftOption.style.flex = leftWidth;
    rightOption.style.flex = rightWidth;
    

    const baseSize = 2;
    const maxIncrease = 2.5;
    
    const leftTextSize = baseSize + maxIncrease * (1 - mouseX);
    const rightTextSize = baseSize + maxIncrease * mouseX;
    
    leftText.style.fontSize = `${leftTextSize}rem`;
    rightText.style.fontSize = `${rightTextSize}rem`;
  });


