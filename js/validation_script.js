const form = document.querySelector('form');
const formInputs = document.querySelectorAll(".input");
const inputLogin = document.querySelector('input[name = login]')
const inputPass = document.querySelector('input[name = password]');
const inputPassRepeat = document.querySelector('input[name = passRepeat]');
const inputEmail = document.querySelector('input[name = e-mail]');
let msgError;

function validEmail(email){
    let symbolsOfEmail = email.toLowerCase().split('');
    function isEmail (el, index, arr){
        if (index === 0 || index === arr.length-1){
            return false
        }
        return arr[index] === '@';
    }
    return symbolsOfEmail.findIndex(isEmail) !== -1;
}

function validPassword (password){
    let symbolsOfPass = password.toLowerCase().split('');
    function isNumSymbol (el, index, arr){
        return arr[index] >= '0' && arr[index] <= '9';
    }
    function isLatinSymbol(el, index, arr) {
        return arr[index] >= 'a' && arr[index] <= 'z';
    }
    return symbolsOfPass.findIndex(isLatinSymbol) !== -1 && symbolsOfPass.findIndex(isNumSymbol) !== -1;
}
form.onsubmit = function (e) {
    let inputsEmpty = Array.from(formInputs).filter(input => input.value === '');
    msgError = [];
    formInputs.forEach(function (input) {
        if (input.value === '') {
            input.classList.add('error');
        } else {
            input.classList.remove('error');
        }
    });
    if (inputsEmpty.length !== 0) {
        msgError.push('Вы не заполнили все поля ввода.');
        document.getElementById('hidden').innerHTML = msgError;
        return false;
    } else {
        let counter = 0;
        if (inputLogin.length < 4 && inputLogin > 50) {
            msgError.push('Недопустимая длинна логина.');
            counter++;
        }
        if (inputPass.value !== inputPassRepeat.value) {
            msgError.push('Пароли не совпадают.');
            counter++;
        } else {
            if (validPassword(inputPass.value) !== true) {
                counter++;
                msgError.push('Пароль должен содержать символы латиницы и цифры.');
            }
        }
        if(validEmail(inputEmail.value) !== true){
            counter++;
            msgError.push('Веддённый e-mail адрес не является корректным.');
        }
        if (counter >0){
            document.getElementById('validation').innerHTML = msgError;
            return false;
        }
    }
}