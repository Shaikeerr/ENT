let on_off = false;

function burger() {
    if (on_off === false) {
        var image = document.querySelector('.burger')
        image.src = "images/cross.png";
        document.querySelector('nav').style.flexDirection = "column";
        document.querySelector('nav').style.width = "40%";
        document.querySelector('nav').style.height = "100vh";
        document.querySelector('nav').style.alignItems = "center";
        document.querySelector('nav').style.right = "0";
        document.querySelector('.nav-links').style.display= "flex";
        document.querySelector('.nav-links').style.flexDirection = "column";
        document.querySelector('.nav-links').style.alignItems = "center";
        document.querySelector('.nav-links').style.justifyContent = "center";
        document.querySelector('.nav-links').style.paddingRight = "0";
        document.querySelector('.burger').style.marginLeft = "60%";
        document.querySelectorAll('.nav-item') .forEach(item => item.style.marginBottom = "20px");
        document.querySelector('.logo').style.display = "none";
        document.querySelector('.burger').style.paddingRight = "0";
        document.querySelector('.burger').style.marginTop = "20%";
        on_off = true;
    } else {
        var image = document.querySelector('.burger')
        image.src = "images/burger_icon.png";
        document.querySelector('nav').style.flexDirection = "row";
        document.querySelector('nav').style.width = "100%";
        document.querySelector('nav').style.height = "auto";
        document.querySelector('nav').style.alignItems = "center";
        document.querySelector('nav').style.right = "0";
        document.querySelector('.nav-links').style.display= "none";
        document.querySelectorAll('.nav-item') .forEach(item => item.style.marginBottom = "0");
        document.querySelector('.logo').style.display = "block";
        document.querySelector('.burger').style.marginTop = "0";
        document.querySelector('.burger').style.marginRight = "20px";
        document.querySelector('.burger').style.marginLeft = "0";

        on_off = false;
    }
}

document.querySelector('.burger').addEventListener('click', burger);


