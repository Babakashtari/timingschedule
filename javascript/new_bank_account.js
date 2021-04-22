const multiple_owner = document.querySelector('div.new_program > form > fieldset > div > span > label > input#multiple');
const single_account_holder_input = document.querySelector('div.new_program > form > fieldset > div > label > input#account_holder');
const multiple_owners_digtag = document.querySelector('div.new_program > form > fieldset > div#multiple_owners_div');
const new_bank_checkbox = document.querySelector('div.new_program > form > fieldset > div > span > label > input#add_new_bank');
const add_bank_form_container = document.querySelector('div.new_program > form > fieldset > div#add_bank');
const single_account_holder_name = document.querySelector('div.new_program > form > fieldset > div > label#single_holder');

function show_multiple_owners_div(){
    if(multiple_owner.checked){
        single_account_holder_input.setAttribute('disabled', true);
        multiple_owners_digtag.classList.remove('displayNone');
        single_account_holder_name.classList.remove('compulsary');

    }else{
        single_account_holder_input.removeAttribute('disabled');
        multiple_owners_digtag.classList.add('displayNone');
        single_account_holder_name.classList.add('compulsary');
    }
}

function show_add_bank_form(){
    if(new_bank_checkbox.checked){
        add_bank_form_container.classList.remove('displayNone');
    }else{
        add_bank_form_container.classList.add('displayNone');
    }
}

multiple_owner.addEventListener('change', show_multiple_owners_div);
new_bank_checkbox.addEventListener('change', show_add_bank_form);