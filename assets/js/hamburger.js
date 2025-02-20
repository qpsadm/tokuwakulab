"use strict";

const hamburger = document.querySelector(".hamburger");
hamburger.addEventListener("click", function () {
	const line = document.querySelector(".hamburger_line");
	const spNav = document.querySelector(".sp-nav");
	line.classList.toggle("active");
	spNav.classList.toggle("side-menu");
});
