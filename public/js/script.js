// showPassword
$('#showPassword').click(function(){
        const passwordInput = document.getElementById('password');
        const showPassbtn = document.getElementById('showPassword');
        if(passwordInput.type === "password"){
                passwordInput.type = "text";
                showPassbtn.classList.remove("fa-eye-slash");
                showPassbtn.classList.add("fa-eye");
        }else{
                passwordInput.type = "password";
                showPassbtn.classList.remove("fa-eye");
                showPassbtn.classList.add("fa-eye-slash");
        }
});

const sidebar = document.querySelector('.sidebar')
const nav = document.querySelector('.nav')
const bar = document.querySelector("#bar")
const bg = document.querySelector(".bg")
const user = document.querySelector(".user")
const userProfile = document.querySelector("#user-profile")

// Sidebar
bar.addEventListener('click', function(){
        sidebar.classList.toggle("active");
        bg.classList.toggle("active");
        nav.classList.toggle("active");
})

// Navbar - User Profile
userProfile.addEventListener("click", () => user.classList.toggle("active"));


document.addEventListener('click', function(e){
    if(!bar.contains(e.target) && !sidebar.contains(e.target) && !nav.contains(e.target)){
            sidebar.classList.remove('active');
            bg.classList.remove('active');
            nav.classList.remove('active');
    }
    if(!user.contains(e.target)){
            user.classList.remove('active');
    }
});

// Preview Image
function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFReader){
                imgPreview.src = oFReader.target.result;
        }
}

