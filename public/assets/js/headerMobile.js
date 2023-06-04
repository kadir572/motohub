const mobileNavOpenBtn = document.querySelector('.mobile__nav__btn--open')
const mobileMenu = document.querySelector('.mobile__menu')
const mobileNavCloseBtn = document.querySelector('.mobile__nav__btn--close')

mobileNavOpenBtn.addEventListener('click', () => {
  mobileMenu.classList.add('mobile__menu--open')
})

mobileNavCloseBtn.addEventListener('click', () => {
  mobileMenu.classList.remove('mobile__menu--open')
})
