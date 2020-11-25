"use strict";

//тогл для элемента. управляющий элемент должен иметь класс toggleMenu и класс скрытого элемента в порядке  0 и 1. скрываемый элемент должен иметь ид, который прописан в классе управляющего элемента
function HideSubmenu(selector){
	this.body = document.querySelector('body');
	this.activeButton = document.querySelector(`.${selector}`);
	this.myBlock = document.getElementById(`${selector}`);
	this.timeVar = '';

	HideSubmenu.initialize(this);
}

HideSubmenu.initialize = function(that){
	that.activeButton.onclick = function(){
		//let that = this;
		if(that.myBlock.style.visibility == "visible"){
			that.myBlock.style = "visibility: hidden";
		}else{
			that.myBlock.style = "visibility: visible"; that.timeVar = 1;
		}
	};
	that.body.onclick = function(){
		//let that = this;
		if(!that.timeVar){
			that.myBlock.style = "visibility: hidden";
		}
		if(that.timeVar){ setTimeout(function(){ that.timeVar=''; }, 100);}
	};
};

let menuItems = document.querySelectorAll('.toggleMenu');
for(let i = 0; i < menuItems.length; i++){
	let menuItemClasses = menuItems[i].classList;
	new HideSubmenu(menuItemClasses[1]);
}


//для показать и скрыть галерею

let showGalleryButton = document.querySelector('.one-room__button');
if(showGalleryButton){
	let gallery = document.querySelector('.one-room__images');
//	console.log(gallery);	
	
	showGalleryButton.addEventListener('click', function(){
		gallery.classList.toggle('one-room__images_fully-previewed');
		if(event.target.innerHTML == 'Показать все фотографии'){
			event.target.innerHTML = 'Скрыть фотографии';
		}else{
			event.target.innerHTML = 'Показать все фотографии';
		}
//		console.log(event.target.innerHTML);
		
	
		
		
		
	})
}


