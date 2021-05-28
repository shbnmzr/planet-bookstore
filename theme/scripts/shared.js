const EmailAddress = document.getElementById('email');
const Registeration = document.getElementById('registeration');
const EmailValidity = document.getElementById('email-error');
const DropdownButton = document.getElementById('dropdown-button');
const Dropdown = document.getElementById('dropdown');
const Icon = document.getElementById('icon');
const DropSearch = document.getElementById('dropdown-search');
const SearchBar = document.getElementById('search__container');
const Search = document.getElementById('search');
const ErrorMessage = document.getElementById('failure-message');
const SuccesMessage = document.getElementById('success-message');
const UpdatePassword = document.getElementById('update-password');
let open = false;

// Email Validation
const isAlphabet = (char) => {
    let charCode = char.charCodeAt(0);
    return ((charCode > 64 && charCode < 91) ||
        (charCode > 96 && charCode < 123));
};

const isAlphanumeric = (char) => {
    let charCode = char.charCodeAt(0);
    return (charCode > 47 && charCode < 58) || isAlphabet(char);
        
};


const emailValidation = () => {
    let submissionAllowed = false;
    let inputText = EmailAddress.value;
    let char = inputText[0];
    let state = 0;
    let i = 0;
    while (i < inputText.length) {
        switch (state) {
            case 0:
                if (isAlphanumeric(char) ||
                    (char === '_')) {
                    state = 1;
                    char = inputText[i + 1];
                    EmailAddress.style.borderColor = '#01d486';
                } else {
                    state = 99;
                }
                break;
            case 1:
                if (isAlphanumeric(char) ||
                    (char === '_') ||
                    (char === '.')) {
                    state = 1;
                    char = inputText[i + 1];
                    EmailAddress.style.borderColor = '#01d486';
                } else if (char === '@') {
                    state = 2;
                    char = inputText[i+1];
                }else {
                    state = 99;
                }
                break;
            case 2:
                if (isAlphabet(char)) {
                    state = 2;
                    char = inputText[i + 1];
                    EmailAddress.style.borderColor = '#01d486';
                } else if (char === '.') {
                    state = 3;
                    char = inputText[i+1];
                }else {
                    state = 99;
                }
                break;
            case 3:
                if (isAlphabet(char)) {
                    state = 3;
                    char = inputText[i + 1];
                    EmailAddress.style.borderColor = '#01d486';
                    submissionAllowed = true;
                } else {
                    state = 99;
                }
                break;
            case 99:
                EmailAddress.style.borderColor = 'red';
                break;
        }
        i++;
    }
    return submissionAllowed;
};

if (Registeration) {
    Registeration.addEventListener('click', () => {
    if (!emailValidation()) {
        EmailValidity.style.display = "flex";
        Registeration.preventDefault();
    } else {
        Registeration.submit();
    }
});
}

if (EmailAddress) {
    EmailAddress.addEventListener('keyup', emailValidation);
    EmailAddress.addEventListener('blur', () => {
        EmailAddress.style.borderColor = '#01d486';
    });
}


// Edit Profile
if (UpdatePassword) {
    UpdatePassword.addEventListener('click', () => {
        if (String(window.location.href).includes('Success')) {
            SuccesMessage.style.displey = 'flex !important';
        } else if (String(window.location.href).includes('Failure')) {
            ErrorMessage.style.displey = 'flex !important';
        } else {
            SuccesMessage.style.displey = 'none';
            ErrorMessage.style.displey = 'none';
        }
    });
}

// Dropdown Menu
DropdownButton.addEventListener('click', () => {
    Dropdown.classList.toggle('show');
    if (open) {
        Icon.className = 'fas fa-angle-down';
    } else {
        Icon.className = 'fas fa-angle-down open';
    }
    open = !open;
    
});

DropSearch.addEventListener('click', () => {
    SearchBar.classList.toggle('show');
});


const toggleSwitch = document.querySelector('input[type="checkbox"]');
const nav = document.getElementById('nav');
const toggleIcon = document.getElementById('toggle-icon');
const image = document.getElementById('image');
const textBox = document.getElementById('text-box');


// Image 
const imageMode = (color) => {
    image.src = `./theme/images/undraw_book_lover_${color}.svg`;
}

const toggleDarkLightMode = (isLight) => {
    isLight ? imageMode('light') : imageMode('dark');
}

// Switch Theme
const switchTheme = (event) => {
    if (event.target.checked) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
    } else {
        document.documentElement.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light');
    }
    toggleDarkLightMode(!event.target.checked)
}
// Event Listener
toggleSwitch.addEventListener('change', switchTheme);

// Check Local storage For Theme
const currentTheme = localStorage.getItem('theme');
if (currentTheme) {
    document.documentElement.setAttribute('data-theme', currentTheme);
    if (currentTheme === 'dark') {
        toggleSwitch.checked = true;
        toggleDarkLightMode(!event.target.checked)
    }
}