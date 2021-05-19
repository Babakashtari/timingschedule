class card_number_seperator{
    card_number_container;
    card_number;
    card_number_segments = [];
    
    constructor(container){
        this.card_number_container = container;
        window.addEventListener('load', this.add_space(this.card_number_container));
    }
    
    add_space(container){
        this.card_number = container.textContent;
        if(this.card_number != ""){
            let output="";
            for(let i = 0 ; i< 4 ; i++){
                if(i === 3){
                    output += [this.card_number.slice(12, 16)].join('');
                }else{
                    output += [this.card_number.slice(i*4, (i*4)+4), " "].join('');
                }
            }
            this.card_number_container.textContent = output;
        }
    }
}

const card_number_container = document.getElementsByClassName('card_number');
for(let i = 0 ; i< card_number_container.length; i++){
    seperator = new card_number_seperator(card_number_container[i]);
}
