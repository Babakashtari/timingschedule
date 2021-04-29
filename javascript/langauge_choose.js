const language_selection_button = document.querySelector('form#language_form > button#show_language');
const language_selection_ul = document.querySelector('form#language_form > ul#language_container');

language_selection_button.addEventListener('click', function (event) {
    event.preventDefault();
    if(language_selection_ul.classList.contains('displayNone')){
        language_selection_ul.classList.remove('displayNone');
    }else{
        language_selection_ul.classList.add('displayNone');
    }
})