document.querySelector('#button1').addEventListener('click', function() {
    document.querySelector('#box2').style.display = 'none';
    document.querySelector('#box3').style.display = 'none';
    document.querySelector('#box1').style.display = 'block';
});

document.querySelector('#button2').addEventListener('click', function() {
    document.querySelector('#box1').style.display = 'none';
    document.querySelector('#box3').style.display = 'none';
    document.querySelector('#box2').style.display = 'block';
});

document.querySelector('#button3').addEventListener('click', function() {
    document.querySelector('#box1').style.display = 'none';
    document.querySelector('#box2').style.display = 'none';
    document.querySelector('#box3').style.display = 'block';
});