document.querySelector('.weekly-list').style.visibility = 'hidden';
document.querySelector('#edit-content').style.visibility = 'hidden';
const date = new Date();

const renderCalendar = () => {
  date.setDate(1);

  const monthDays = document.querySelector(".days");

  const lastDay = new Date(
    date.getFullYear(),
    date.getMonth() + 1,
    0
  ).getDate();

  const prevLastDay = new Date(
    date.getFullYear(),
    date.getMonth(),
    0
  ).getDate();

  const firstDayIndex = date.getDay();//first day of the month

  const lastDayIndex = new Date(
    date.getFullYear(),
    date.getMonth() + 1,
    0
  ).getDay();//last day of current month

  const nextDays = 7 - lastDayIndex - 1;

  const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];

  document.querySelector(".date h1").innerHTML = months[date.getMonth()] + " " + date.getFullYear();

  document.querySelector(".date p").innerHTML = "Today is " + new Date().toDateString();

  let days = "";

  for (let x = firstDayIndex; x > 0; x--) {
    days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDay; i++) {
    if (
      i === new Date().getDate() &&
      date.getMonth() === new Date().getMonth()
    ) {
      days += `<div class="today">${i}</div>`;
    } else {
      days += `<div class = "days-of-month">${i}</div>`;
    }
  }

  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="next-date">${j}</div>`;
  }

  monthDays.innerHTML = days;
 

  function getSunday(d) {
    d = new Date(d);
    var day = d.getDay(),
        diff = d.getDate() - day; // adjust when day is sunday
    return new Date(d.setDate(diff));
  }

  function isPrevNextDate(date) {
    if(date.classList.contains("prev-date")){
      return -1;
    }
    else if(date.classList.contains("next-date")){
      return 1;
    }
    else{
      return 0;
    }
  }

  /*This part will change the dates in the week according to where you click on the calendar*/

  var collection = document.querySelectorAll(".days-of-month, .prev-date, .today, .next-date");
  const collection_array = [];
  for(let j = 0; j< collection.length; j++){
    collection_array.push(collection[j].innerHTML);
  }
  
  for(let i = 0; i < collection.length; i++){
    collection[i].addEventListener("click", () => {
      document.querySelector('.weekly-list').style.visibility = 'visible';
      document.querySelector('#edit-content').style.visibility = 'visible';

      let chosen_day = new Date();
      
      if(collection[i].classList.contains("prev-date")){
        chosen_day = new Date(date.getFullYear(), date.getMonth()-1, collection[i].innerHTML);
        
      }
      else if(collection[i].classList.contains("next-date")){
        chosen_day = new Date(date.getFullYear(), date.getMonth()+1, collection[i].innerHTML);
      }
      else{
        chosen_day = new Date(date.getFullYear(), date.getMonth(), collection[i].innerHTML);
      }
      

      let sundate = String(getSunday(chosen_day).getDate());

      //Changes the dates for the weekly calendar
      document.getElementById("sun_date").innerHTML = 
      (date.getMonth() + 1 + isPrevNextDate(collection[(collection_array.indexOf(sundate))])) + "/" + (collection[(collection_array.indexOf(sundate))].innerHTML);
      document.getElementById("mon_date").innerHTML =
       (date.getMonth() + 1 + isPrevNextDate(collection[(collection_array.indexOf(sundate))+1])) + "/" + (collection[(collection_array.indexOf(sundate))+1].innerHTML);
      document.getElementById("tues_date").innerHTML = (date.getMonth() + 1 + isPrevNextDate(collection[(collection_array.indexOf(sundate))+2])) + "/" + (collection[(collection_array.indexOf(sundate))+2].innerHTML);
      document.getElementById("wed_date").innerHTML = (date.getMonth() + 1 + isPrevNextDate(collection[(collection_array.indexOf(sundate))+3])) + "/" + (collection[(collection_array.indexOf(sundate))+3].innerHTML);
      document.getElementById("thur_date").innerHTML = (date.getMonth() + 1 + isPrevNextDate(collection[(collection_array.indexOf(sundate))+4])) + "/" + (collection[(collection_array.indexOf(sundate))+4].innerHTML);
      document.getElementById("fri_date").innerHTML = (date.getMonth() + 1 + isPrevNextDate(collection[(collection_array.indexOf(sundate))+5])) + "/" + (collection[(collection_array.indexOf(sundate))+5].innerHTML);
      document.getElementById("sat_date").innerHTML = (date.getMonth() + 1 + isPrevNextDate(collection[(collection_array.indexOf(sundate))+6])) + "/" + (collection[(collection_array.indexOf(sundate))+6].innerHTML);

      var sunday = document.getElementById("sun_date").innerHTML;
      $.ajax({
          type: 'post',
          url: 'includes/calendar.dec.php',
          data: {ajax: 1,sunday: sunday},
          success: function(response){              
              let index = response.search("<!DOCTYPE");
              var div = document.createElement("div");
              div.innerHTML = response.slice(0, index);
              response = div.innerText;
              $('#test').text(response);
              console.log(response);
              let content = response.substring(1, response.length-1).split(",");
              for(let i = 0; i < content.length; i++){
                content[i] = content[i].replace(/"|'/g, '');
              }
              console.log(content);
              document.getElementById("sunday").innerHTML = content[0];
              document.getElementById("monday").innerHTML = content[1];
              document.getElementById("tuesday").innerHTML = content[2];
              document.getElementById("wednesday").innerHTML = content[3];
              document.getElementById("thursday").innerHTML = content[4];
              document.getElementById("friday").innerHTML = content[5];
              document.getElementById("saturday").innerHTML = content[6];
          }
      });
    });
  } 
};

document.querySelector(".prev").addEventListener("click", () => {
  date.setMonth(date.getMonth() - 1);
  renderCalendar();
});

document.querySelector(".next").addEventListener("click", () => {
  date.setMonth(date.getMonth() + 1);
  renderCalendar();
});

renderCalendar();