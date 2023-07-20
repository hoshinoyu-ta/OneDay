'use strict';

// JavaScriptファイル内でデータを取得
const events = JSON.parse(document.currentScript.getAttribute('data-events'));
console.log(events)
const week = ["日", "月", "火", "水", "木", "金", "土"];
const today = new Date();
// 月末だとずれる可能性があるため、1日固定で取得
let showDate = new Date(today.getFullYear(), today.getMonth(), 1);

// 初期表示
window.onload = function() {
  showProcess(showDate);
  hideEventText();
};

// 前の月表示
function prev() {
  showDate.setMonth(showDate.getMonth() - 1);
  showProcess(showDate);
}

// 次の月表示
function next() {
  showDate.setMonth(showDate.getMonth() + 1);
  showProcess(showDate);
}

// カレンダー表示
function showProcess(date) {
  let year = date.getFullYear();
  let month = date.getMonth();
  document.querySelector('#header').innerHTML = year + "年 " + (month + 1) + "月";

  let calendar = createProcess(year, month);
  document.querySelector('#calendar').innerHTML = calendar;

  // イベントの登録
  registerEvents();
  hideEventText();
}

// カレンダー作成
function createProcess(year, month) {
  // 曜日
  let calendar = "<table><tr class='dayOfWeek'>";
  for (let i = 0; i < week.length; i++) {
    calendar += "<th>" + week[i] + "</th>";
  }
  calendar += "</tr>";

  let count = 0;
  let startDayOfWeek = new Date(year, month, 1).getDay();
  let endDate = new Date(year, month + 1, 0).getDate();
  let lastMonthEndDate = new Date(year, month, 0).getDate();
  let row = Math.ceil((startDayOfWeek + endDate) / week.length);

  // 1行ずつ設定
for (let i = 0; i < row; i++) {
  calendar += "<tr>";
  // 1colum単位で設定
  for (let j = 0; j < week.length; j++) {
    if (i == 0 && j < startDayOfWeek) {
      // 1週目の前月の日付を設定
      calendar += "<td class='disabled'>" + (lastMonthEndDate - startDayOfWeek + j + 1) + "</td>";
    } else if (count >= endDate) {
      // 最終行で翌月の日付を設定
      count++;
      calendar += "<td class='disabled'>" + (count - endDate) + "</td>";
    } else {
      // 当月の日付を曜日に照らし合わせて設定
      count++;
      const cellDate = new Date(year, month, count);
      // events 配列から、現在の日付セルに対応するイベントをすべて取得するための処理
      const eventsOnDate = events.filter(event => {
        const eventDate = new Date(event.created);
        return (
          eventDate.getFullYear() === cellDate.getFullYear() &&
          eventDate.getMonth() === cellDate.getMonth() &&
          eventDate.getDate() === cellDate.getDate()
        );
      });
      // 当日のイベント
      if (year == today.getFullYear() && month == today.getMonth() && count == today.getDate()) {
        calendar += "<td class='today'>" + count + "<br>";
        for (let k = 0; k < eventsOnDate.length; k++) {
          const event = eventsOnDate[k];
          calendar += "<span class='event-text'>" + event.text + "</span><br>";
        }
        calendar += "</td>";
      } else if (eventsOnDate.length > 0) {
        // イベントがある場合は、すべてのイベントを表示する
        calendar += "<td class='event'>" + count;
        for (let k = 0; k < eventsOnDate.length; k++) {
          const event = eventsOnDate[k];
          calendar += "<span class='event-text'>" + event.text + "</span>";
        }
        calendar += "</td>";
      } else {
        // ここに原因がある気がする？
        calendar += "<td>" + count + "</td>";
      }
    }
  }
  calendar += "</tr>";
}
  return calendar;
}

// イベントの登録
function registerEvents() {
  const calendarCells = document.querySelectorAll('#calendar td.event,#calendar td.today');
  calendarCells.forEach((cell, index) => {
    cell.addEventListener("mouseover", function() {
      showEventText(cell);
    });
    cell.addEventListener("mouseout", hideEventText);
  });
}

// イベント内容を表示
function showEventText(cell) {
  const texts = cell.querySelectorAll(".event-text");
  texts.forEach(text => {
    text.style.display = "block";
  });
}

// イベント内容を非表示
function hideEventText() {
  const texts = document.querySelectorAll(".event-text");
  texts.forEach(text => {
    text.style.display = "none";
  });
}

// イベントの登録
registerEvents();
