 <div class="row mb-4">
     <div class="col-12">
         <h1><?=$arResult["TITLE"]?></h1>
     </div>
     <div class="col-sm-12 col-md-12  mb-4"> 

             <div class="mb-3">                        
                 С помощью данного онлайн калькулятора вы можете рассчитатать Ваше нормальное давление.
             </div>           

         <div class="input_calc row">    

             <div class="col-6">
                 <div>                        
                     <label for='year_input'>Введите Ваш возраст:</label><br>
                     <input type="number" min=1 max=150 step=1 name="year_input" id = 'year_input' class="w-100" value="25">
                 </div>
            </div>     

             <div class="col-6">
                 <div>                        
                     Ваше нормальное давление:
                 </div>
                 <div class='index_weight_input bar_input text-left'>                        
                     117/75.5
                 </div>
             </div>

         </div>
     </div>

     <div class="col-12">
         <?=$arResult["DETAIL_TEXT"];?>
     </div>
 </div>
 
 <script type="text/javascript">
     
     var year = 25;

$(document).ready(function(){
    getBar( year );
})

$('#year_input').on('input',function(){
    year = $(this).val();
    getBar(year);
})

function getBar(year){
    bar_min = 63+0.5*year;
    bar_max = 102+0.6*year;
    bar = bar_max.toFixed(0)+"/"+bar_min.toFixed(0);
    $('.bar_input').html(bar);
}
 </script>