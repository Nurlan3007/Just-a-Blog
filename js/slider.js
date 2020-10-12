document.getElementById('slider-left').onclick = sliderLeft;
let left = 0;
function sliderLeft(argument) {
	let polosa = document.getElementById('polosa');
	left = left - 242;
	if(left < -2512){
		left = 0;
	}
	polosa.style.left = left+'px';
}
