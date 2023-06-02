const userBtn = document.querySelector('.user__btn')
const userDropdown = document.querySelector('.user__dropdown')
const dropdownIcon = document.querySelector('.user__btn > .fa-chevron-down')

userBtn.addEventListener('click', () => {
  console.log('test')
  userDropdown.classList.toggle('show')

  dropdownIcon.classList.toggle('dropdown--open')
})
