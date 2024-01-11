if (window.matchMedia('(max-width: 600px)').matches) {
  document.addEventListener("DOMContentLoaded", function() {
    const currentDate = new Date();
    var currentDayIndex = currentDate.getDay();
    currentDayIndex = (currentDayIndex === 0) ? 6 : currentDayIndex - 1;

    const arrowLeft = document.getElementById('arrow_left');
    const arrowRight = document.getElementById('arrow_right');
    const daysContainer = document.querySelector('.days');
    const days = document.querySelectorAll('.day');


    document.querySelectorAll('.day').forEach(function(day) {
        day.style.display = 'none';
    });
    document.querySelector('#day' + currentDayIndex).style.display = 'block';


    arrowLeft.addEventListener('click', function() {
        currentDayIndex--;


        if (currentDayIndex < 0) {
            currentDayIndex = 4;
        }

        console.log(currentDayIndex);


        document.querySelectorAll('.day').forEach(function(day) {
            day.style.display = 'none';
        });
        document.querySelector('#day' + currentDayIndex).style.display = 'block';

    });

    arrowRight.addEventListener('click', function() {
        currentDayIndex++;


        if (currentDayIndex >=5 ) {
            currentDayIndex = 0;
        }

        console.log(currentDayIndex);

        document.querySelectorAll('.day').forEach(function(day) {
            day.style.display = 'none';
        });
        document.querySelector('#day' + currentDayIndex).style.display = 'block';

    });
  });
}