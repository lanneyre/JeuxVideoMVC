// alert("c'est du grand n'importe quoi !");
window.addEventListener("load", function(){
    if(document.location.pathname === "/initPHP/Jeux/index.php" || document.location.pathname === "/initPHP/Jeux/"){
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
    }

    $("#Jeux_DateSortie").datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        showButtonPanel: true,
        dateFormat: "yy-mm-dd"
      });
});   