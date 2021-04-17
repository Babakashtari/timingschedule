const iteration_radios = document.querySelectorAll('.new_program > form > fieldset > div > span input[name="iteration"]');
const iteration_containers = document.querySelectorAll('.new_program > form > fieldset > div.iterator_container');
const unknown = document.querySelector('.new_program > form > fieldset > div > span input#unknown');
const event_duration = document.querySelector('.new_program > form > fieldset > div input#duration');
const money_amount_container = document.querySelector('.new_program > form > fieldset > div#money_amount_container');
const money_options_container = document.querySelector('.new_program > form > fieldset > div > span#money_options');
const money_options = money_options_container.querySelectorAll('input[type="radio"]');
const option_30 = document.querySelector('.new_program > form > fieldset > div#monthly input#day_30');
const option_31 = document.querySelector('.new_program > form > fieldset > div#monthly input#day_31');     
const error_30_and_31 = document.querySelector('.new_program > form > fieldset > div#monthly p#error_message_30_31');           

console.log("entered here");

function hider(event){
    for(let s = 0; s< iteration_containers.length; s++){
        if(iteration_radios[s] === event.target){
            iteration_containers[s].classList.remove('displayNone');
            // if(s===2){
            //     // show the error of 30th and 31st day selection in the month:
            //     show_hide_error_30_and_31();
            // }
        }else{
            iteration_containers[s].classList.add('displayNone');
        }
    }
}

for(let i = 0; i< iteration_radios.length; i++){
    iteration_radios[i].addEventListener('change', hider);
}

function disable_duration(){
    if(unknown.checked){
        event_duration.disabled = true;
    }else{
        event_duration.disabled = false;

    }
}
function activate_money_amount_container(){
    if(money_options[0].checked){
        money_amount_container.classList.remove('displayNone');
    }else{
        money_amount_container.classList.add('displayNone');

    }
}
function show_hide_error_30_and_31(){

                // if the 30th and 31st days of the month are checked for iteration:
                if(option_30.checked || option_31.checked){
                    error_30_and_31.classList.remove('displayNone');
                }else{
                    error_30_and_31.classList.add('displayNone');
                }

}

for(let n= 0; n<money_options.length; n++){
    money_options[n].addEventListener('change', activate_money_amount_container)
}

window.addEventListener('load', hider);
unknown.addEventListener('change', disable_duration);
option_30.addEventListener('change', show_hide_error_30_and_31);
option_31.addEventListener('change', show_hide_error_30_and_31);