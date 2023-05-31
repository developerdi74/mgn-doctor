var weight = $('#weight_input').val();
var height = $('#height_input').val()/100;
$(document).ready(function(){
    getIndexWeight(weight, height);
})

$('#height_input').on('input',function(){
    height = $(this).val()/100;
    getIndexWeight(weight, height);
})
$('#weight_input').on('input',function(){
    weight = $(this).val();
    getIndexWeight(weight, height);
})

function getIndexWeight(weight, height){

    if(weight<10){
        weight=10;
    }
    if(height<0.1){
        height=0.1;
    }    
    if(weight>200){
        weight=200;
    }
    if(height>3){
        height=3;
    }

    console.log(height);
    console.log(weight);
    index = weight/(height*height);

    $('.list-index-info>div').removeClass('bg-danger');
    $('.list-index-info>div').removeClass('bg-warning');
    $('.list-index-info>div').removeClass('bg-success');
    $('.list-index-info>div').removeClass('bg-info');

    if(index<=16){
        $('.position-1').addClass("bg-danger");
    }    
    if(index>16 && index<=18.5){
        $('.position-2').addClass("bg-warning");
    }
    if(index>18.5 && index<=25){
        $('.position-3').addClass("bg-success");
    }

    if(index>25 && index<=30){
        $('.position-4').addClass("bg-info");
    }

    if(index>30 && index<=35){
        $('.position-5').addClass("bg-warning");
    }

    if(index>35 && index<=40){
        $('.position-6').addClass("bg-warning");
    }    

    if(index>=40){
        $('.position-7').addClass("bg-danger");
    }


    $('.index_weight_input').html(index.toFixed(1));
}