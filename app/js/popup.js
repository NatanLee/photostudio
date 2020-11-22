"use strict";

let roomPopup = document.querySelector('.one-room__popup');

if(roomPopup){
	let clickImages = document.querySelectorAll('.one-room__one-image');
	let popupImage = roomPopup.querySelector('img');
	
	clickImages.forEach(function(item, i, clickImages){
		item.addEventListener('click', showPopup)
	});
	
	function showPopup(){
		popupImage.src = event.target.src;
		roomPopup.classList.add('one-room__popup_visible'); 
		
//		console.log(popupImage.src);
	}
}
