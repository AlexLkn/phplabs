const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginLeftBtn = document.getElementById('login-left');
const loginRightBtn = document.getElementById('login-right');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginLeftBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

loginRightBtn.addEventListener('click', () => {
    container.classList.remove("active");
});
