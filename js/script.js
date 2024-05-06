let btn = document.querySelector('#btn');
let sidebar = document.querySelector('.sidebar');
let header = document.querySelector('.left-section');
let main = document.querySelector('.main-content')

btn.onclick = function () {
    sidebar.classList.toggle('active');
    if (sidebar.classList.contains('active')) {
        header.style.marginLeft = '250px';
        main.style.width = 'calc(100% - 250px)'; 
    } else {
        header.style.marginLeft = '80px';
        main.style.width = 'calc(100% - 80px)';
    }
};

document.addEventListener("DOMContentLoaded", function() {
    var userPage = document.querySelector('.user');
    console.log("loaded");
    userPage.addEventListener('click', function() {
        window.location.href = "manage-account.php";
    });
});
