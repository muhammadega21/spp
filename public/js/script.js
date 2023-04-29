const sidebar = document.querySelector('.sidebar')
const nav = document.querySelector('.nav')
const bar = document.querySelector("#bar")
const bg = document.querySelector(".bg")
const userInfo = document.querySelector(".user-info")
const userProfile = document.querySelector("#user-profile")
const close = document.querySelector("#close")

bar.addEventListener("click", () => sidebar.classList.toggle("active"));
bar.addEventListener("click", () => bg.classList.toggle("active"));
bar.addEventListener("click", () => nav.classList.toggle("active"));
userProfile.addEventListener("click", () => userInfo.classList.toggle("active"));

document.addEventListener('click', function(e){
    if(!bar.contains(e.target)){
            sidebar.classList.remove('active')
            bg.classList.remove('active')
            nav.classList.remove('active')
    }
    if(!userProfile.contains(e.target)){
            userInfo.classList.remove('active')
    }
});

