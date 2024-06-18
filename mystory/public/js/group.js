document.addEventListener('DOMContentLoaded', function () {
    const createdGroupsOption = document.querySelector('.op1');
    const groupsOption = document.querySelector('.op2');
    const group1 = document.querySelector('.group1');
    const group2 = document.querySelector('.group2');
    const createbtn = document.querySelector('.create');
    const createarea = document.querySelector('.create-group');
    const closebtn = document.querySelector('.close-btn');
    createdGroupsOption.classList.add('active');
    createdGroupsOption.onclick = function () {
        group1.classList.add('active');
        createdGroupsOption.classList.add('active');
        group2.classList.remove('active');
        groupsOption.classList.remove('active');
    };

    groupsOption.onclick = function () {
        group2.classList.add('active');
        group1.classList.remove('active');
        createdGroupsOption.classList.remove('active');
        groupsOption.classList.add('active');
    };
    createbtn.onclick = function(){
        createarea.classList.add('show');
    };
    closebtn.onclick = function(){
        createarea.classList.remove('show');
    };
    
});