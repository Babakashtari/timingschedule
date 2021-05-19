class card_number_seperator{
    card_number_input;
    card_number;
    card_number_segments = [];
    
    constructor(card_number_input){
        this.card_number_input = card_number_input;
        this.card_number_input.addEventListener('input', this.add_space);
    }
    
    add_space(event){
        this.card_number = event.target.value;
        // add a space at these indexes to the card number string:
        if(this.card_number.length === 4 || this.card_number.length === 9 || this.card_number.length === 14){
            this.card_number += " ";
        // stop taking numbers if the card number is fully inserted:
        }else if(this.card_number.length>19){
            this.card_number = this.card_number.substring(0, this.card_number.length - 1);
        }
        // showing the spaced card number in the related input field: 
        if(this.card_number !== event.target.value){
            event.target.value = this.card_number;
        }
    }
}

const card_number_input = document.getElementsByClassName('card_number')[0];
seperator = new card_number_seperator(card_number_input);
