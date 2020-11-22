"use strict";
function Sim(room) {
	this.roomName = room;
	this.sldrRoot = document.querySelector(`.${this.roomName}`);
	this.buttonsBlock = this.sldrRoot.querySelector('.rooms__buttons');	
	this.sldrList = this.sldrRoot.querySelector('.slimSlider__list');	
	this.sldrElements = this.sldrList.querySelectorAll('.slimSlider__element');	
	this.elemCount = this.sldrElements.length;//количество элементов в слайдере
	this.imgWidths = [];//массив с шириной блоков рисунков
	this.currentElement = 0;
	this.autoScroll;
	this.removedElem;
	this.startOffset = '-600px';//начальное смещение слайдера

	for(let i = 0; i < this.sldrElements.length; i++){
		this.imgWidths.push(this.sldrElements[i].offsetWidth);
		//this.imgSrcs.push(this.sldrElements[i].querySelector('img').src);
	}	

	this.leftArrow = this.buttonsBlock.querySelector('.arrowLeft');
	this.rightArrow = this.buttonsBlock.querySelector('.arrowRight');
	
	this.options = {
		// Default options for the carousel
		loop: true,     // Бесконечное зацикливание слайдера
		auto: true,     // Автоматическое пролистывание
		interval: 3000, // Интервал между пролистыванием элементов (мс)
		arrows: true,   // Пролистывание стрелками
		step: 1,        // Шаг		
	};
		
	Sim.initialize(this);
};


Sim.prototype.elemPrev = function() {	
	this.sldrList.style.transition = "all ease-in-out 1s";
	if(this.currentElement < 0) this.currentElement = this.elemCount-1;
	let lastElem = this.currentElement-1 < 0 ? this.elemCount-1 : this.currentElement-1;
	let sum = - parseInt(this.startOffset) - this.imgWidths[lastElem];
console.log(sum);	
	this.sldrList.style.left = '-' + sum + 'px';
	this.currentElement -= this.options.step;
	this.jumpBack();
};

Sim.prototype.jumpBack = function() {	
	let that = this;	
	this.removedElem = document.querySelector(`.${this.roomName} .slimSlider__element:last-child`);
	let delFirst = function() {
		that.sldrList.style.transition = "none";
		that.sldrList.style.left = that.startOffset;
		that.removedElem.remove();
		that.sldrList.prepend(that.removedElem);
		that.sldrList.removeEventListener('transitionend', delFirst);
	};
	this.sldrList.addEventListener('transitionend', delFirst);
}


Sim.prototype.elemNext = function() {	
	this.sldrList.style.transition = "all ease-in-out 1s";			
	if(this.currentElement >= this.elemCount) this.currentElement = 0;
	let sum = - parseInt(this.startOffset) + this.imgWidths[this.currentElement];
	this.sldrList.style.left = '-' + sum + 'px';
	this.currentElement += this.options.step;
//console.log(this.currentElement-1);
	this.jumpForv();
};

Sim.prototype.jumpForv = function() {
	
	let that = this;	
	this.removedElem = document.querySelector(`.${this.roomName} .slimSlider__element`);
	let delBack = function() {
		that.sldrList.style.transition = "none";
		that.sldrList.style.left = that.startOffset;
		that.removedElem.remove();
		that.sldrList.append(that.removedElem);
		that.sldrList.removeEventListener('transitionend', delBack);
	};
	this.sldrList.addEventListener('transitionend', delBack);
}

Sim.initialize = function(that) {			
	let bgTime = getTime();	
	function getTime() {
		return new Date().getTime();
	};	

	//инициализация слайдера
//console.log(that.imgWidths);	
	//that.startOffset = Math.max.apply(null, that.imgWidths);
	//that.sldrList.style.left = - that.startOffset + "px";
//console.log(that.startOffset);	
	function setAutoScroll() {
		that.autoScroll = setInterval(function() {
			let fnTime = getTime();
			if(fnTime - bgTime + 10 > that.options.interval) {
				bgTime = fnTime; 
				that.elemNext();
				//that.elemPrev();
			}
		}, that.options.interval)
	};
	
	
	setAutoScroll();
	// Остановка прокрутки при наведении мыши на элемент
	that.buttonsBlock.addEventListener('mouseenter', function() {
		clearInterval(that.autoScroll);
//console.log('stop');
	});
	that.buttonsBlock.addEventListener('mouseleave', function() {
		setAutoScroll();
//console.log('start');
	});
	
	// инициализация стрелок
	that.leftArrow.addEventListener('click', function() {
		let fnTime = getTime();
		if(fnTime - bgTime > 1100) {
//console.log('click-left');
			bgTime = fnTime;
			that.elemNext();
		}
	});
	that.rightArrow.addEventListener('click', function() {
		let fnTime = getTime();
		if(fnTime - bgTime > 1100) {
//console.log('click-right');
			bgTime = fnTime;
			that.elemPrev();
		}	
	});
};
window.onload = function(){
let sliders = document.querySelectorAll('.rooms__room');
for(let i = 0; i < sliders.length; i++){
	new Sim(sliders[i].classList[1]);
//console.log(sliders[i].classList[1]);
};


//let s = new Sim('room1');

}