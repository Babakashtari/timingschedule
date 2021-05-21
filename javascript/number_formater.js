function format(event){
    // removing any non digit characters from the number to make it ready for being formated by php:
    let number_value = event.target.value.replace(/\D/g,"");
    // if the user deleted the inserted number:
    if(number_value.length <= 0 ){
        event.target.value = 0;
    // if the user had inserted at least a digit number in the input field:
    }else{
        if(number_value.length > 15){
            event.target.value = event.target.value.slice(0, -1);
        }
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                event.target.value = this.responseText;
            }
        }
        xhttp.open("GET", "PHP/objects/number_formater.php?" + "number_value="+ number_value , true);
        xhttp.send();
    
    }
}
const number_input = document.querySelectorAll('.numerical_value');
console.log(number_input);
for(let x = 0; x<number_input.length; x++){
    number_input[x].addEventListener('input', format);
}
