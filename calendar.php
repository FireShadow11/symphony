<?php
    require "includes/dbh.inc.php";
    session_start();    
    //echo $s_content;
      require "header.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Calendar</title>
    
    <link rel="stylesheet" href="style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    

  </head>
  <body id = "general">
    <p id = 'calendar-text'>Click on any day of this calendar to show your tasks for that week!</p>
    <div class="calendar-container">
      <div class="calendar">
        <div class="month">
          <i class="fas fa-angle-left prev"></i>
          <div class="date">
            <h1></h1>
            <p></p>
          </div>
          <i class="fas fa-angle-right next"></i>
        </div>
        <div class="weekdays">
          <div>Sun</div>
          <div>Mon</div>
          <div>Tue</div>
          <div>Wed</div>
          <div>Thu</div>
          <div>Fri</div>
          <div>Sat</div>
        </div>
        <div class="days"></div>
      </div>
    </div>
    
    <table class = "weekly-list">
      <tr id = "days">
          <th height = 80 class = "t1"></th>
          <th height = 80 class = "t1">Sunday<br><div id = "sun_date"></div></th>
          <th height = 80 class = "t1">Monday<br><div id = "mon_date"></div></th>
          <th height = 80 class = "t1">Tuesday<br><div id = "tues_date"></div></th>
          <th height = 80 class = "t1">Wednesday<br><div id = "wed_date"></div></th>
          <th height = 80 class = "t1">Thursday<br><div id = "thur_date"></div></th>
          <th height = 80 class = "t1">Friday<br><div id = "fri_date"></div></th>
          <th height = 80 class = "t1">Saturday<br><div id = "sat_date"></div></th>
      </tr>
      <tr id = 'routine'>
          <th class = "t1">Events:</th>
          <td id = 'sunday' class = "t1"></td>
          <td id = 'monday' class = "t1"></td>
          <td id = 'tuesday' class = "t1"></td>
          <td id = 'wednesday' class = "t1"></td>
          <td id = 'thursday' class = "t1"></td>
          <td id = 'friday' class = "t1"></td>
          <td id = 'saturday' class = "t1"></td>           
      </tr>
    </table>
          <button id="edit-content">Click here to edit the calendar!</button>
            
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
          <script type="text/javascript" src="script.js"></script> <!-- This needs to be here because all the html elements in this js file are defined at this point but all of them are being changed in the next !-->
          
        <!--<p id = "test">Gcervctr</p>!-->

        <script>
          window.onload = function() {
          
          if(localStorage.getItem('sunday')) {
            document.querySelector('#sunday').innerHTML = localStorage.getItem('sunday');
          }

          if(localStorage.getItem('monday')) {
            document.querySelector('#monday').innerHTML = localStorage.getItem('monday');
          }

          if(localStorage.getItem('tuesday')) {
            document.querySelector('#tuesday').innerHTML = localStorage.getItem('tuesday');
          }

          if(localStorage.getItem('wednesday')) {
            document.querySelector('#wednesday').innerHTML = localStorage.getItem('wednesday');
          }

          if(localStorage.getItem('thursday')) {
            document.querySelector('#thursday').innerHTML = localStorage.getItem('thursday');
          }

          if(localStorage.getItem('friday')) {
            document.querySelector('#friday').innerHTML = localStorage.getItem('friday');
          }

          if(localStorage.getItem('saturday')) {
            document.querySelector('#saturday').innerHTML = localStorage.getItem('saturday');
          }



        }

        //These retrieve content of the edit button and the editable part of the week calendar
        var editBtn = document.querySelector('#edit-content');
        var sunday = document.querySelector('#sunday');
        var monday = document.querySelector('#monday');
        var tuesday = document.querySelector('#tuesday');
        var wednesday = document.querySelector('#wednesday');
        var thursday = document.querySelector('#thursday');
        var friday = document.querySelector('#friday');
        var saturday = document.querySelector('#saturday');

        var sun = document.querySelector('#sun_date');
        var mon = document.querySelector('#mon_date');
        var tues = document.querySelector('#tues_date');
        var wed = document.querySelector('#wed_date');
        var thur = document.querySelector('#thur_date');
        var fri = document.querySelector('#fri_date');
        var sat = document.querySelector('#sat_date');
       

        editBtn.addEventListener('click', () => {
          if(document.getElementById("sun_date").innerHTML == ""){
            alert("Please select a week");
          }
          else{
            // Toggle contentEditable on button click
            sunday.contentEditable = !sunday.isContentEditable;
            monday.contentEditable = !monday.isContentEditable;
            tuesday.contentEditable = !tuesday.isContentEditable;
            wednesday.contentEditable = !wednesday.isContentEditable;
            thursday.contentEditable = !thursday.isContentEditable;
            friday.contentEditable = !friday.isContentEditable;
            saturday.contentEditable = !saturday.isContentEditable;
            
            
            // If disabled, save text
            if(sunday.contentEditable === 'false') {
              localStorage.setItem('sunday', sunday.innerHTML);
              localStorage.setItem('monday', monday.innerHTML);
              localStorage.setItem('tuesday', tuesday.innerHTML);
              localStorage.setItem('wednesday', wednesday.innerHTML);
              localStorage.setItem('thursday', thursday.innerHTML);
              localStorage.setItem('friday', friday.innerHTML);
              localStorage.setItem('saturday', saturday.innerHTML);

              //stores the dates
              localStorage.setItem('sun', sun.innerHTML);
              localStorage.setItem('mon', mon.innerHTML);
              localStorage.setItem('tues', tues.innerHTML);
              localStorage.setItem('wed', wed.innerHTML);
              localStorage.setItem('thur', thur.innerHTML);
              localStorage.setItem('fri', fri.innerHTML);
              localStorage.setItem('sat', sat.innerHTML);
            }

            if(document.getElementById("edit-content").innerHTML == "Finish Editing"){ //problem is that it doesn't have local storage ready to go until you press it again
              document.getElementById("edit-content").innerHTML = "Edit";

              $.post('includes/calendar.inc.php', {
                sunday:localStorage.getItem('sunday'), 
                monday:localStorage.getItem('monday'), 
                tuesday:localStorage.getItem('tuesday'), 
                wednesday:localStorage.getItem('wednesday'), 
                thursday:localStorage.getItem('thursday'), 
                friday:localStorage.getItem('friday'), 
                saturday:localStorage.getItem('saturday'),

                sun:document.getElementById("sun_date").innerHTML,
                mon:document.getElementById("mon_date").innerHTML,
                tues:document.getElementById("tues_date").innerHTML,
                wed:document.getElementById("wed_date").innerHTML,
                thur:document.getElementById("thur_date").innerHTML,
                fri:document.getElementById("fri_date").innerHTML,
                sat:document.getElementById("sat_date").innerHTML
              })
            }
            else if(document.getElementById("edit-content").innerHTML == "Edit" || document.getElementById("edit-content").innerHTML == "Click here to edit the calendar!"){
              document.getElementById("edit-content").innerHTML = "Finish Editing";              
            } 
          }
        });
                
        //when you logout the local storage is cleared
        document.getElementById("bt2").onclick = function() {myFunction()};
        function myFunction() {
          localStorage.clear();
        }
        </script>
  
  </body>
</html>

