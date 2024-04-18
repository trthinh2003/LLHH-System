const date = new Date();

const renderCalendar = () => {
  date.setDate(1);

  const monthDays = document.querySelector(".days");

  const lastDay = new Date(
    date.getFullYear(),
    date.getMonth()+1,
    0
  ).getDate();

  const prevLastDay = new Date(
    date.getFullYear(),
    date.getMonth(),
    0
  ).getDate();

  const firstDayIndex = date.getDay();

  const lastDayIndex = new Date(
    date.getFullYear(),
    date.getMonth() + 1,
    0
  ).getDay();

  const nextDays = 7 - lastDayIndex - 1;

  const months = [
    "Tháng 1",
    "Tháng 2",
    "Tháng 3",
    "Tháng 4",
    "Tháng 5",
    "Tháng 6",
    "Tháng 7",
    "Tháng 8",
    "Tháng 9",
    "Tháng 10",
    "Tháng 11",
    "Tháng 12",
  ]

  document.querySelector('.content h1').innerHTML = months[date.getMonth()];
  document.querySelector('.content p').innerHTML = new Date().toDateString();

  let days = "";

  for (let x = firstDayIndex; x>0;x--){
    days += `<div class="previous-day">${prevLastDay - x + 1}</div>`
  }

  for (let i = 1; i <= lastDay; i++){
    if(i===new Date().getDate() && date.getMonth() === new Date().getMonth()){
      days += `<div class="today">${i}</div>`
    } else {
      days += `<div class="">${i}</div>`
    }
  }

  for(let j = 1; j <= nextDays; j++){
    days += `<div class="next-days">${j}</div>`
    monthDays.innerHTML = days;
  }
};

document.querySelector('.prev').addEventListener('click', () => {
  date.setMonth(date.getMonth() - 1);
  renderCalendar();
})

document.querySelector('.next').addEventListener('click', () => {
  date.setMonth(date.getMonth() + 1);
  renderCalendar();
})

renderCalendar();