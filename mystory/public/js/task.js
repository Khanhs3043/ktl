
document.addEventListener('DOMContentLoaded', () => {
const type1 = document.querySelector('.type1');
const type2 = document.querySelector('.type2');
const type3 = document.querySelector('.type3');
const type4 = document.querySelector('.type4');
const type5 = document.querySelector('.type5');
const tbl1 = document.querySelector('.task-tbl1');
const tbl2 = document.querySelector('.task-tbl2');
const tbl3 = document.querySelector('.task-tbl3');
const tbl4 = document.querySelector('.task-tbl4');
const tbl5 = document.querySelector('.task-tbl5');
const tables = document.querySelectorAll('.task-tbl');
const options = document.querySelectorAll('.task-type');
console.log(tables);
tbl1.style.display = 'table';
type1.classList.add('selected');
type1.onclick = function(){
    options.forEach(option => {
        option.classList.remove('selected');
    });
    tables.forEach(table =>{ 
        table.style.display = 'none';
    });
    tbl1.style.display = 'table';
    type1.classList.add('selected');
};
type2.onclick = function(){
    options.forEach(option => {
        option.classList.remove('selected');
    });
    tables.forEach(table =>{ 
        table.style.display = 'none';
    });
    tbl2.style.display = 'table';
    type2.classList.add('selected');
};
type3.onclick = function(){
    options.forEach(option => {
        option.classList.remove('selected');
    });
    type3.classList.add('selected');
    tables.forEach(table =>{ 
        table.style.display = 'none';
    });
    tbl3.style.display = 'table';
};
type4.onclick = function(){
    options.forEach(option => {
        option.classList.remove('selected');
    });
    tables.forEach(table =>{ 
        table.style.display = 'none';
    });
    tbl4.style.display = 'table';
    type4.classList.add('selected');
};
type5.onclick = function(){
    options.forEach(option => {
        option.classList.remove('selected');
    });
    tables.forEach(table =>{ 
        table.style.display = 'none';
    });
    tbl5.style.display = 'table';
    type5.classList.add('selected');
};
const tasks = document.querySelectorAll('.task-line');
tasks.forEach(task => {
    const detail = task.querySelector('.task-details');
    const taskName = task.querySelector('.td-taskname')
    const closeBtn = detail.querySelector('.close-btn');
    taskName.onclick = function (){ 
        detail.classList.add('show');
    };
    closeBtn.addEventListener('click', function (e) {
        e.stopPropagation(); // Ngăn chặn sự kiện click lan rộng
        detail.classList.remove('show');
    });
});
});