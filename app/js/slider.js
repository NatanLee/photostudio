"use strict";
if(document.getElementById('bigSlider')){
	//ajax получаем картинки	
	let xhr = new XMLHttpRequest();
	xhr.open('GET', '/slider.php?bigSlider');
	xhr.responseType = 'json';
	xhr.send();	
	xhr.onload = function() {
	  if (xhr.status == 200) {
		let data = xhr.response;
			slideThem(data);		
	  }
	}	

	let currentSlide = 0;//для работы слайдера
	let playing = true;
	let pauseButton = document.getElementById('bigSliderPause');
	let nextButton = document.getElementById('bigSliderNext');
	let previousButton = document.getElementById('bigSliderPrevious');
	let slideInterval;
	let slides;
	let indicatorDotsAll;

	pauseButton.onclick = function() {
		if(playing) {
		pauseSlideshow();
	  } else {
		playSlideshow();
	  }
	};
	 
	nextButton.onclick = function() {
		pauseSlideshow();
		nextSlide();
	};
	previousButton.onclick = function() {
		pauseSlideshow();
		previousSlide();
	};

	//вызывается xhr запросом
	function slideThem(picsNameArray){
		setPics(picsNameArray);
		slides = document.querySelectorAll('#bigSlider img');
		setDots(slides.length);
		
		slideInterval = setInterval(nextSlide,4000);

	}

	//вставлем картинки слaйдера на страницу
	function setPics(data){
		let slider = document.getElementById('bigSlider');
		let slideImg = document.createElement('img');
		let links = data.map(function(name) {
			return './src/bigSlider/' + name;
		});			
		links.forEach(function(imgLink, i, links){
			let slideImg = document.createElement('img');
			slideImg.setAttribute('src', imgLink);
			slideImg.setAttribute('data-slide-img', `${i}`);
			if(!i){
				slideImg.classList.add('showing');
			}
			slider.append(slideImg);		
		})
		
	}
	//функция слайдера
	function nextSlide() {
		goToSlide(currentSlide+1);
	}
	 
	function previousSlide() {
		goToSlide(currentSlide-1);
	}
	 
	function goToSlide(n) {	
		slides[currentSlide].className = '';
		indicatorDotsAll[currentSlide].className = 'dot';
		currentSlide = (n+slides.length)%slides.length;
		slides[currentSlide].className = 'showing';
		indicatorDotsAll[currentSlide].className = 'dot showing';
	//console.log(indicatorDotsAll[currentSlide]);
	}

	//пауза слайдов 
	function pauseSlideshow() {
		pauseButton.innerHTML = '<i class="fa fa-play fa-4x" aria-hidden="true"></i>';
		playing = false;
		clearInterval(slideInterval);
	}
	//возобновление слайдов  
	function playSlideshow() {
		pauseButton.innerHTML = '<i class="fa fa-pause fa-4x" aria-hidden="true">';
		playing = true;
		slideInterval = setInterval(nextSlide,3000);
	}

	// инициализация индикаторных точек
	function setDots(amount){	
	//console.log(amount);
		let sum = '';
		let dotsElement = document.querySelector('#bigSlider .bigSlider__dots');

		for(let i=0; i<amount; i++) {
			if(!i){
				sum += `<span class="dot showing" data-slide = "${i}"></span>`;
			}else{	
			sum += `<span class="dot" data-slide = "${i}"></span>`;
			}
		};
		dotsElement.innerHTML = sum;
		
		indicatorDotsAll = document.querySelectorAll('span.dot');
		//Назначаем точкам обработчик события 'click'
		for(let n = 0; n < amount; n++) {
			indicatorDotsAll[n].addEventListener('click', function(event) {
				let tarElement = event.target.dataset.slide;
				let currentElement = document.querySelector('#bigSlider .showing').dataset.slideImg;
				if (currentElement != tarElement){
					goToSlide(parseInt(tarElement));
				}
			});
		};		
	}
}