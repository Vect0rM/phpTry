let form = document.querySelector('.validation-js-form'),
    formInputs = document.querySelectorAll('.input-val'),
    inputR = document.querySelector('.input-r');

function validateNumbers(num) {
    let re = /^[-+]?[0-9]*[.,]?[0-9]+(?:[eE][-+]?[0-9]+)?$/;
    return re.test(String(num));
}

function validateR(num) {
    return num < 0;
}

form.onsubmit = function () {
    let rVal = inputR.value,
        errorInputs = Array.from(formInputs).filter(input => input.value === '' || !validateNumbers(input.value));
    formInputs.forEach(function (input) {
        if (input.value === '' || !validateNumbers(input.value)) {
            input.classList.add('error');
        } else {
            input.classList.remove('error');
        }
    })

    if (errorInputs.length !== 0) {
        console.log('err inputs');
        return false;
    }
    if (validateR(rVal)) {
        console.log('not valid');
        inputR.classList.add('error');
        return false;
    } else {
        inputR.classList.remove('error');
    }
}