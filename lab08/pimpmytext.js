function onClickHandler() {
  //   alert("Hello, world!");
  var font = document.getElementById("textarea");
  setInterval(() => {
    if (font.style.fontSize === "") {
      font.style.fontSize = "12pt";
    } else {
      font.style.fontSize = `${parseInt(font.style.fontSize) + 2}pt`;
    }
  }, 500);
}

function onchangeHandler() {
  alert("test");
  var checkbox = document.getElementById("checkbox");
  var textarea = document.getElementById("textarea");
  if (checkbox.checked) {
    textarea.style.fontWeight = "bold";
    textarea.style.color = "green";
    textarea.style.textDecoration = "underline solid";
    textarea.style.backgroundImage = "url(https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/8/hundred.jpg)"
  } else {
    textarea.style.fontWeight = "normal";
    textarea.style.color = "black";
    textarea.style.textDecoration = "none";
  }
}

function snoopify() {
  var textarea = document.getElementById("textarea");
  textarea.value = textarea.value.toUpperCase();
  var texts = textarea.value.split(".");
  textarea.value = texts.join("-izzle.");
}
