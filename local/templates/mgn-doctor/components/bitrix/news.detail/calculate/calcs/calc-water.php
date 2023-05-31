<div class="row mb-4">
    <div class="col-12">
        <h1><?=$arResult["TITLE"]?></h1>
    </div>
    <div class="col-md-4">                   
        <div class="gender mb-4">
            <div class="col-12">
                <label class="form-label  mb-2 mr-3">Пол</label>
                <button class='btn btn-success' value="0.04">Мужской</button>
                <button class='btn btn-info' value="0.03">Женский</button>
            </div>
            <div class="col-12">
            </div>
        </div>

        <div class="weight mb-4">
            <div class="col-12">
                <label for="weight" class="form-label">Вес - <span class='range-span span-range-weight'>40</span> кг.</label>
            </div>
            <div class="col-12 position-relative">
                <input type="range"  oninput="getWeight(this.value)" class="form-range range-weight" id="weight" min="40" max="140" step="5" value="40">
                <div class='d-flex span-cnt'>
                    <span>40</span><span>90</span><span>140</span>
                </div>
            </div>                    
        </div>

        <div class="activity">
            <div class="col-12">
                <label for="activity"  class="form-label">Физическая активность - <span class='range-span span-range-activity'>2</span> час.</label>
            </div>
            <div class="col-12">
                <input type="range" oninput="getActivity(this.value)" class="form-range range-activity" id="activity" min="0" max="8" step="0.5" value="2">
                <div class='d-flex span-cnt'>
                    <span>0</span><span>4</span><span>8</span>
                </div>
            </div>
            
            
        </div>
    </div>
    <div class="col-md-4">
        <div class="bottle_container mb-3">
            <img class = 'imgbottle' src="<?=$this->GetFolder()?>/img/bottle_calc_mask_num.png">
            <img class = 'imgwater' src="<?=$this->GetFolder()?>/img/bottle_calc_fill.jpg">
        </div>
        <div class="label_text">
            * Данный расчет носит рекомендательный характер. Получить более точную информацию Вы можете задав вопрос диетологу.
        </div>
    </div>

    <div class="col-md-4">
        <div class='mb-3'>Ваша рекомендованная норма</div>
        <h3 class='water_input'>
            <span>2.8</span> литра <div></div>
            <div class='min_text'>воды в день</div>
        </h3>
        <?=$arResult["DETAIL_TEXT"];?>
    </div>
</div>
<script type="text/javascript">
		var gender=0.04;
	var weight=40;
	var activity=2;
	var water = 1;

	 $(document).ready(function(){
		calcWater(gender, weight, activity)	 	
	 })
	 
	$(document).on("oninput", '.range-activity', function(){
		activity = $(this).val();
		$(".span-range-activity").html($(this).val());
		calcWater(gender, weight, activity)
	})

	$(document).on("click", '.gender button', function(){
		gender = $(this).val();

		$('.gender button').addClass('btn-info');
		$('.gender button').removeClass('btn-success');		
		$(this).removeClass('btn-info');	

		$(this).addClass('btn-success');

		calcWater(gender, weight, activity)
	})

	function getWeight(val){
		weight = val;
		$(".span-range-weight").html(val);
		calcWater(gender, weight, activity);
	}
	function getActivity(val){
		activity = val;
		$(".span-range-activity").html(val);
		calcWater(gender, weight, activity)
	}

	function calcWater(gender, weight, activity){
        if(weight==""){
            weight=40;
        }
        if(weight>140){
             weight=140;
         }
		var proizv = 0.6
		if(gender==0.03){
			proizv = 0.4
		}
		water = (weight*gender) + (activity*proizv);
		$('.water_input span').html(water.toFixed(1));
		$('.imgwater').css('bottom',-450/10*(10-water));
	}
</script>