var timerID = null;
var timerRunning = false;
function stopclock() {
        if(timerRunning)
                clearTimeout(timerID);
        timerRunning = false;
}
function showtime() {
	var now = new Date();
	var month=MonthName(now.getMonth());
	var week=WeekDayName(now.getDay());
	/****************************************************************/
	var today=week+" "+now.getDate()+" "+month+", "+now.getYear();
	/****************************************************************/
	var hours = now.getHours();
	var minutes = now.getMinutes();
	var seconds = now.getSeconds()
	var timeValue = "" + ((hours >12) ? hours -12 :hours)
	timeValue += ((minutes < 10) ? ":0" : ":") + minutes
	timeValue += ((seconds < 10) ? ":0" : ":") + seconds
	timeValue += (hours >= 12) ? " P.M." : " A.M."
	var TotalDate="Today : "+today+" "+timeValue;
	window.document.getElementById('showDate').innerHTML = TotalDate;
	timerID = setTimeout("showtime()",1000);
	timerRunning = true;
}
function startclock() {
	stopclock();
    showtime();
}
function MonthName(MonthNumber) {
	var i;
	var MonthFullName;
	var Month=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
	for(i=0;i<=11;i++) {
		if(MonthNumber==i) {
			MonthFullName=Month[i];
			return MonthFullName;
		}
	}
}
function WeekDayName(WeekDayNumber) {
	var j;
	var Week=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
	for(j=0;j<=6;j++) {
		if(WeekDayNumber==j) {
			WeekDayFullName=Week[j];
			return WeekDayFullName;
		}
	}
}
window.onload=startclock;