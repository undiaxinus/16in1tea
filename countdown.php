<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>

</head>
<body>
	<style type="text/css">


* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}


.container1 {
	height: 50%;
	background-color: darkred;
  color: white;
  margin: 0 auto;
  text-align: center;
  position: fixed;
      bottom: 0;
       z-index: 999;
}

h4 {
  font-weight: normal;
  letter-spacing: 0.125rem;
  text-transform: uppercase;
}

li {
  display: inline-block;
  font-size: 20px;
  list-style-type: none;
  padding: 1em;
  text-transform: uppercase;
}

li span {
  display: block;
  font-size: 4.5rem;
}



@media all and (max-width: 768px) {
  h4 {
    font-size: calc(1.5rem * var(--smaller));
  }

  li {
   font-size: 14px;
  }

  li span {
    font-size: calc(3.375rem * var(--smaller));
  }
}

</style>
 <script type="text/javascript">
        (function () {
            const second = 1000,
                minute = second * 60,
                hour = minute * 60,
                day = hour * 24,
                endOfDay = new Date();
            
            // Set endOfDay to the next day at midnight
            endOfDay.setDate(endOfDay.getDate() + 1);
            endOfDay.setHours(0, 0, 0, 0);

            const countDown = endOfDay.getTime();
            
            const x = setInterval(function () {
                const now = new Date().getTime(),
                    distance = countDown - now;

                document.getElementById("days").innerText = Math.floor(distance / day);
                document.getElementById("hours").innerText = Math.floor((distance % day) / hour);
                document.getElementById("minutes").innerText = Math.floor((distance % hour) / minute);
                document.getElementById("seconds").innerText = Math.floor((distance % minute) / second);

                // do something later when date is reached
                if (distance < 0) {
                    document.getElementById("headline").innerText = "Promo has ended!";
                    document.getElementById("countdown").style.display = "none";
                    clearInterval(x);
                }
                // seconds
            }, 0);
        })();
    </script>
  <div class="container1" style="height: 130px; width: 100%;">
    <h4 id="headline" style="padding-bottom: 0%; color: white;">Promo ends</h4>
    <div id="countdown">
      <ul >
      	<li style="padding-top: 0%;"><span id="days" style="font-size: 30px;"></span>days</li>
        <li style="padding-top: 0%;"><span id="hours" style="font-size: 30px;"></span>Hours</li>
        <li style="padding-top: 0%;"><span id="minutes" style="font-size: 30px;"></span>Minutes</li>
        <li style="padding-top: 0%;"><span id="seconds" style="font-size: 30px;"></span>Seconds</li>
      </ul>
    </div>
  </div>
</body>
</html>