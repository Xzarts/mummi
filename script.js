window.onload = oppdater;

function oppdater() {

   const clickHandler = function () {
        this.style.color = 
          this.style.color != this.dataset.activeColor ?
          this.dataset.disabledColor :
          this.dataset.activeColor;       
      };

    
    
    for (const element of document.querySelectorAll(".active-color-aware")) {
      element.onclick = clickHandler;
    }



// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
const modalImg = document.getElementById("img01");
const captionText = document.getElementById("caption");
const clickPictures = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}
for (const allImg of document.querySelectorAll(".main_container img")) {
  allImg.onclick = clickPictures;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var closeSpan = document.getElementById("myModal");

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
   
}
closeSpan.onclick = function() {
  modal.style.display = "none";
}

}


const currentState = JSON.parse(localStorage.getItem("selectionState") || '{}');


const getKeyType = el => {
  return [el.parentNode.id, el.dataset.type];
  
}

const populateState = el => {
  [key, type] = getKeyType(el);

  el.style.color = currentState[key][type] ? el.dataset.activeColor : el.dataset.disabledColor;
};


const clickity = function () {
  [key, type] = getKeyType(this);
  
  if (!currentState.hasOwnProperty(key)) {
    currentState[key] = {type: false};
  }
  
  currentState[key][type] = !currentState[key][type];
  populateState(this);
  
  localStorage.setItem("selectionState", JSON.stringify(currentState));
}

const startCode = document.querySelectorAll("i");

for (const startCod of startCode) {
  startCod.addEventListener('click', clickity);
}

const buttons = document.querySelectorAll("i");

for (const button of buttons) {
  populateState(button);
  button.addEventListener('click', clickity);
  
}
