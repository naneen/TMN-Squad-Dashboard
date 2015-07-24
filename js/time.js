function getCorrectTime(){
    var date = new Date();
    var time = "";
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();
    time += ((hours<10)? ("0" + hours):hours) + ":";
    time += ((minutes<10)? ("0" + minutes):minutes) + ":";
    time += ((seconds<10)? ("0" + seconds):seconds);
    return time;
}

function getYear(){
    var date = new Date();
    var year = date.getFullYear();
    return year;
}