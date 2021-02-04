// alert("c'est du grand n'importe quoi !");

window.addEventListener("load", function(){
    // alert("c'est du grand n'importe quoi !");
    var fieldsets = document.querySelectorAll(".liste > fieldset");
    fieldsets.forEach(field => {
        field.addEventListener("mouseover", function(){
            var dataTarget = this.getAttribute("data-target");
            document.querySelectorAll(".imagesJeux > img").forEach(element => {
                element.style.display = "none";
            });
            document.getElementById(dataTarget).style.display = "block";
        });
        field.addEventListener("mouseout", function(){
            document.querySelectorAll(".imagesJeux > img").forEach(element => {
                element.style.display = "none";
            }); 
        });
    });
});