const login = document.getElementById('login'),
    loginBtn = document.getElementById('presence'),
    loginClose = document.getElementById('login-close')


loginBtn.addEventListener('click', ()=> {
    login.classList.add('show-login')
})


loginClose.addEventListener('click', ()=> {
    login.classList.remove('show-login')
})