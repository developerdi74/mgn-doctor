<div class="row mb-4">
    <div class="col-12">
        <h1><?=$arResult["TITLE"]?></h1>
    </div>
    <div class="col-sm-12 col-md-6 mb-4"> 

            <div class="mb-3">                        
                С помощью данного онлайн калькулятора вы можете рассчитатать Ваш индекс массы тела.
            </div>           

        <div class="input_calc row">    

            <div class="col-6">
                <div>                        
                    <label for='height_input'>Ваш рост, в см.:</label><br>
                    <input type="number" min=40 max=250 step=1 name="height_input" id = 'height_input' class="w-100" value="160">
                </div>
                <div>                        
                    <label for='weight_input'>Ваш вес, в кг.:</label><br>
                    <input type="number" min=1 max=150 step=1 name="weight_input" id = 'weight_input' class="w-100" value="55">
                </div>
           </div>     

            <div class="col-6">
                <div>                        
                    Ваш индекс массы тела:
                </div>
                <div class='index_weight_input'>                        
                    23
                </div>
            </div>

        </div>
    </div>
    <div class="col-sm-12 col-md-6 mb-4 list-index-info">

        <div class="row border-bottom">
            <div class="col-4 bg-info border-right text-light p-2">
                Индекс массы тела
            </div>
            <div class="col-8 bg-info text-light p-2">
                Соответствие между массой человека и его ростом
            </div>
        </div>        

        <div class="row border-bottom position-1 p-2">
            <div class="col-4 border-right ">
                16 и менее
            </div>
            <div class="col-8">
                Выраженный дефицит массы тела
            </div>
        </div>
        <div class="row border-bottom position-2 p-2">
            <div class="col-4 border-right ">
                16-18,5
            </div>
            <div class="col-8">
                Недостаточная (дефицит) масса тела
            </div>
        </div>
        <div class="row border-bottom position-3 p-2">
            <div class="col-4 border-right ">
                18,5-25
            </div>
            <div class="col-8">
                Норма
            </div>
        </div>
        <div class="row border-bottom position-4 p-2">
            <div class="col-4 border-right ">
                25-30
            </div>
            <div class="col-8">
                Избыточная масса тела (предожирение)
            </div>
        </div>
        <div class="row border-bottom position-5 p-2">
            <div class="col-4 border-right ">
               30-35
            </div>
            <div class="col-8">
               Ожирение первой степени
            </div>
        </div>
        <div class="row border-bottom position-6 p-2">
            <div class="col-4 border-right ">
                35-40
            </div>
            <div class="col-8">
                    Ожирение второй степени
            </div>
        </div>
        <div class="row border-bottom position-7 p-2">
            <div class="col-4 border-right ">
                40 и более
            </div>
            <div class="col-8">
                    Ожирение третьей степени (морбидное)
            </div>
        </div>

    </div>

    <div class="col-12">
        <?=$arResult["DETAIL_TEXT"];?>
    </div>
</div>

<script type="text/javascript">

 </script>