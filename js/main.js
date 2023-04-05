"use strict"

/*Contador de días para que empiece el Mundial*/

let end = new Date('11/20/2022');

    let _second = 1000;
    let _minute = _second * 60;
    let _hour = _minute * 60;
    let _day = _hour * 24;
    let timer;

    function showRemaining() {
        let now = new Date();
        let distance = end - now;
        if (distance < 0) {

            clearInterval(timer);
            document.querySelector('#countdown').innerHTML = 'EXPIRED!';

            return;
        }
        let days = Math.floor(distance / _day);
        let hours = Math.floor((distance % _day) / _hour);
        let minutes = Math.floor((distance % _hour) / _minute);
        let seconds = Math.floor((distance % _minute) / _second);

        document.querySelector('#countdown').innerHTML = days;
    }

    timer = setInterval(showRemaining, 1000);