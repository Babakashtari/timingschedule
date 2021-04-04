class Time {
    constructor(x){
        this.current_time = new Date();
        this.future_time = x;
    }
    difference_in_time_with_UTC(){
        return this.current_time.getTimezoneOffset();
    }
    static display_current_time(){
        const now = new Date();
        return now;
    }
    future_time(){

    }
    time_remaining_to_future_time(){

    }
}

// getting the top paragraph tag:
// const top_time_and_date_p_tag = document.querySelector("nav.top_time_and_date>p.top_time_and_date");
// top_time_and_date_p_tag.innerHTML = Time.display_current_time();

// creating a new time object:
// const date = new Time(Date("2021/12/06"));

// time difference with UTC in minutes: 
// console.log(date.difference_in_time_with_UTC());

