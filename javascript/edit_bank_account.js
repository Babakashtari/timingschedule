const multiple_owner = document.querySelector('div.new_program > form > fieldset > div > span > label > input#multiple_owners');
const single_account_holder_input = document.querySelector('div.new_program > form > fieldset > div > label > input#account_holder');
const multiple_owners_divtag = document.querySelector('div.new_program > form > fieldset > div#multiple_owners_div');
const add_bank_form_container = document.querySelector('div.new_program > form > fieldset > div#add_bank');
const single_account_holder_name = document.querySelector('div.new_program > form > fieldset > div > label#single_holder');

function show_multiple_owners_div(){
    if(multiple_owner.checked){
        single_account_holder_input.setAttribute('disabled', true);
        multiple_owners_divtag.classList.remove('displayNone');
        single_account_holder_name.classList.remove('compulsary');

    }else{
        single_account_holder_input.removeAttribute('disabled');
        multiple_owners_divtag.classList.add('displayNone');
        single_account_holder_name.classList.add('compulsary');
    }
}

multiple_owner.addEventListener('change', show_multiple_owners_div);
window.addEventListener('load', show_multiple_owners_div);

