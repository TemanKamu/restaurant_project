const wrapperCustom = document.querySelector('.wrapper-custom');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnPopup = document.querySelector('.btnLogin-popup');
const iconClose = document.querySelector('.icon-close');
var box = document.getElementsByClassName('wrapper-custom');

registerLink.addEventListener('click', ()=> {
   wrapperCustom.classList.add('active');  
});

loginLink.addEventListener('click', ()=> {
    wrapperCustom.classList.remove('active');  
 });

 btnPopup.addEventListener('click', ()=> {
    wrapperCustom.classList.add('active-popup'); 
    box.style.display = 'inline-block'; 
 });
 iconClose.addEventListener('click', ()=> {
    wrapperCustom.classList.remove('active-popup'); 
    box.style.display = 'none'; 
 });
 btnPopup.addEventListener('click', ()=> {
    
});

 