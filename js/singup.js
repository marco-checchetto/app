const form = document.querySelector('#singup');
form.addEventListener('submit', handleSubmit);

eName = document.getElementById('e-name');
eSurname = document.getElementById('e-surname');
eEmail = document.getElementById('e-email');
eEmailValid = document.getElementById('e-email-valid');
ePass = document.getElementById('e-pass');

nname = document.getElementById('name');
ssurname = document.getElementById('surname');
eemail = document.getElementById('email');
ppass = document.getElementById('password');

iname = document.getElementById('i-name');
isurname = document.getElementById('i-surname');
iemail = document.getElementById('i-email');
ipass = document.getElementById('i-pass');

const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

function handleSubmit(event) {
    event.preventDefault();

    const formData = new FormData(event.target);

    const name = formData.get('name');
    const surname = formData.get('surname');
    const email = formData.get('email');
    const pass = formData.get('password');

    n = false;
    s = false;
    m = false;
    p = false;

    if (!name) {
        eName.classList.add('e-visible');

        nname.classList.add('shake');
        nname.classList.add('red');
        setTimeout(() => {
            nname.classList.remove('shake');
        }, 500);
    } else if (name) {
        nname.classList.remove('red');
        eName.classList.remove('e-visible');
        n = true;
    }

    if (!surname) {
        eSurname.classList.add('e-visible');

        ssurname.classList.add('shake');
        ssurname.classList.add('red');
        setTimeout(() => {
            ssurname.classList.remove('shake');
        }, 500);
    } else if (surname) {
        ssurname.classList.remove('red');
        eSurname.classList.remove('e-visible');
        s = true;
    }

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
    
    if (n && s && m && p) {
        form.submit();
        console.log(`Email: ${email}, Password: ${pass}`);
    } else {
        console.log('E mo che cazzo devo fare?');
    }
}

iname.onkeyup = () => {
    eName.classList.remove('e-visible');
    nname.classList.remove('red');

    if (!iname.value) {
        eName.classList.add('e-visible');

        nname.classList.add('red');
        nname.classList.add('shake');
        setTimeout(() => {
            nname.classList.remove('shake');
        }, 500);
    }
}

isurname.onkeyup = () => {
    eSurname.classList.remove('e-visible');
    ssurname.classList.remove('red');

    if (!isurname.value) {
        eSurname.classList.add('e-visible');

        ssurname.classList.add('red');
        ssurname.classList.add('shake');
        setTimeout(() => {
            ssurname.classList.remove('shake');
        }, 500);
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