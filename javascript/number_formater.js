const number_input = document.querySelectorAll('.numerical_value')[0];

number_input.addEventListener('input', function(){
    // strip unnecessary letters and comma from the number to make it ready for formating by php:
    const number_value = number_input.value.replace(/[a-zA-Z,\\]/g,"");
    
    // if the user deleted the inserted number:
    if(number_value.length <= 0){
        number_value = 0;
    // if the user had inserted at least a digit number in the input field:
    }else{
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200){
                number_input.value = this.responseText;
            }
        }
        xhttp.open("GET", "PHP/objects/number_formater.php?" + "number_value="+ number_value , true);
        xhttp.send();
    
    }
});
