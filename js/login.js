const form = document.querySelector('#login');
form.addEventListener('submit', handleSubmit);

eEmail = document.getElementById('e-email');
eEmailValid = document.getElementById('e-email-valid');
ePass = document.getElementById('e-pass');

eemail = document.getElementById('email');
ppass = document.getElementById('password');

iemail = document.getElementById('i-email');
ipass = document.getElementById('i-pass');

const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

function handleSubmit(event) {
    event.preventDefault();

    const formData = new FormData(event.target);

    const email = formData.get('email');
    const pass = formData.get('password');

    m = false;
    p = false;

    if (!email) {
        eEmail.classList.add('e-visible');
        eEmailValid.classList.remove('e-visible');

        eemail.classList.add('shake');
        eemail.classList.add('red');
        setTimeout(() => {
            eemail.classList.remove('shake');
        }, 500);
    } else if (email) {
        if (emailRegex.test(email)) {
            eemail.classList.remove('red');
            eEmailValid.classList.remove('e-visible');
            eEmail.classList.remove('e-visible');
            console.log('bravo hai rotto tutto');
            m = true;
        } else {
            eEmail.classList.remove('e-visible');
            eEmailValid.classList.add('e-visible')
            eemail.classList.add('red');

            eemail.classList.add('shake');
            setTimeout(() => {
                eemail.classList.remove('shake');
            }, 500);
        }
    }

    if (!pass) {
        ePass.classList.add('e-visible');

        ppass.classList.add('red');
        ppass.classList.add('shake');
        setTimeout(() => {
            ppass.classList.remove('shake');
        }, 500);
    } else if (pass) {
        ppass.classList.remove('red');
        ePass.classList.remove('e-visible');
        p = true;
    }
    
    if (m && p) {
        form.submit();
        console.log(`Email: ${email}, Password: ${pass}`);
    } else {
        console.log('E mo che cazzo devo fare?');
    }
}

iemail.onkeyup = () => {
    eEmail.classList.remove('e-visible');
    eEmailValid.classList.remove('e-visible');

    eemail.classList.remove('red');

    if (emailRegex.test(iemail.value)) {
        eemail.classList.remove('red');
        eEmailValid.classList.remove('e-visible');
        eEmail.classList.remove('e-visible');
        console.log('bravo hai rotto tutto');
        m = true;
    }
    
    if (!iemail.value) {
        eEmail.classList.add('e-visible');

        eemail.classList.add('red');
        eemail.classList.add('shake');
        setTimeout(() => {
            eemail.classList.remove('shake');
        }, 500);
    }
}

ipass.onkeyup = () => {
    ePass.classList.remove('e-visible');
    ppass.classList.remove('red');

    if (!ipass.value) {
        ePass.classList.add('e-visible');

        ppass.classList.add('red');
        ppass.classList.add('shake');
        setTimeout(() => {
            ppass.classList.remove('shake');
        }, 500);
    }
}