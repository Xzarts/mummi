window.onload = oppdater;

function oppdater() {

   const clickHandler = function () {
        this.style.color = 
          this.style.color != this.dataset.activeColor ?
          this.dataset.activeColor :
          this.dataset.disabledColor;
          const aColor = this.dataset.activeColor;
          localStorage.setItem('saveColor', aColor);
          localStorage.getItem('saveColor');
          const colorValue = localStorage.getItem('saveColor');
          console.log(colorValue);
         
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