document.addEventListener('DOMContentLoaded', function() {
  let elems = document.querySelectorAll('.modal');
  let options = {
      inDuration: 300
  }
  let  instances = M.Modal.init(elems, options);
});


document.addEventListener('DOMContentLoaded', function() {
let elems = document.querySelectorAll('select');
let options = {
      inDuration: 300
  }
let instances = M.FormSelect.init(elems, options);
});

function tableSearch() {
let phrase = document.getElementById('search-text');
let table = document.getElementById('info-table');
let regPhrase = new RegExp(phrase.value, 'i');
let flag = false;
for (let i = 1; i < table.rows.length; i++) {
  flag = false;
  for (let j = table.rows[i].cells.length - 1; j >= 0; j--) {
      flag = regPhrase.test(table.rows[i].cells[j].innerHTML);
      if (flag) break;
  }
  if (flag) {
      table.rows[i].style.display = "";
  } else {
      table.rows[i].style.display = "none";
  }

}
}
document.querySelector("#reset").onclick = function(){
let phrase = document.getElementById('search-text');
phrase.value="";
tableSearch();
}