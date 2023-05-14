const openNavBtn = document.getElementById("open__nav-btn");
const navItems = document.querySelector(".nav__items");
const closeNavBtn = document.getElementById("close__nav-btn");

const openNav = () => {
    navItems.style.display = "flex";
    openNavBtn.style.display = "none";
    closeNavBtn.style.display = "inline-block";
};
openNavBtn.addEventListener("click", openNav);


const closeNav =() => {
    navItems.style.display = "none";
    openNavBtn.style.display = "inline-block";
    closeNavBtn.style.display = "none";
};

closeNavBtn.addEventListener("click", closeNav);