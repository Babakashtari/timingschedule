const card_number_input = document.getElementsByClassName('card_number')[0];

class card_number_seperator_non_input{
    card_number_input;
    card_number;
    card_number_segments = [];
    
    constructor(card_number_input){
        this.card_number_input = card_number_input;
        window.addEventListener('load', this.add_space(this.card_number_input));
    }
    
    add_space(card_number_input){
        this.card_number = card_number_input.value;
        // add a space at these indexes to the card number string:
        const output = this.card_number.slice(0, 4) + " " + this.card_number.slice(4, 8) + " " + this.card_number.slice(8, 12) + " " + this.card_number.slice(12);

        // showing the spaced card number in the related input field: 
        card_number_input.value = output;
    }
}

seperator = new card_number_seperator_non_input(card_number_input);
