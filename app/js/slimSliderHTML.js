"use strict";

function SlimSliderHtml(sldrId, room) {
	//console.log('готово'); //удалить	
	this.room = room;
	this.sldrRoot = document.querySelector(`.${sldrId}`);
	SlimSliderHtml.initialize(this);
}	
//получение списка файлов промис
SlimSliderHtml.prototype.jsonGetFileList = function() {
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

SlimSliderHtml.prototype.setSliderHTML = function (links) {
	let ul = document.createElement('ul');
	ul.className = 'slimSlider__list';
	
	links.forEach(function(imgLink,i,links){
		let li = document.createElement('li');
		li.className = 'slimSlider__element';
		let img = document.createElement('img');
		img.setAttribute('src',imgLink);
		li.append(img);
		ul.append(li);
		//console.log(ul);
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

};


SlimSliderHtml.initialize = function(that) {
	that.jsonGetFileList()//промис
	.then(function(links) {		
		that.setSliderHTML(links);		
		//return links.length;		
	})
};

//let s = new SlimSliderHtml('rooms__room', '1');

