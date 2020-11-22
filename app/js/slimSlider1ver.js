"use strict";

function Sim(sldrId, room) {
	//this.links;
	this.room = room;
	this.sldrRoot = document.querySelector(`.${sldrId}`);
	this.options = {
		// Default options for the carousel
		loop: true,     // Бесконечное зацикливание слайдера
		auto: true,     // Автоматическое пролистывание
		interval: 5000, // Интервал между пролистыванием элементов (мс)
		arrows: true,   // Пролистывание стрелками
		dots: true      // Индикаторные точки
	};
	// Carousel objects
	this.sldrList;
	this.sldrElements;
	this.sldrElemFirst;
	this.leftArrow;
	this.rightArrow;
	this.indicatorDots;
	
	//this.lineWidth = 0;
	//this.widthArray = [0];
	
	Sim.initialize(this);
};

//получение списка файлов промис
Sim.prototype.jsonGetFileList = function() {
	let room = this.room;
	let links;
	let linkPromise = new Promise(function(resolve, reject) {
		let xhrSim = new XMLHttpRequest();
		xhrSim.open('GET',`slider.php?slimSlider=${room}`)		
		xhrSim.responseType = 'json';
		xhrSim.send();
		xhrSim.onload = function() {
			if (xhrSim.status == 200) {
				let data = xhrSim.response;
				links = data.map(function(name) {
				return './src/rooms/' + room + '/' + name;
				});
				resolve(links);
			}else{
				reject(console.log('ERROR!!!!'));
			}			
		}		
	});	
    return linkPromise;		
};

//сборка кода слайдера
Sim.prototype.setSliderHTML = function (links) {
	let ul = document.createElement('ul');
	ul.className = 'slimSlider__list';	
	links.forEach(function(imgLink,i,links){
		let li = document.createElement('li');
		li.className = 'slimSlider__element';
		let img = document.createElement('img');
		img.setAttribute('src',imgLink);
		li.append(img);
		ul.append(li);
	});
	this.sldrRoot.append(ul);
	let leftArrow = document.createElement('div');
	leftArrow.className = 'slimSlider__arrowLeft';
	this.sldrRoot.append(leftArrow);
	let rightArrow = document.createElement('div');
	rightArrow.className = 'slimSlider__arrowRight';
	this.sldrRoot.append(rightArrow);
	let dots = document.createElement('div');
	dots.className = 'slimSlider__dots';
	this.sldrRoot.append(dots);	 	
	//console.log(ul); 
return ul;
};

Sim.prototype.elemPrev = function(num) {
	num = num || 1;
	

	let prevElement = this.currentElement;
	this.currentElement -= num;
	if(this.currentElement < 0) this.currentElement = this.elemCount-1;

	if(!this.options.loop) {
		if(this.currentElement == 0) {
			this.leftArrow.style.display = 'none'
		};
		this.rightArrow.style.display = 'block'
	};
	
	//this.sldrElements[this.currentElement].style.opacity = '1';
	//this.sldrElements[prevElement].style.opacity = '0';

	if(this.options.dots) {
		this.dotOn(prevElement); this.dotOff(this.currentElement)
	}
};

Sim.prototype.elemNext = function(num) {	
	num = num || 1;
//console.log(this.elemCount);	
	let prevElement = this.currentElement;
//console.log(prevElement);
	this.currentElement += num;
	if(this.currentElement >= this.elemCount) this.currentElement = 0;

	if(!this.options.loop) {
		if(this.currentElement == this.elemCount-1) {
			this.rightArrow.style.display = 'none'
		};
		this.leftArrow.style.display = 'block'
	};

	//this.sldrElements[this.currentElement].style.opacity = '1';
	//this.sldrElements[prevElement].style.opacity = '0';

	if(this.options.dots) {
		this.dotOn(prevElement); this.dotOff(this.currentElement)
	}
	
};

Sim.prototype.dotOn = function(num) {
//console.log(num);
	this.indicatorDotsAll[num].style.cssText = 'background-color:#BBB; cursor:pointer;'
};

Sim.prototype.dotOff = function(num) {
	this.indicatorDotsAll[num].style.cssText = 'background-color:#556; cursor:default;'
};

Sim.initialize = function(that) {	
	//промис
	that.jsonGetFileList()
	//1 затем
	.then(function(links) {		
		let then1 = new Promise (resolve=>{
			//that.setSliderHTML(links);
			resolve(that.setSliderHTML(links));
		});
		return then1;		
	//2 затем
	}).then(function(result){
		// Carousel objects
		that.sldrList = that.sldrRoot.querySelector('.slimSlider__list');//line		
		that.sldrElements = that.sldrList.querySelectorAll('.slimSlider__element');//slide
		that.sldrImgs = that.sldrList.querySelectorAll('.slimSlider__element img');//все	картинки
		that.elemCount = that.sldrImgs.length;// Количество фото
		that.sliderWidth = that.sldrRoot.offsetWidth;
		that.currentElement = 0;

		//let widthArray = [];
				
		let then2 = new Promise(resolve=>{			
			//let widthArray = [0];
			let lineWidth = 0;
			for(let i = 0; i < that.sldrImgs.length; i++){					
				that.sldrImgs[i].onload = function(){
					lineWidth += that.sldrImgs[i].offsetWidth;
					//widthArray.push(that.sldrImgs[i].offsetWidth);
					if (i == that.sldrImgs.length-1){
						resolve(lineWidth);
					}	
				};				
			
			};			
		});
		return then2;
	//3 затем	!!вываливается периодически из массива часть изображений в then2
	}).then(function(result){
		that.lineWidth = result;	
		that.sldrList.style.width = result;
				console.log(that.lineWidth);
		console.log(that.sldrList);

//console.log('width');		
//console.log(that.lineWidth);
//console.log(that.sldrList);
		
//console.log(that.widthArray);
		
	/* 	that.sldrElemFirst = that.sldrList.querySelector('.slimSlider__element');
		that.leftArrow = that.sldrRoot.querySelector('div.slimSlider__arrowLeft');
		that.rightArrow = that.sldrRoot.querySelector('div.slimSlider__arrowRight');
		that.indicatorDots = that.sldrRoot.querySelector('div.slimSlider__dots');
		
		
//console.log(that.options.interval);		
		
	 	let bgTime = getTime();
		function getTime() {
			return new Date().getTime();
		};
		
		function setAutoScroll() {
			that.autoScroll = setInterval(function() {
				let fnTime = getTime();
				if(fnTime - bgTime + 10 > that.options.interval) {
					bgTime = fnTime; 
					that.elemNext();
				}
			}, that.options.interval)
		};

		// Start initialization
		if(that.elemCount <= 1) {   // Отключить навигацию
			that.options.auto = false; that.options.arrows = false; that.options.dots = false;
			that.leftArrow.style.display = 'none'; that.rightArrow.style.display = 'none'
		};
		if(that.elemCount >= 1) {   // показать первый элемент
			//that.sldrElemFirst.style.opacity = '1';
		};
		if(!that.options.loop) {
			that.leftArrow.style.display = 'none';  // отключить левую стрелку
			that.options.auto = false; // отключить автопркрутку
		}else if(that.options.auto) {   // инициализация автопрокруки
		setAutoScroll();
		// Остановка прокрутки при наведении мыши на элемент
		that.sldrList.addEventListener('mouseenter', function() {clearInterval(that.autoScroll)}, false);
		that.sldrList.addEventListener('mouseleave', setAutoScroll, false)
		}; 
		if(that.options.arrows) {  // инициализация стрелок
			that.leftArrow.addEventListener('click', function() {
				let fnTime = getTime();
				if(fnTime - bgTime > 1000) {
					bgTime = fnTime; that.elemPrev()
				}
			}, false);
			that.rightArrow.addEventListener('click', function() {
				let fnTime = getTime();
				if(fnTime - bgTime > 1000) {
					bgTime = fnTime; that.elemNext()
				}
			}, false)
		}else {
			that.leftArrow.style.display = 'none'; that.rightArrow.style.display = 'none'
		};
		if(that.options.dots) {  // инициализация индикаторных точек
			let sum = '', diffNum;
			for(let i=0; i<that.elemCount; i++) {
				sum += '<span class="sim-dot"></span>'
			};
			that.indicatorDots.innerHTML = sum;
			that.indicatorDotsAll = that.sldrRoot.querySelectorAll('span.sim-dot');
			// Назначаем точкам обработчик события 'click'
			for(let n=0; n<that.elemCount; n++) {
				that.indicatorDotsAll[n].addEventListener('click', function() {
					diffNum = Math.abs(n - that.currentElement);
					if(n < that.currentElement) {
						bgTime = getTime(); that.elemPrev(diffNum)
					}
					else if(n > that.currentElement) {
						bgTime = getTime(); that.elemNext(diffNum)
					}
					// Если n == that.currentElement ничего не делаем
				}, false)
			};
			that.dotOff(0);  // точка[0] выключена, остальные включены
			for(let i=1; i<that.elemCount; i++) {
				that.dotOn(i)
			}
		}  */
	});	

};

let s = new Sim('rooms__room', '1');
//console.log(s);
//console.log(s.jsonGetFileList());
//s.initialize();
