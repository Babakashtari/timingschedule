class Bank_images{

    get_images_directories(){
        const directories_container = document.getElementsByClassName('directories')[0];
        const text_content = directories_container.textContent;
        // removing \:
        let cleaned_text_content = text_content.split('\\').join('');
        // removing ":
        cleaned_text_content = cleaned_text_content.split('"').join('');
        // removing first and last []:
        cleaned_text_content = cleaned_text_content.replace("[", "");
        cleaned_text_content = cleaned_text_content.replace("]", "");
        // splicing string from , into an array:
        return cleaned_text_content.split(",");

        
    }
    
    create_background_image(directories){
        const image_container = document.getElementById('bank_image_container');
        const image = image_container.querySelector('img');
        const select = document.getElementById('Bank_name');
        const select_options = document.getElementById('Bank_name').querySelectorAll('option');

        select.addEventListener('change', function(event){

            for(let i = 0; i< select_options.length; i++){
                if(event.target.value === select_options[i].value){
                    image.setAttribute("src", directories[i]);
                }
            }
    
        })
        
    }
}

const Iranian_bank_images = new Bank_images();
const directories = Iranian_bank_images.get_images_directories();
Iranian_bank_images.create_background_image(directories);
