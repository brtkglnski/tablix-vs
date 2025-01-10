document.addEventListener("mousemove", (event) => {
    const mainGameLayout = document.querySelector(".mainGameLayout");
    const leftOption = document.querySelector(".leftOption");
    const rightOption = document.querySelector(".rightOption");
  
    const mouseX = event.clientX / window.innerWidth;
  
  
    const rightWidth = 50 + (mouseX - 0.5) * 20;
    const leftWidth = 100 - rightWidth;
  
    leftOption.style.flex = leftWidth;
    rightOption.style.flex = rightWidth;
  });



